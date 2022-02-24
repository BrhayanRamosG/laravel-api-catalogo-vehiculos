<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    protected $primaryKey = 'idFoto';
    protected $table = 'Foto';
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_modificacion';
    protected $fillable = [
        'nombreFoto',
        'Vehiculo_idVehiculo'
    ];
    protected $hidden = [
        'fecha_registro',
        'fecha_modificacion'
    ];
}
