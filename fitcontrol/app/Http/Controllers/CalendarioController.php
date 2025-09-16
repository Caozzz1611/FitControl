<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partido;

class CalendarioController extends Controller
{
    public function index()
    {
        return view('calendario.index');
    }

    public function eventos()
    {
        // Traemos los partidos con su equipo relacionado
        $partidos = Partido::with('equipo')->get();

        $eventos = $partidos->map(function ($partido) {
            return [
                'title' => $partido->equipo->nombre_equipo . ' 🆚 ' . $partido->rival,
                'start' => $partido->fecha . 'T' . $partido->hora,
                'equipo' => $partido->equipo->nombre_equipo ?? 'N/A',
                'rival' => $partido->rival ?? 'N/A',
            ];
        });

        return response()->json($eventos);
    }
}
