<?php
namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Torneo;
use App\Models\Equipo;
use Illuminate\Http\Request;

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
        $partido->delete();
        return redirect()->route('partido.index')->with('success', 'Partido eliminado correctamente');
    }
}
