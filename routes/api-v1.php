<?php

use App\Http\Controllers\API\ImagenController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\MarcaController;
use App\Http\Controllers\API\ModeloController;
use App\Http\Controllers\API\NuevoAgenciaController;
use App\Http\Controllers\API\Usuario_InfoController;
use App\Http\Controllers\API\VehiculoController;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\VisitaController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('apikeyadmin.validate', 'throttle:30,1')->prefix('admin')->group(function () {
    Route::get('/ver-info-usuario/{idUsuario}', [LoginController::class, 'show']);
    Route::post('/iniciar-sesion', [LoginController::class, 'login']);
    Route::post('/registrar-usuario', [LoginController::class, 'store']);
    Route::put('/actualizar-usuario/{idUsuario}', [LoginController::class, 'update']);
    Route::delete('/eliminar-usuario/{idUsuario}', [LoginController::class, 'destroy']);
    Route::post('/registrar-vehiculo', [VehiculoController::class, 'store']);
    Route::post('/registrar-vehiculo-agencia', [NuevoAgenciaController::class, 'store']);
    Route::put('/editar-vehiculo/{idVehiculo}', [VehiculoController::class, 'update']);
    Route::put('/editar-precio-nuevo-de-agencia/{idVehiculo}', [NuevoAgenciaController::class, 'update']);
    Route::delete('/eliminar-vehiculo/{idVehiculo}', [VehiculoController::class, 'destroy']);
    Route::post('/registrar-foto', [ImagenController::class, 'store']);
    Route::delete('/eliminar-foto/{idVehiculo}', [ImagenController::class, 'destroy']);
    Route::post('/registrar-video', [VideoController::class, 'store']);
    Route::put('/editar-video/{idVehiculo}', [VideoController::class, 'update']);
    Route::delete('/eliminar-agencia/{idVehiculo}', [NuevoAgenciaController::class, 'destroy']);
    Route::get('/storagelink', function() {Artisan::call('storage:link');return 'Done';});
});

Route::middleware('apikey.validate', 'throttle:60,1')->prefix('vehiculos')->group(function () {
    Route::get('/mostrar-imagen/{carpeta}/{fecha}/{imagen}', [ImagenController::class, 'imagen']);
    Route::get('/fijos', [VehiculoController::class, 'fijos']);
    Route::get('/marcas', [MarcaController::class, 'index']);
    Route::get('/modelos', [ModeloController::class, 'index']);
    Route::get('/categoria/{categoria_vehiculo?}', [VehiculoController::class, 'index']);
    Route::get('/nuevos-de-agencia', [NuevoAgenciaController::class, 'index']);
    Route::get('/{idVehiculo}', [VehiculoController::class, 'show']);
    Route::get('/nuevo-agencia/{idVehiculo}', [NuevoAgenciaController::class, 'show']);
    Route::get('/imagen/{idVehiculo}', [ImagenController::class, 'show']);
    Route::post('/registrar-informacion-navegador', [Usuario_InfoController::class, 'store']);
    Route::post('/registrar-visita-usuario/{idPagina}/{idVehiculo?}', [VisitaController::class, 'store']);
    Route::get('/video/{idVehiculo}', [VideoController::class, 'show']);
});
