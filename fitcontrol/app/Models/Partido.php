<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $table = 'PARTIDO';
    protected $primaryKey = 'id_partido';
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'hora',
        'rival',
        'resultado',
        'id_torneo_fk',
        'id_equipo_fk'
    ];

    public function torneo()
    {
        return $this->belongsTo(Torneo::class, 'id_torneo_fk', 'id_torneo');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo_fk', 'id_equipo');
    }
}

