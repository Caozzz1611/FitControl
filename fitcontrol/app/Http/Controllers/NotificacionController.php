<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Models\Usuario;

class NotificacionController extends Controller
{
    public function index(Request $request)
    {
        $usuario = auth()->user();

        $query = Notificacion::with('usuarioDestinatario');

        // Jugador y entrenador solo ven sus propias notificaciones
        if (in_array($usuario->rol, ['jugador', 'entrenador'])) {
            $query->where('id_usuario_destinatario_fk', $usuario->id_usu);
        }

        // Filtros de búsqueda
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'LIKE', "%{$search}%")
                  ->orWhere('mensaje', 'LIKE', "%{$search}%");
            });
        }

        // Admin puede filtrar por usuario
        if ($request->filled('usuario') && $usuario->rol === 'admin') {
            $query->where('id_usuario_destinatario_fk', $request->input('usuario'));
        }

        if ($request->filled('fecha_min')) {
            $query->whereDate('fecha', '>=', $request->input('fecha_min'));
        }

        if ($request->filled('fecha_max')) {
            $query->whereDate('fecha', '<=', $request->input('fecha_max'));
        }

        $notificaciones = $query->get();

        // Admin ve todos los usuarios para el filtro, otros roles no
        $usuarios = ($usuario->rol === 'admin') ? Usuario::all() : collect([]);

        return view('notificaciones.index', compact('notificaciones', 'usuarios'));
    }

    public function create()
    {
        if (auth()->user()->rol !== 'admin') abort(403, 'No autorizado');
        $usuarios = Usuario::all();
        return view('notificaciones.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->rol !== 'admin') abort(403, 'No autorizado');

        $data = $request->validate([
            'titulo' => 'required|max:100',
            'mensaje' => 'required',
            'fecha' => 'required|date',
            'id_usuario_destinatario_fk' => 'required|exists:usuario,id_usu',
        ]);

        $data['fecha'] = str_replace('T', ' ', $data['fecha']);
        Notificacion::create($data);

        return redirect()->route('notificaciones.index')
                         ->with('success', 'Notificación creada correctamente.');
    }

    public function edit(Notificacion $notificacion)
    {
        if (auth()->user()->rol !== 'admin') abort(403, 'No autorizado');
        $usuarios = Usuario::all();
        return view('notificaciones.edit', compact('notificacion', 'usuarios'));
    }

    public function update(Request $request, Notificacion $notificacion)
    {
        if (auth()->user()->rol !== 'admin') abort(403, 'No autorizado');

        $data = $request->validate([
            'titulo' => 'required|max:100',
            'mensaje' => 'required',
            'fecha' => 'required|date',
            'id_usuario_destinatario_fk' => 'required|exists:usuario,id_usu',
        ]);

        $data['fecha'] = str_replace('T', ' ', $data['fecha']);
        $notificacion->update($data);

        return redirect()->route('notificaciones.index')
                         ->with('success', 'Notificación actualizada correctamente.');
    }

    public function destroy(Notificacion $notificacion)
    {
        if (auth()->user()->rol !== 'admin') abort(403, 'No autorizado');
        $notificacion->delete();
        return redirect()->route('notificaciones.index')
                         ->with('success', 'Notificación eliminada.');
    }
}
