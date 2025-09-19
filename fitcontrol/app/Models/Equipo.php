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

    // Relación con Entrenamiento
    public function entrenamientos()
    {
        return $this->hasMany(Entrenamiento::class, 'id_equipo_fk', 'id_equipo');
    }

    // Evento para eliminar entrenamientos cuando se elimina un equipo
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($equipo) {
            $equipo->entrenamientos()->delete();
        });
    }
}
