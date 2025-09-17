<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Models\Usuario;

class NotificacionController extends Controller
{
    public function index()
    {
        $notificaciones = Notificacion::with('usuarioDestinatario')->get();
        return view('notificaciones.index', compact('notificaciones'));
    }

    public function create()
{
    // Puede que necesites pasar datos a la vista, como usuarios
    $usuarios = Usuario::all(); // o como lo tengas
    return view('notificaciones.create', compact('usuarios'));
}


    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|max:100',
            'mensaje' => 'required',
            'fecha' => 'required|date',
            'id_usuario_destinatario_fk' => 'required|exists:usuario,id_usu',
        ]);

        // Convertir fecha para MySQL DATETIME
        $data['fecha'] = str_replace('T', ' ', $data['fecha']);

        Notificacion::create($data);

        return redirect()->route('notificaciones.index')
                         ->with('success', 'Notificación creada correctamente.');
    }

    public function edit(Notificacion $notificacion)
    {
        $usuarios = Usuario::all();
        return view('notificaciones.edit', compact('notificacion', 'usuarios'));
    }

    public function update(Request $request, Notificacion $notificacion)
    {
        $data = $request->validate([
            'titulo' => 'required|max:100',
            'mensaje' => 'required',
            'fecha' => 'required|date',
            'id_usuario_destinatario_fk' => 'required|exists:usuario,id_usu',
        ]);

        // Convertir fecha para MySQL DATETIME
        $data['fecha'] = str_replace('T', ' ', $data['fecha']);

        $notificacion->update($data);

        return redirect()->route('notificaciones.index')
                         ->with('success', 'Notificación actualizada correctamente.');
    }

    public function destroy(Notificacion $notificacion)
    {
        $notificacion->delete();
        return redirect()->route('notificaciones.index')
                         ->with('success', 'Notificación eliminada.');
    }
}
