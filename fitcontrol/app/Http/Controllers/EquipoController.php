<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::all();
        return view('equipo.index', compact('equipos'));
    }

    public function create()
    {
        return view('equipo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_equipo' => 'required|string|max:100',
            'logo_equipo' => 'nullable|string|max:100',
            'ubi_equipo' => 'nullable|string|max:200',
            'contacto_equipo' => 'nullable|numeric',
            'categoria_equipo' => 'nullable|numeric',
        ]);

        Equipo::create($request->all());

        return redirect()->route('equipo.index')->with('success', 'Equipo creado correctamente');
    }

    public function edit($id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('equipo.edit', compact('equipo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_equipo' => 'required|string|max:100',
            'logo_equipo' => 'nullable|string|max:100',
            'ubi_equipo' => 'nullable|string|max:200',
            'contacto_equipo' => 'nullable|numeric',
            'categoria_equipo' => 'nullable|numeric',
        ]);

        $equipo = Equipo::findOrFail($id);
        $equipo->update($request->all());

        return redirect()->route('equipo.index')->with('success', 'Equipo actualizado correctamente');
    }

    public function destroy($id)
{
    try {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();

        return redirect()->route('equipo.index')
                         ->with('success', 'Equipo eliminado correctamente.');
    } catch (\Illuminate\Database\QueryException $e) {
        // Esto captura el error de restricción FK
        return redirect()->route('equipo.index')
                         ->with('error', 'No se puede eliminar el equipo porque tiene registros relacionados.');
    }
}
}
