<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;

    protected $table = 'TORNEO';
    protected $primaryKey = 'id_torneo';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'premio',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'id_equipo_fk'
    ];

    // Relación con EQUIPO
// En el modelo Torneo (App\Models\Torneo)
public function equipo()
{
    return $this->belongsTo(Equipo::class, 'id_equipo_fk', 'id_equipo');
}


    public function partidos()
{
    return $this->hasMany(Partido::class, 'id_torneo_fk', 'id_torneo');
}

}
