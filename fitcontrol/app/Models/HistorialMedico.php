<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $table = 'historial_medico';
    protected $primaryKey = 'id_historial';
    public $timestamps = false;

    protected $fillable = ['observaciones', 'fecha', 'id_usu_fk'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usu_fk', 'id_usu');
    }
}
