<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarVideoRequest;
use App\Http\Requests\VideoRequest;
use App\Http\Resources\VideoResource;
use App\Models\VideoModel;

class VideoController extends Controller
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
    public function store(VideoRequest $request)
    {
        return (new VideoResource(VideoModel::create($request->all())))
            ->additional(['message' => 'Video registrado con éxito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idVehiculo)
    {
        return VideoResource::collection(VideoModel::where('Vehiculo_idVehiculo', $idVehiculo)
            ->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarVideoRequest $request, VideoModel $idVehiculo)
    {
        $idVehiculo->update($request->all());
        return (new VideoResource($idVehiculo))
            ->additional(['message' => 'Video actualizado con éxito'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoModel $idVehiculo)
    {
        $idVehiculo->delete();
        return (new VideoResource($idVehiculo))
            ->additional(['message' => 'Video eliminado con éxito']);
    }
}
