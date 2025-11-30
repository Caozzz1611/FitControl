<?php

namespace App\Http\Controllers;

use App\Models\Entrenamiento;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Exports\EntrenamientoExport;
use Maatwebsite\Excel\Facades\Excel;





class EntrenamientoController extends Controller
{

public function index(Request $request)
{
    $equipos = Equipo::all();

    $query = Entrenamiento::with('equipo');

    if ($request->filled('fecha')) {
        $query->where('fecha', 'like', '%' . $request->fecha . '%');
    }

    if ($request->filled('hora')) {
        $query->where('hora', 'like', '%' . $request->hora . '%');
    }

    if ($request->filled('ubicacion')) {
        $query->where('ubicacion', 'like', '%' . $request->ubicacion . '%');
    }

    if ($request->filled('equipo')) {
        $query->whereHas('equipo', function ($q) use ($request) {
            $q->where('nombre_equipo', 'like', '%' . $request->equipo . '%');
        });
    }

    $entrenamientos = $query->get();
    $entrenamiento = null; // si no estás en modo edición

    return view('entrenamiento.index', compact('equipos', 'entrenamientos', 'entrenamiento'));
}


    public function create()
    {
        $equipos = Equipo::all();
        return view('entrenamiento.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'ubicacion' => 'required|string|max:100',
            'id_equipo_fk' => 'required|exists:equipo,id_equipo',
        ]);

        Entrenamiento::create($request->all());

        return redirect()->route('entrenamiento.index')->with('success', 'Entrenamiento creado correctamente.');
    }

    public function edit(Entrenamiento $entrenamiento)
    {
        $equipos = Equipo::all();
        return view('entrenamiento.edit', compact('entrenamiento', 'equipos'));
    }

    public function update(Request $request, Entrenamiento $entrenamiento)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'ubicacion' => 'required|string|max:100',
            'id_equipo_fk' => 'required|exists:equipo,id_equipo',
        ]);

        $entrenamiento->update($request->all());

        return redirect()->route('entrenamiento.index')->with('success', 'Entrenamiento actualizado correctamente.');
    }

   public function destroy($id)
{
    try {
        $entrenamiento = Entrenamiento::findOrFail($id);
        $entrenamiento->delete();

        return redirect()->route('entrenamiento.index')
            ->with('success', 'Entrenamiento eliminado correctamente.');
    } catch (QueryException $e) {
        // Aquí detectamos si el error es por restricción de clave foránea
        if ($e->getCode() == '23000') { // código para violación de integridad
            return redirect()->route('entrenamiento.index')
                ->with('error', 'No se puede eliminar este entrenamiento porque tiene registros relacionados.');
        }
        // Para otros errores, puedes lanzar la excepción o manejarla diferente
        throw $e;
    }
}

//excel

public function export()
{
    $user = auth()->user();
    $userId = ($user->rol !== 'admin') ? $user->id_usu : null; // Si es entrenador, solo los suyos

    return Excel::download(new EntrenamientoExport($userId), 'entrenamientos.xlsx');
}
}