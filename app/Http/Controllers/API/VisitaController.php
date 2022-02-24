<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Usuario_InfoResource;
use App\Http\Resources\VisitaResource;
use App\Models\Usuario_Info;
use App\Models\VisitaModel;
use Illuminate\Http\Request;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Usuario_Info::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idPagina = null, $idVehiculo = null)
    {
        $usuario = Usuario_InfoResource::collection(Usuario_Info::where('IP', md5($request->ip()))->orderby('fecha_registro', 'DESC')->limit(1)->get());
        /* $validar = VisitaResource::collection(VisitaModel::where('fecha', date('Y-m-d'))
            ->where('Usuario_Info_idUsuario_Info', $usuario[0]['idUsuario_Info'])
            ->where(function ($query) use ($idPagina, $idVehiculo) {
                $query->where('NombrePagina_idNombrePagina', '=', $idPagina)
                    ->orwhere('Vehiculo_idVehiculo', '=', $idVehiculo)
                    ->orderby('fecha_registro', 'DESC');
            })->get()); */
        $validarNumeroPagina = VisitaResource::collection(VisitaModel::where('fecha', date('Y-m-d'))
            ->where('Usuario_Info_idUsuario_Info', $usuario[0]['idUsuario_Info'])
            ->where('NombrePagina_idNombrePagina', $idPagina === 'null' ? null : $idPagina)
            ->orderby('fecha_registro', 'DESC')->get());

        $validarIdVehiculo = VisitaResource::collection(VisitaModel::where('fecha', date('Y-m-d'))
            ->where('Usuario_Info_idUsuario_Info', $usuario[0]['idUsuario_Info'])
            ->where('Vehiculo_idVehiculo', $idVehiculo)
            ->orderby('fecha_registro', 'DESC')->get());

        $data['fecha'] = date('Y-m-d');
        $data['Usuario_Info_idUsuario_Info'] = $usuario[0]['idUsuario_Info'];
        $data['NombrePagina_idNombrePagina'] = $idPagina === 'null' ? null : $idPagina;
        $data['Vehiculo_idVehiculo'] = $idVehiculo;

        if (count($validarNumeroPagina) == 0 || count($validarIdVehiculo) == 0) {
            return (new VisitaResource(VisitaModel::create($data)))
                ->additional(['message' => 'Visita registrada con éxito']);
        } else {
            return response(['status' => false, 'message' => 'Ya está registrada esta visita'], 202);
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
