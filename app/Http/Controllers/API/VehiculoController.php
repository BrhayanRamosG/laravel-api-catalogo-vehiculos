<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarVehiculoRequest;
use App\Http\Requests\GuardarVehiculoRequest;
use App\Http\Requests\NuevoAgenciaRequest;
use App\Http\Resources\NuevoAgenciaResource;
use App\Http\Resources\VehiculoResource;
use App\Models\NuevoAgenciaModel;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($categoria_vehiculo = null)
    {
        if ($categoria_vehiculo == null) {
            return VehiculoResource::collection(Vehiculo::join('FormaPago', 'Vehiculo.FormaPago_idFormaPago', '=', 'FormaPago.idFormaPago')
                ->join('Modelo', 'Vehiculo.Modelo_idModelo', '=', 'Modelo.idModelo')
                ->join('Marca', 'Modelo.Marca_idMarca', '=', 'Marca.idMarca')
                ->join('CondicionVehiculo', 'Vehiculo.CondicionVehiculo_idCondicionVehiculo', '=', 'CondicionVehiculo.idCondicionVehiculo')
                ->join('TipoVehiculo', 'Vehiculo.TipoVehiculo_idTipoVehiculo', '=', 'TipoVehiculo.idTipoVehiculo')
                ->join('Categoria', 'Vehiculo.Categoria_idCategoria', '=', 'Categoria.idCategoria')
                ->leftJoin('Foto', 'Vehiculo.idVehiculo', '=', 'Foto.Vehiculo_idVehiculo')
                ->where('estado', 1)
                ->groupBy('idVehiculo')
                ->orderby('Vehiculo.fecha_registro', 'DESC')
                ->get());
        } else {
            return VehiculoResource::collection(Vehiculo::join('FormaPago', 'Vehiculo.FormaPago_idFormaPago', '=', 'FormaPago.idFormaPago')
                ->join('Modelo', 'Vehiculo.Modelo_idModelo', '=', 'Modelo.idModelo')
                ->join('Marca', 'Modelo.Marca_idMarca', '=', 'Marca.idMarca')
                ->join('CondicionVehiculo', 'Vehiculo.CondicionVehiculo_idCondicionVehiculo', '=', 'CondicionVehiculo.idCondicionVehiculo')
                ->join('TipoVehiculo', 'Vehiculo.TipoVehiculo_idTipoVehiculo', '=', 'TipoVehiculo.idTipoVehiculo')
                ->join('Categoria', 'Vehiculo.Categoria_idCategoria', '=', 'Categoria.idCategoria')
                ->leftJoin('Foto', 'Vehiculo.idVehiculo', '=', 'Foto.Vehiculo_idVehiculo')
                ->where('Categoria_idCategoria', $categoria_vehiculo)
                ->where('estado', 1)
                ->groupBy('idVehiculo')
                ->orderby('Vehiculo.fecha_registro', 'DESC')
                ->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(GuardarVehiculoRequest $request)
    {
        return (new VehiculoResource(Vehiculo::create($request->all())))
            ->additional(['message' => 'Vehículo registrado con éxito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idVehiculo)
    {
        return VehiculoResource::collection(Vehiculo::join('FormaPago', 'Vehiculo.FormaPago_idFormaPago', '=', 'FormaPago.idFormaPago')
            ->join('Modelo', 'Vehiculo.Modelo_idModelo', '=', 'Modelo.idModelo')
            ->join('Marca', 'Modelo.Marca_idMarca', '=', 'Marca.idMarca')
            ->join('CondicionVehiculo', 'Vehiculo.CondicionVehiculo_idCondicionVehiculo', '=', 'CondicionVehiculo.idCondicionVehiculo')
            ->join('TipoVehiculo', 'Vehiculo.TipoVehiculo_idTipoVehiculo', '=', 'TipoVehiculo.idTipoVehiculo')
            ->join('Categoria', 'Vehiculo.Categoria_idCategoria', '=', 'Categoria.idCategoria')
            ->where('idVehiculo', $idVehiculo)
            ->get());
    }

    public function fijos()
    {
        return VehiculoResource::collection(Vehiculo::join('Modelo', 'Vehiculo.Modelo_idModelo', '=', 'Modelo.idModelo')
            ->join('Marca', 'Modelo.Marca_idMarca', '=', 'Marca.idMarca')
            ->join('TipoVehiculo', 'Vehiculo.TipoVehiculo_idTipoVehiculo', '=', 'TipoVehiculo.idTipoVehiculo')
            ->join('Categoria', 'Vehiculo.Categoria_idCategoria', '=', 'Categoria.idCategoria')
            ->leftJoin('Foto', 'Vehiculo.idVehiculo', '=', 'Foto.Vehiculo_idVehiculo')
            ->where('fijo', 1)
            ->where('estado', 1)
            ->groupBy('idVehiculo')
            ->orderby('Vehiculo.fecha_registro', 'DESC')
            ->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(ActualizarVehiculoRequest $request, Vehiculo $idVehiculo)
    {
        $idVehiculo->update($request->all());
        return (new VehiculoResource($idVehiculo))
            ->additional(['message' => 'Vehículo actualizado con éxito'])
            ->response()
            ->setStatusCode(201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $idVehiculo)
    {
        $idVehiculo->delete();
        return (new VehiculoResource($idVehiculo))
            ->additional(['message' => 'Vehículo eliminado con éxito']);
    }
}
