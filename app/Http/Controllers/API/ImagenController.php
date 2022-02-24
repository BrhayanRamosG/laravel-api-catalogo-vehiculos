<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarImagenRequest;
use App\Http\Resources\ImagenResource;
use App\Models\Imagen;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardarImagenRequest $request)
    {
        $imagenes = $request->file('imagen');
        $datos = $request->all();
        $carpeta_vehiculo = NULL;
        $date = date('d-m-Y');
        switch ($datos['categoria']) {
            case 'nuevo_agencia':
                $carpeta_vehiculo = "/nuevos_agencia";
                break;
            case 'seminuevo':
                $carpeta_vehiculo = "/seminuevos_usados";
                break;
            case 'remate':
                $carpeta_vehiculo = "/remates";
                break;
            default:
                $carpeta_vehiculo;
                break;
        }
        if ($request->hasFile('imagen')) {
            foreach ($imagenes as $img) {
                $datos['nombreFoto'] = $carpeta_vehiculo . '/' . $date . '/' . time() . '_' . md5($img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
                $path = $img->storeAs("public/imagenes_vehiculos", $datos['nombreFoto']);
                $response = new ImagenResource(Imagen::create($datos));
            }
        }
        /* 
        return (new ImagenResource(Imagen::create($datos)))
            ->additional(['msg' => 'Imagen registrada con éxito']);*/
        return $response->additional(['message' => 'Foto(s) registrada(s) con éxito', 'ruta' => $path]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idVehiculo)
    {
        return ImagenResource::collection(Imagen::where('Vehiculo_idVehiculo', $idVehiculo)->get());
    }

    public function imagen($carpeta, $fecha, $imagen)
    {
        $path = public_path() . "/storage/imagenes_vehiculos/$carpeta/$fecha/$imagen";
        return Response::download($path);
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
    public function destroy($idVehiculo)
    {
        $array =  ImagenResource::collection(Imagen::where('Vehiculo_idVehiculo', $idVehiculo)->get());
        if (count($array) > 0) {
            Imagen::where('Vehiculo_idVehiculo', $idVehiculo)->delete();
            $rutaImagen = [];
            foreach ($array as $img) {
                $rutaImagen[] = "public/imagenes_vehiculos{$img->nombreFoto}";
                //Storage::delete("public/imagenes_vehiculos{$img->nombreFoto}");
            }
            Storage::delete($rutaImagen);
            $size = count($array) > 1 ? 'Imágenes eliminadas' : 'Imágen eliminada';
            return response(['status' => true, 'message' => "{$size} con éxito"]);
        } else {
            return response(['status' => false, 'message' => 'Error al eliminar imagen'], 400);
        }
    }
}
