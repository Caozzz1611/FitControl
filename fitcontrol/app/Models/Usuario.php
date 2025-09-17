<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Usuario extends Authenticatable
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usu';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'direccion',
        'edad',
        'foto_perfil',
        'posicion',
        'categoria',
        'documento_identidad',
        'tel_usu',
        'email_usu',
        'contra_usu',
        'rol'
    ];

    protected $hidden = [
        'contra_usu'
    ];

    public function getAuthPassword()
    {
        return $this->contra_usu;
    }

    public function setContraUsuAttribute($value)
    {
        $this->attributes['contra_usu'] = Hash::make($value);
    }
}