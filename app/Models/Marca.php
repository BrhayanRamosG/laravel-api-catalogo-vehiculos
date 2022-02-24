<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $table = 'Marca';
    protected $primaryKey = 'idMarca';
    public $timestamps = false;
    protected $fillable = [
        'nombreMarca'
    ];
    /* protected $hidden=[
        "idMarca"
    ]; */
}
