<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadisticaPartido extends Model
{
    use HasFactory;

    protected $table = 'ESTADISTICA_PARTIDO';
    protected $primaryKey = 'id_estadistica';
    public $timestamps = false;

    protected $fillable = [
        'goles',
        'asistencias',
        'tarjetas_amarillas',
        'tarjetas_rojas',
        'id_partido_fk',
        'id_usu_fk',
    ];

    // Relación con PARTIDO
    public function partido()
    {
        return $this->belongsTo(Partido::class, 'id_partido_fk', 'id_partido');
    }

    // Relación con USUARIO
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usu_fk', 'id_usu');
    }
}
