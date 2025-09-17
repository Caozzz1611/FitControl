<?php

namespace App\Http\Controllers;

use App\Models\InscripcionEquipo;
use App\Models\Usuario;
use App\Models\Equipo;
use Illuminate\Http\Request;

class InscripcionEquipoController extends Controller
{
    public function index()
    {
        // Traer inscripciones con usuario y equipo para evitar N+1
        $inscripciones = InscripcionEquipo::with(['usuario', 'equipo'])->get();

        return view('inscripcion_equipo.index', compact('inscripciones'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $equipos = Equipo::all();
        return view('inscripcion_equipo.create', compact('usuarios', 'equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usu_fk' => 'required|exists:usuario,id_usu',
            'id_equipo_fk' => 'required|exists:equipo,id_equipo',
            'fecha_inscripcion' => 'required|date',
            'estado' => 'required|string|max:20',
        ]);

        InscripcionEquipo::create($request->all());

        return redirect()->route('inscripcion_equipo.index')->with('success', 'Inscripción creada correctamente');
    }

    public function edit(InscripcionEquipo $inscripcionEquipo)
    {
        $usuarios = Usuario::all();
        $equipos = Equipo::all();
        return view('inscripcion_equipo.edit', compact('inscripcionEquipo', 'usuarios', 'equipos'));
    }

    public function update(Request $request, InscripcionEquipo $inscripcionEquipo)
    {
        $request->validate([
            'id_usu_fk' => 'required|exists:usuario,id_usu',
            'id_equipo_fk' => 'required|exists:equipo,id_equipo',
            'fecha_inscripcion' => 'required|date',
            'estado' => 'required|string|max:20',
        ]);

        $inscripcionEquipo->update($request->all());

        return redirect()->route('inscripcion_equipo.index')->with('success', 'Inscripción actualizada correctamente');
    }

    public function destroy(InscripcionEquipo $inscripcionEquipo)
    {
        $inscripcionEquipo->delete();

        return redirect()->route('inscripcion_equipo.index')->with('success', 'Inscripción eliminada correctamente');
    }
}
