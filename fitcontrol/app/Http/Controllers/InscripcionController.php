<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Usuario;
use App\Models\Torneo;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with(['usuario', 'torneo'])->get();
        return view('inscripcion.index', compact('inscripciones'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $torneos = Torneo::all();
        return view('inscripcion.create', compact('usuarios', 'torneos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usu_fk' => 'required|exists:usuario,id_usu',
            'id_torneo_fk' => 'required|exists:torneo,id_torneo',
            'fecha_inscripcion' => 'required|date',
            'estado' => 'required|string|max:20',
        ]);

        Inscripcion::create($request->all());

        return redirect()->route('inscripcion.index')->with('success', 'Inscripción creada correctamente.');
    }

    public function edit(Inscripcion $inscripcion)
    {
        $usuarios = Usuario::all();
        $torneos = Torneo::all();
        return view('inscripcion.edit', compact('inscripcion', 'usuarios', 'torneos'));
    }

    public function update(Request $request, Inscripcion $inscripcion)
    {
        $request->validate([
            'id_usu_fk' => 'required|exists:usuario,id_usu',
            'id_torneo_fk' => 'required|exists:torneo,id_torneo',
            'fecha_inscripcion' => 'required|date',
            'estado' => 'required|string|max:20',
        ]);

        $inscripcion->update($request->all());

        return redirect()->route('inscripcion.index')->with('success', 'Inscripción actualizada correctamente.');
    }

    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();

        return redirect()->route('inscripcion.index')->with('success', 'Inscripción eliminada correctamente.');
    }
}
