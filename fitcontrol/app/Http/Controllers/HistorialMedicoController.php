<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedico;
use App\Models\Usuario;
use Illuminate\Http\Request;

class HistorialMedicoController extends Controller
{
    // Listar todos los historiales
    public function index(Request $request)
{
    $query = HistorialMedico::with('usuario');

    // Filtro por observaciones
    if ($request->filled('search')) {
        $query->where('observaciones', 'LIKE', "%{$request->search}%");
    }

    // Filtro por usuario
    if ($request->filled('usuario')) {
        $query->where('id_usu_fk', $request->usuario);
    }

    // Filtro por fecha mínima
    if ($request->filled('fecha_min')) {
        $query->whereDate('fecha', '>=', $request->fecha_min);
    }

    // Filtro por fecha máxima
    if ($request->filled('fecha_max')) {
        $query->whereDate('fecha', '<=', $request->fecha_max);
    }

    $historiales = $query->paginate(10);

    // Lista de usuarios para el filtro
    $usuarios = Usuario::all();

    return view('historial.index', compact('historiales', 'usuarios'));
}

    // Mostrar formulario de creación
    public function create()
    {
        $usuarios = Usuario::all();
        return view('historial.create', compact('usuarios'));
    }

    // Guardar historial
    public function store(Request $request)
    {
        $request->validate([
            'observaciones' => 'required',
            'fecha' => ['required','date', function($attribute, $value, $fail) {
                if (strtotime($value) < strtotime(date('Y-m-d'))) {
                    $fail('La fecha no puede ser anterior a hoy.');
                }
            }],
            'id_usu_fk' => 'required|exists:usuario,id_usu',
        ]);

        HistorialMedico::create($request->all());

        return redirect()->route('historial.index')->with('success', 'Historial creado correctamente');
    }

    // Mostrar historial específico
    public function show($id)
    {
        $historial = HistorialMedico::with('usuario')->findOrFail($id);
        return view('historial.show', compact('historial'));
    }

    // Formulario de edición
    public function edit($id)
    {
        $historial = HistorialMedico::findOrFail($id);
        $usuarios = Usuario::all();
        return view('historial.edit', compact('historial', 'usuarios'));
    }

    // Actualizar historial
    public function update(Request $request, $id)
    {
        $request->validate([
            'observaciones' => 'required',
            'fecha' => ['required','date', function($attribute, $value, $fail) {
                if (strtotime($value) < strtotime(date('Y-m-d'))) {
                    $fail('La fecha no puede ser anterior a hoy.');
                }
            }],
            'id_usu_fk' => 'required|exists:usuario,id_usu',
        ]);

        $historial = HistorialMedico::findOrFail($id);
        $historial->update($request->all());

        return redirect()->route('historial.index')->with('success', 'Historial actualizado correctamente');
    }

    // Eliminar historial
    public function destroy($id)
    {
        $historial = HistorialMedico::findOrFail($id);
        $historial->delete();

        return redirect()->route('historial.index')->with('success', 'Historial eliminado correctamente');
    }
}
