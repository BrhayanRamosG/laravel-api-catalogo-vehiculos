<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NuevoAgenciaModel extends Model
{
    use HasFactory;
    protected $table = 'NuevoAgencia';
    protected $primaryKey = 'idNuevoAgencia';
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_modificacion';
    protected $fillable = [
        'precioEntrega',
        'porcentajeEnganche',
        'Vehiculo_idVehiculo'
    ];
}
