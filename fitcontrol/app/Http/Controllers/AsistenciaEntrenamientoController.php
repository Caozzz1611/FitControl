<?php

namespace App\Http\Controllers;

use App\Models\AsistenciaEntrenamiento;
use App\Models\Usuario;
use App\Models\Entrenamiento;
use Illuminate\Http\Request;

class AsistenciaEntrenamientoController extends Controller
{
public function index()
{
    $asistencias = AsistenciaEntrenamiento::with(['jugador', 'entrenamiento.equipo'])->get();
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
