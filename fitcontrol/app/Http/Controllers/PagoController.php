<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PagoController extends Controller
{


public function index(Request $request)
{
    $query = Pago::with('usuario');

    // Filtro por fecha de pago
    if ($request->filled('fecha_pago')) {
        $query->whereDate('fecha_pago', $request->fecha_pago);
    }

    // Filtro por estado
    if ($request->filled('estado')) {
        $query->where('estado', $request->estado);
    }

    // Filtro por nombre del usuario
    if ($request->filled('usuario')) {
        $query->whereHas('usuario', function($q) use ($request) {
            $q->where('nombre', 'like', '%' . $request->usuario . '%');
        });
    }

    // Paginación
    $pagos = $query->paginate(10);

    return view('pago.index', compact('pagos'));
}


    public function create()
    {
        $usuarios = Usuario::all();
        return view('pago.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric',
            'estado' => 'required|in:pagado,completado,pendiente',
            'id_usu_fk' => 'required|exists:usuario,id_usu',
            'recibo_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = $request->all();

        // Si suben archivo pdf lo guardamos en storage y guardamos la ruta
        if ($request->hasFile('recibo_pdf')) {
            $file = $request->file('recibo_pdf');
            $path = $file->store('recibos', 'public');  // Carpeta storage/app/public/recibos
            $data['recibo_pdf'] = $path;
        }

        Pago::create($data);

        return redirect()->route('pago.index')->with('success', 'Pago creado correctamente.');
    }

    public function edit(Pago $pago)
    {
        $usuarios = Usuario::all();
        return view('pago.edit', compact('pago', 'usuarios'));
    }

    public function update(Request $request, Pago $pago)
    {
        $request->validate([
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric',
            'estado' => 'required|in:pagado,completado,pendiente',
            'id_usu_fk' => 'required|exists:usuario,id_usu',
            'recibo_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('recibo_pdf')) {
            $file = $request->file('recibo_pdf');
            $path = $file->store('recibos', 'public');
            $data['recibo_pdf'] = $path;
        }

        $pago->update($data);

        return redirect()->route('pago.index')->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy(Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pago.index')->with('success', 'Pago eliminado correctamente.');
    }
}
