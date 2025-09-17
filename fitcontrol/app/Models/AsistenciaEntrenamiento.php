<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaEntrenamiento extends Model
{
    use HasFactory;

    protected $table = 'asistencia_entrenamiento';
    protected $primaryKey = 'id_asistencia';
    public $timestamps = false;

    protected $fillable = [
        'presente',
        'id_usu_fk',
        'id_entrenamiento_fk',
    ];

    public function jugador()
    {
        return $this->belongsTo(Usuario::class, 'id_usu_fk', 'id_usu');
    }

    public function entrenamiento()
    {
        return $this->belongsTo(Entrenamiento::class, 'id_entrenamiento_fk', 'id_entrenamiento');
    }
}
