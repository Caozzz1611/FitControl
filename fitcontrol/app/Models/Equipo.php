<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'EQUIPO';
    protected $primaryKey = 'id_equipo';
    public $timestamps = false;

    protected $fillable = [
        'nombre_equipo',
        'logo_equipo',
        'ubi_equipo',
        'contacto_equipo',
        'categoria_equipo',
    ];
}
