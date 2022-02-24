<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarNuevoAgenciaRequest;
use App\Http\Requests\NuevoAgenciaRequest;
use App\Http\Resources\NuevoAgenciaResource;
use App\Models\NuevoAgenciaModel;

class NuevoAgenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NuevoAgenciaResource::collection(NuevoAgenciaModel::join('Vehiculo', 'NuevoAgencia.Vehiculo_idVehiculo', '=', 'Vehiculo.idVehiculo')
            ->join('FormaPago', 'Vehiculo.FormaPago_idFormaPago', '=', 'FormaPago.idFormaPago')
            ->join('Modelo', 'Vehiculo.Modelo_idModelo', '=', 'Modelo.idModelo')
            ->join('Marca', 'Modelo.Marca_idMarca', '=', 'Marca.idMarca')
            ->join('CondicionVehiculo', 'Vehiculo.CondicionVehiculo_idCondicionVehiculo', '=', 'CondicionVehiculo.idCondicionVehiculo')
            ->join('TipoVehiculo', 'Vehiculo.TipoVehiculo_idTipoVehiculo', '=', 'TipoVehiculo.idTipoVehiculo')
            ->join('Categoria', 'Vehiculo.Categoria_idCategoria', '=', 'Categoria.idCategoria')
            ->leftJoin('Foto', 'Vehiculo.idVehiculo', '=', 'Foto.Vehiculo_idVehiculo')
            ->where('Categoria_idCategoria', 1)
            ->groupBy('idVehiculo')
            ->orderby('Vehiculo.fecha_registro', 'DESC')
            ->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NuevoAgenciaRequest $requestAgencia)
    {
        $datosNuevoAgencia = $requestAgencia->all();
        $datosNuevoAgencia['precioEntrega'] = $requestAgencia->get('precio') * ($datosNuevoAgencia['porcentajeEnganche'] / 100);
        return (new NuevoAgenciaResource(NuevoAgenciaModel::create($datosNuevoAgencia)))
            ->additional(['message' => 'Vehículo nuevo de agencia registrado con éxito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idVehiculo)
    {
        return NuevoAgenciaResource::collection(NuevoAgenciaModel::join('Vehiculo', 'NuevoAgencia.Vehiculo_idVehiculo', '=', 'Vehiculo.idVehiculo')
            ->join('FormaPago', 'Vehiculo.FormaPago_idFormaPago', '=', 'FormaPago.idFormaPago')
            ->join('Modelo', 'Vehiculo.Modelo_idModelo', '=', 'Modelo.idModelo')
            ->join('Marca', 'Modelo.Marca_idMarca', '=', 'Marca.idMarca')
            ->join('CondicionVehiculo', 'Vehiculo.CondicionVehiculo_idCondicionVehiculo', '=', 'CondicionVehiculo.idCondicionVehiculo')
            ->join('TipoVehiculo', 'Vehiculo.TipoVehiculo_idTipoVehiculo', '=', 'TipoVehiculo.idTipoVehiculo')
            ->join('Categoria', 'Vehiculo.Categoria_idCategoria', '=', 'Categoria.idCategoria')
            ->where('NuevoAgencia.Vehiculo_idVehiculo', $idVehiculo)
            ->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarNuevoAgenciaRequest $request, $idVehiculo)
    {
        $datosNuevoAgencia = $request->only('precioEntrega', 'porcentajeEnganche');
        $query = NuevoAgenciaModel::where('NuevoAgencia.Vehiculo_idVehiculo', $idVehiculo)->update($datosNuevoAgencia);
        if ($query == 1) return response(['status' => true, 'message' => 'Vehículo nuevo de agencia actualizado con éxito'], 201);
        else return response(['status' => false, 'message' => 'Error al actualizar vehículo nuevo de agencia'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NuevoAgenciaModel $idVehiculo)
    {
        $idVehiculo->delete();
        return (new NuevoAgenciaResource($idVehiculo))
            ->additional(['message' => 'Vehículo nuevo de agencia eliminado con éxito']);
    }
}
