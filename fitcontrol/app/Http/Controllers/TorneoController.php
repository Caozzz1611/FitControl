<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use App\Models\Equipo;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    // Mostrar listado de torneos
    public function index()
    {
        // Cargar torneos con su equipo relacionado para mostrar datos
        $torneos = Torneo::with('equipo')->get();
        return view('torneo.index', compact('torneos'));
    }

    // Mostrar formulario para crear un nuevo torneo
public function create()
{
    $equipos = Equipo::all();  // O la consulta que uses
    $torneo = null;
    return view('torneo.create', compact('torneo', 'equipos'));
}

    // Guardar nuevo torneo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'premio' => 'nullable|numeric',
            'descripcion' => 'nullable|string|max:200',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'id_equipo_fk' => 'required|exists:equipo,id_equipo',
        ]);

        Torneo::create($request->all());

        return redirect()->route('torneo.index')->with('success', 'Torneo creado correctamente.');
    }

    // Mostrar formulario para editar torneo
    public function edit(Torneo $torneo)
    {
        $equipos = Equipo::all();
        return view('torneo.form', compact('torneo', 'equipos'));
    }

    // Actualizar torneo
    public function update(Request $request, Torneo $torneo)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'premio' => 'nullable|numeric',
            'descripcion' => 'nullable|string|max:200',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'id_equipo_fk' => 'required|exists:equipo,id_equipo',
        ]);

        $torneo->update($request->all());

        return redirect()->route('torneo.index')->with('success', 'Torneo actualizado correctamente.');
    }

    // Eliminar torneo
public function destroy(Torneo $torneo)
{
    try {
        // Eliminar partidos relacionados
        $torneo->partidos()->delete();

        // Luego eliminar el torneo
        $torneo->delete();

        return redirect()->route('torneo.index')->with('success', 'Torneo eliminado correctamente.');
    } catch (QueryException $e) {
        if ($e->getCode() == '23000') {
            return redirect()->route('torneo.index')->with('error', 'No se puede eliminar este torneo porque tiene registros relacionados.');
        }
        throw $e;
    }
}

}
