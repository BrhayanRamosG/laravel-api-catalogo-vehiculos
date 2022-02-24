<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarUsuario_InfoRequest;
use App\Http\Resources\Usuario_InfoResource;
use App\Models\Usuario_Info;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class Usuario_InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardarUsuario_InfoRequest $request)
    {
        $agent = new Agent();
        $data['IP'] = md5($request->ip());
        $data['dispositivo'] = $agent->device();
        $data['navegador'] = $agent->browser();
        $data['SO'] = $agent->platform();
        $userexist = Usuario_InfoResource::collection(Usuario_Info::whereDate('fecha_registro', date('Y-m-d'))->where('IP', $data['IP'])->get());
        if ($agent->robot() != NULL) $data['robot'] = $agent->robot();

        if (count($userexist) > 0) {
            return response(
                ['status' => false, 'msg' => 'Ya existe la información'],
                202
            );
        } else {
            return (new Usuario_InfoResource(Usuario_Info::create($data)))
                ->additional(['message' => 'Información de Usuario registrada con éxito']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
