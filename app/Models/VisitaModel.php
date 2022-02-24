<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaModel extends Model
{
    use HasFactory;
    protected $table = 'Visita';
    protected $primaryKey = 'idVisita';
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_modificacion';

    protected $fillable = [
        "fecha",
        "Usuario_Info_idUsuario_Info",
        "NombrePagina_idNombrePagina",
        "Vehiculo_idVehiculo"
    ];
}
