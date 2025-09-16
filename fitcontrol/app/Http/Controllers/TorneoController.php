<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use App\Models\Equipo;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    public function index()
    {
        $torneos = Torneo::with('equipo')->get();
        return view('torneo.index', compact('torneos'));
    }

    public function create()
    {
        $equipos = Equipo::all();
        return view('torneo.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'premio' => 'required|numeric',
            'descripcion' => 'nullable|string|max:200',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'id_equipo_fk' => 'required|exists:EQUIPO,id_equipo',
        ]);

        Torneo::create($request->all());

        return redirect()->route('torneo.index')->with('success', 'Torneo creado correctamente.');
    }

    public function edit(Torneo $torneo)
    {
        $equipos = Equipo::all();
        return view('torneo.edit', compact('torneo', 'equipos'));
    }

    public function update(Request $request, Torneo $torneo)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'premio' => 'required|numeric',
            'descripcion' => 'nullable|string|max:200',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'id_equipo_fk' => 'required|exists:EQUIPO,id_equipo',
        ]);

        $torneo->update($request->all());

        return redirect()->route('torneo.index')->with('success', 'Torneo actualizado correctamente.');
    }

    public function destroy(Torneo $torneo)
    {
        $torneo->delete();
        return redirect()->route('torneo.index')->with('success', 'Torneo eliminado correctamente.');
    }
}
