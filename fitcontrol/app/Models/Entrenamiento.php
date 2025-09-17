<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenamiento extends Model
{
    use HasFactory;

    protected $table = 'entrenamiento';
    protected $primaryKey = 'id_entrenamiento';
    public $timestamps = false; // si no tienes columnas created_at / updated_at

    protected $fillable = [
        'fecha',
        'hora',
        'ubicacion',
        'id_equipo_fk',
    ];

    // Relación con Equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo_fk');
    }
}
