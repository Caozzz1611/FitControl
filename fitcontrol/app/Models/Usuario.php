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

    // Para que Laravel use la contraseña correcta para autenticación
    public function getAuthPassword()
    {
        return $this->contra_usu;
    }

    // Mutador para encriptar la contraseña al asignar
    public function setContraUsuAttribute($value)
    {
        $this->attributes['contra_usu'] = Hash::make($value);
    }

    // Relación uno a muchos con EstadisticaPartido
    public function estadisticasPartido()
    {
        return $this->hasMany(EstadisticaPartido::class, 'id_usu_fk', 'id_usu');
    }

    // Relación uno a muchos con Notificacion
    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'id_usuario_destinatario_fk', 'id_usu');
    }
}
