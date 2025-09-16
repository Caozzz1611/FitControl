<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario'; // 👈 si en tu BD se llama 'usuario' en singular
    protected $primaryKey = 'id_usu';
    public $timestamps = false; // 👈 si tu tabla NO tiene created_at y updated_at

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
    'rol', // ✅ importante
];

}
