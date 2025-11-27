<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class TorneoController extends Controller
{
    // Listar torneos
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Torneo::with('equipo');

        // Si es entrenador, solo ve su equipo
        if($user->rol == 'entrenador') {
            $query->where('id_equipo_fk', $user->equipo_id);
        }

        // Filtros de búsqueda
        if ($request->filled('search')) {
            $query->where('nombre', 'LIKE', "%{$request->search}%");
        }

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_inicio', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_fin', '<=', $request->fecha_fin);
        }

        if ($request->filled('equipo') && $user->rol == 'admin') {
            // Solo admin puede filtrar por cualquier equipo
            $query->where('id_equipo_fk', $request->equipo);
        }

        $torneos = $query->get();
        $equipos = Equipo::all();

        return view('torneo.index', compact('torneos', 'equipos'));
    }

    // Mostrar formulario para crear torneo
    public function create()
    {
        $user = Auth::user();
        if($user->rol != 'admin') {
            abort(403, "No autorizado");
        }

        $equipos = Equipo::all();
        $torneo = null;

        return view('torneo.create', compact('torneo', 'equipos'));
    }

    // Guardar nuevo torneo
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->rol != 'admin') {
            abort(403, "No autorizado");
        }

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
        $user = Auth::user();
        if($user->rol != 'admin') {
            abort(403, "No autorizado");
        }

        $equipos = Equipo::all();
        return view('torneo.form', compact('torneo', 'equipos'));
    }

    // Actualizar torneo
    public function update(Request $request, Torneo $torneo)
    {
        $user = Auth::user();
        if($user->rol != 'admin') {
            abort(403, "No autorizado");
        }

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
        $user = Auth::user();
        if($user->rol != 'admin') {
            abort(403, "No autorizado");
        }

        try {
            // Eliminar partidos relacionados
            $torneo->partidos()->delete();

            $torneo->delete();

            return redirect()->route('torneo.index')->with('success', 'Torneo eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000' || $e->getCode() == '1451') {
                return redirect()->route('torneo.index')
                                 ->with('error', 'No se puede eliminar este torneo porque tiene registros relacionados.');
            }
            throw $e;
        }
    }
}
