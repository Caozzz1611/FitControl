<?php

namespace App\Http\Controllers;

use App\Models\AsistenciaEntrenamiento;
use App\Models\Usuario;
use App\Models\Entrenamiento;
use Illuminate\Http\Request;

class AsistenciaEntrenamientoController extends Controller
{
public function index(Request $request)
{
    $query = AsistenciaEntrenamiento::with(['jugador', 'entrenamiento.equipo']);

    // Filtro por fecha de entrenamiento
    if ($request->filled('fecha_entrenamiento')) {
        $query->whereHas('entrenamiento', function($q) use ($request) {
            $q->whereDate('fecha', $request->fecha_entrenamiento);
        });
    }

    // Filtro por jugador
    if ($request->filled('jugador')) {
        $query->whereHas('jugador', function($q) use ($request) {
            $q->where('nombre', 'like', '%' . $request->jugador . '%');
        });
    }

    // Filtro por si asistió o no
    if ($request->filled('asistio')) {
        $query->where('asistio', $request->asistio);
    }

    // Paginación
    $asistencias = $query->paginate(10);

    // Obtener todos los entrenamientos para el filtro
    $entrenamientos = Entrenamiento::all();

    return view('asistencia_entrenamiento.index', compact('asistencias', 'entrenamientos'));
}




    public function create()
    {
        $usuarios = Usuario::all();
        $entrenamientos = Entrenamiento::all();
        return view('asistencia_entrenamiento.create', compact('usuarios', 'entrenamientos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'presente' => 'required|boolean',
            'id_usu_fk' => 'required|exists:usuario,id_usu',
            'id_entrenamiento_fk' => 'required|exists:entrenamiento,id_entrenamiento',
        ]);

        AsistenciaEntrenamiento::create($request->all());

        return redirect()->route('asistencia_entrenamiento.index')->with('success', 'Asistencia creada correctamente.');
    }

    public function edit(AsistenciaEntrenamiento $asistencia_entrenamiento)
    {
        $usuarios = Usuario::all();
        $entrenamientos = Entrenamiento::all();
        return view('asistencia_entrenamiento.edit', compact('asistencia_entrenamiento', 'usuarios', 'entrenamientos'));
    }

    public function update(Request $request, AsistenciaEntrenamiento $asistencia_entrenamiento)
    {
        $request->validate([
            'presente' => 'required|boolean',
            'id_usu_fk' => 'required|exists:usuario,id_usu',
            'id_entrenamiento_fk' => 'required|exists:entrenamiento,id_entrenamiento',
        ]);

        $asistencia_entrenamiento->update($request->all());

        return redirect()->route('asistencia_entrenamiento.index')->with('success', 'Asistencia actualizada correctamente.');
    }

    public function destroy(AsistenciaEntrenamiento $asistencia_entrenamiento)
    {
        $asistencia_entrenamiento->delete();
        return redirect()->route('asistencia_entrenamiento.index')->with('success', 'Asistencia eliminada correctamente.');
    }
}
