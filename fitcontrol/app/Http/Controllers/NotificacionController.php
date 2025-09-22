<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Models\Usuario;

class NotificacionController extends Controller
{
    public function index(Request $request)
{
    $query = Notificacion::with('usuarioDestinatario');

    // Filtro por búsqueda general (título o mensaje)
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('titulo', 'LIKE', "%{$search}%")
              ->orWhere('mensaje', 'LIKE', "%{$search}%");
        });
    }

    // Filtro por usuario destinatario
    if ($request->filled('usuario')) {
        $query->where('id_usuario_destinatario_fk', $request->input('usuario'));
    }

    // Filtro por fecha mínima
    if ($request->filled('fecha_min')) {
        $query->whereDate('fecha', '>=', $request->input('fecha_min'));
    }

    // Filtro por fecha máxima
    if ($request->filled('fecha_max')) {
        $query->whereDate('fecha', '<=', $request->input('fecha_max'));
    }

    $notificaciones = $query->get(); // O ->paginate(10) si deseas

    // Para el filtro de usuario
    $usuarios = Usuario::all();

    return view('notificaciones.index', compact('notificaciones', 'usuarios'));
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
