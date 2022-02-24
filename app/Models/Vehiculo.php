<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $table = 'Vehiculo';
    protected $primaryKey = 'idVehiculo';
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_modificacion';
    protected $fillable = [
        "precio",
        "tratoPrecio",
        "transmision",
        "kilometraje",
        "year",
        "descripcion",
        "Modelo_idModelo",
        "TipoVehiculo_idTipoVehiculo",
        "CondicionVehiculo_idCondicionVehiculo",
        "Propietario_idPropietario",
        "Categoria_idCategoria",
        "FormaPago_idFormaPago",
        "Login_idLogin",
        "fijo"
    ];
    protected $hidden = [
        'Modelo_idModelo',
        'TipoVehiculo_idTipoVehiculo',
        'CondicionVehiculo_idCondicionVehiculo',
        'Categoria_idCategoria',
        'FormaPago_idFormaPago',
        'Login_idLogin',
        'Propietario_idPropietario',
        'Modelo_idModelo',
    ];
}
