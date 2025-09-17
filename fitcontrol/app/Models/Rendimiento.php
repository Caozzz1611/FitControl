<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rendimiento extends Model
{
    protected $table = 'rendimiento';
    protected $primaryKey = 'id_rendimiento';
    public $timestamps = false; // asumo que no tienes created_at, updated_at

    protected $fillable = [
        'evaluacion',
        'comentarios',
        'id_usu_fk',
        'id_entrenamiento_fk',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usu_fk', 'id_usu');
    }

    public function entrenamiento()
    {
        return $this->belongsTo(Entrenamiento::class, 'id_entrenamiento_fk', 'id_entrenamiento');
    }
}
