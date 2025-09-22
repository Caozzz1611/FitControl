<?php

namespace App\Http\Controllers;

use App\Models\InscripcionEquipo;
use App\Models\Usuario;
use App\Models\Equipo;
use Barryvdh\DomPDF\Facade as PDF; // Asegúrate de importar correctamente la clase PDF
use Illuminate\Http\Request;

class InscripcionEquipoController extends Controller
{
    // Método para mostrar las inscripciones con filtros y paginación
    public function index(Request $request)
    {
        $query = InscripcionEquipo::with(['usuario', 'equipo']);
        
        // Filtro por usuario
        if ($request->filled('usuario')) {
            $query->whereHas('usuario', function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->usuario . '%');
            });
        }

        // Filtro por equipo
        if ($request->filled('equipo')) {
            $query->whereHas('equipo', function($q) use ($request) {
                $q->where('nombre_equipo', 'like', '%' . $request->equipo . '%');
            });
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Filtro por fecha de inscripción
        if ($request->filled('fecha_inscripcion')) {
            $query->whereDate('fecha_inscripcion', $request->fecha_inscripcion);
        }

        // Paginación
        $inscripciones = $query->paginate(10);

        return view('inscripcion_equipo.index', compact('inscripciones'));
    }

    // Método para mostrar el formulario de creación de una nueva inscripción
    public function create()
    {
        $usuarios = Usuario::all();
        $equipos = Equipo::all();
        return view('inscripcion_equipo.create', compact('usuarios', 'equipos'));
    }

    // Método para almacenar una nueva inscripción
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

    // Método para editar una inscripción existente
    public function edit(InscripcionEquipo $inscripcionEquipo)
    {
        $usuarios = Usuario::all();
        $equipos = Equipo::all();

        return view('inscripcion_equipo.edit', [
            'inscripcion_equipo' => $inscripcionEquipo,
            'usuarios' => $usuarios,
            'equipos' => $equipos,
        ]);
    }

    // Método para actualizar una inscripción existente
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

    // Método para eliminar una inscripción
    public function destroy(InscripcionEquipo $inscripcionEquipo)
    {
        $inscripcionEquipo->delete();

        return redirect()->route('inscripcion_equipo.index')->with('success', 'Inscripción eliminada correctamente');
    }

   
}
