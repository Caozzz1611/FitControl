<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripcion';
    protected $primaryKey = 'id_inscripcion';
    public $timestamps = false; // No tienes created_at ni updated_at

    protected $fillable = [
        'id_usu_fk',
        'id_torneo_fk',
        'fecha_inscripcion',
        'estado',
    ];

    // Relaciones

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usu_fk');
    }

    public function torneo()
    {
        return $this->belongsTo(Torneo::class, 'id_torneo_fk');
    }
}
