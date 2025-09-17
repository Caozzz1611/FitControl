<?php

namespace App\Http\Controllers;

use App\Models\Entrenamiento;
use App\Models\Rendimiento;
use Illuminate\Http\Request;

class RendimientoController extends Controller
{
    // Mostrar el formulario para crear un nuevo rendimiento
    public function create()
    {
        // Traer todos los entrenamientos para el select
        $entrenamientos = Entrenamiento::all();

        // Retornar la vista con la variable
        return view('rendimiento.form', compact('entrenamientos'));
    }

    // Guardar un nuevo rendimiento
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'id_entrenamiento_fk' => 'required|exists:entrenamientos,id_entrenamiento',
            // Agrega aquí las otras validaciones según tu tabla rendimiento
            // Ejemplo:
            //'campo1' => 'required|string',
            //'campo2' => 'numeric',
        ]);

        // Crear el rendimiento con los datos del request
        Rendimiento::create($request->all());

        // Redireccionar a donde quieras con mensaje
        return redirect()->route('rendimiento.index')->with('success', 'Rendimiento creado correctamente.');
    }

    // Opcional: método para listar rendimientos
    public function index()
    {
        $rendimientos = Rendimiento::with('entrenamiento')->get();
        return view('rendimiento.index', compact('rendimientos'));
    }
}
