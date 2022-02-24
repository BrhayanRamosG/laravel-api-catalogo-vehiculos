<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarLoginRequest;
use App\Http\Requests\InicioLoginRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\LoginModel;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LoginModel::all();
    }

    public function login(InicioLoginRequest $request)
    {
        $credentials = $request->only('usuario', 'password');
        $dataUser = LoginResource::collection(LoginModel::where('usuario', $credentials['usuario'])->limit(1)->get());

        if (isset($dataUser[0])) {
            if (Hash::check($credentials['password'], $dataUser[0]->password)) {
                return $dataUser;
            } else {
                return response(
                    ['status' => false, 'msg' => 'Usuario o contraseña incorrectos'],
                    202
                );
            }
        } else {
            return response(
                ['status' => false, 'msg' => 'Usuario no registrado'],
                400
            );
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        return (new LoginResource(LoginModel::create($data)))
            ->additional(['message' => 'Usuario registrado con éxito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idUsuario)
    {
        return LoginResource::collection(LoginModel::where('idLogin', $idUsuario)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarLoginRequest $request, LoginModel $idUsuario)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $idUsuario->update($data);
        return (new LoginResource($idUsuario))
            ->additional(['message' => 'Usuario actualizado con éxito'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoginModel $idUsuario)
    {
        $idUsuario->delete();
        return (new LoginResource($idUsuario))
            ->additional(['message' => 'Usuario eliminado con éxito']);
    }
}
