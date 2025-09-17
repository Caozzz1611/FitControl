<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pago';
    protected $primaryKey = 'id_pago';
    public $timestamps = false;

    protected $fillable = [
        'fecha_pago',
        'monto',
        'estado',
        'recibo_pdf',
        'id_usu_fk',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usu_fk');
    }
}
