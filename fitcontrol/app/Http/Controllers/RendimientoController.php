<?php

namespace App\Http\Controllers;

use App\Models\Rendimiento;
use App\Models\Usuario;
use App\Models\Entrenamiento;
use Illuminate\Http\Request;

class RendimientoController extends Controller
{
    public function index()
    {
        $rendimientos = Rendimiento::with(['usuario', 'entrenamiento'])->paginate(10);
        return view('rendimiento.index', compact('rendimientos'));
    }

   public function create() {
    $usuarios = Usuario::all();
    $entrenamientos = Entrenamiento::all();
    return view('rendimiento.create', compact('usuarios', 'entrenamientos'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'evaluacion' => 'required|string|max:100',
            'comentarios' => 'nullable|string|max:80',
            'id_usu_fk' => 'required|exists:usuario,id_usu',
            'id_entrenamiento_fk' => 'required|exists:entrenamiento,id_entrenamiento',
        ]);

        Rendimiento::create($validated);

        return redirect()->route('rendimiento.index')->with('success', 'Rendimiento creado correctamente.');
    }

    
public function edit(Rendimiento $rendimiento) {
    $usuarios = Usuario::all();
    $entrenamientos = Entrenamiento::all();
    return view('rendimiento.edit', compact('rendimiento', 'usuarios', 'entrenamientos'));
}

    public function update(Request $request, Rendimiento $rendimiento)
    {
        $validated = $request->validate([
            'evaluacion' => 'required|string|max:100',
            'comentarios' => 'nullable|string|max:80',
            'id_usu_fk' => 'required|exists:usuario,id_usu',
            'id_entrenamiento_fk' => 'required|exists:entrenamiento,id_entrenamiento',
        ]);

        $rendimiento->update($validated);

        return redirect()->route('rendimiento.index')->with('success', 'Rendimiento actualizado correctamente.');
    }

    public function destroy(Rendimiento $rendimiento)
    {
        $rendimiento->delete();
        return redirect()->route('rendimiento.index')->with('success', 'Rendimiento eliminado correctamente.');
    }
}
