<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partido;
use App\Models\EstadisticaPartido;
use App\Models\Torneo;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PartidoController extends Controller
{
    public function index()
    {
        $partidos = Partido::with(['torneo', 'equipo'])->get();
        return view('partido.index', compact('partidos'));
    }

    public function create()
    {
        $torneos = Torneo::all();
        $equipos = Equipo::all();
        return view('partido.create', compact('torneos', 'equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'rival' => 'required|string|max:100',
            'resultado' => 'nullable|string|max:50',
            'id_torneo_fk' => 'required|exists:TORNEO,id_torneo',
            'id_equipo_fk' => 'required|exists:EQUIPO,id_equipo',
        ]);

        Partido::create($request->all());
        return redirect()->route('partido.index')->with('success', 'Partido creado correctamente');
    }

    public function edit(Partido $partido)
    {
        $torneos = Torneo::all();
        $equipos = Equipo::all();
        return view('partido.edit', compact('partido','torneos','equipos'));
    }

    public function update(Request $request, Partido $partido)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'rival' => 'required|string|max:100',
            'resultado' => 'nullable|string|max:50',
            'id_torneo_fk' => 'required|exists:TORNEO,id_torneo',
            'id_equipo_fk' => 'required|exists:EQUIPO,id_equipo',
        ]);

        $partido->update($request->all());
        return redirect()->route('partido.index')->with('success', 'Partido actualizado correctamente');
    }

    public function destroy(Partido $partido)
    {
        try {
            // Verificar si existen estadísticas relacionadas con este partido
            $estadisticas = EstadisticaPartido::where('id_partido_fk', $partido->id_partido)->count();

            if ($estadisticas > 0) {
                // Si existen estadísticas, muestra el mensaje de error y no elimina el partido
                return redirect()->route('partido.index')
                    ->with('error', 'No se puede eliminar este partido porque tiene estadísticas asociadas.');
            }

            // Si no existen estadísticas, proceder con la eliminación del partido
            $partido->delete();
            return redirect()->route('partido.index')
                ->with('success', 'Partido eliminado correctamente');
        } catch (QueryException $e) {
            // Captura cualquier error de base de datos y muestra un mensaje de error
            return redirect()->route('partido.index')
                ->with('error', 'Error al intentar eliminar el partido: ' . $e->getMessage());
        }
    }
}
