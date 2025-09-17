<?php

namespace App\Http\Controllers;

use App\Models\EstadisticaPartido;
use App\Models\Partido;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Entrenamiento; 

class EstadisticaPartidoController extends Controller
{
    public function index()
    {
        $estadisticas = EstadisticaPartido::with(['partido', 'usuario'])->get();
        return view('estadistica_partido.index', compact('estadisticas'));
    }

  public function create()
{
    $partidos = Partido::all();
    $usuarios = Usuario::all();
    $entrenamientos = Entrenamiento::all(); // <--- esta línea es clave

    return view('estadistica_partido.create', compact('partidos', 'usuarios', 'entrenamientos'));
}
    public function store(Request $request)
    {
        $request->validate([
            'goles' => 'required|integer',
            'asistencias' => 'required|integer',
            'tarjetas_amarillas' => 'required|integer',
            'tarjetas_rojas' => 'required|integer',
            'id_partido_fk' => 'required|exists:PARTIDO,id_partido',
            'id_usu_fk' => 'required|exists:USUARIO,id_usu',
        ]);

        EstadisticaPartido::create($request->all());

        return redirect()->route('estadistica_partido.index')->with('success', 'Estadística creada correctamente.');
    }

    public function edit(EstadisticaPartido $estadisticaPartido)
{
    $partidos = Partido::all();
    $usuarios = Usuario::all();
    $estadistica = $estadisticaPartido; // asignamos el nombre que usas en la vista
    return view('estadistica_partido.edit', compact('estadistica', 'partidos', 'usuarios'));
}
    public function update(Request $request, EstadisticaPartido $estadisticaPartido)
    {
        $request->validate([
            'goles' => 'required|integer',
            'asistencias' => 'required|integer',
            'tarjetas_amarillas' => 'required|integer',
            'tarjetas_rojas' => 'required|integer',
            'id_partido_fk' => 'required|exists:PARTIDO,id_partido',
            'id_usu_fk' => 'required|exists:USUARIO,id_usu',
        ]);

        $estadisticaPartido->update($request->all());

        return redirect()->route('estadistica_partido.index')->with('success', 'Estadística actualizada correctamente.');
    }

    public function destroy(EstadisticaPartido $estadisticaPartido)
    {
        $estadisticaPartido->delete();
        return redirect()->route('estadistica_partido.index')->with('success', 'Estadística eliminada correctamente.');
    }
}
