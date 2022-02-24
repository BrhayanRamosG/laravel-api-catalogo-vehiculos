<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class LoginModel extends Model
{
    use HasFactory;

    protected $table = 'Login';
    protected $primaryKey = 'idLogin';
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_modificacion';
    protected $fillable = [
        'usuario',
        'password'
    ];
    protected $hidden = [
        'password',
        'fecha_registro',
        'fecha_modificacion'
    ];
}
