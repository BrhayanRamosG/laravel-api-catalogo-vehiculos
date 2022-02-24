<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario_Info extends Model
{
    use HasFactory;
    protected $table = 'Usuario_Info';
    protected $primaryKey = 'idUsuario_Info';
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_modificacion';
    protected $fillable = [
        'IP',
        'dispositivo',
        'navegador',
        'SO',
        'robot'
    ];
}
