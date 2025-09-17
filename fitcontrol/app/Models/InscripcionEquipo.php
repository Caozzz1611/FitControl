<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscripcionEquipo extends Model
{
    protected $table = 'inscripcion_equipo';

    protected $primaryKey = 'id_inscripcion';

    public $timestamps = false; // si no tienes created_at/updated_at

    protected $fillable = [
        'id_usu_fk',
        'id_equipo_fk',
        'fecha_inscripcion',
        'estado',
    ];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usu_fk', 'id_usu');
    }

    // Relación con Equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo_fk', 'id_equipo');
    }
}
