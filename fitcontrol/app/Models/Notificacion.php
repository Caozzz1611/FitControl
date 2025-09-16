<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificacion';
    protected $primaryKey = 'id_notificacion';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'mensaje',
        'fecha',
        'id_usuario_destinatario_fk'
    ];

    public function usuarioDestinatario() {
        return $this->belongsTo(Usuario::class, 'id_usuario_destinatario_fk', 'id_usu');
    }
}
