<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
  public function index(Request $request)
{
    $query = Usuario::query();

    // Filtro por búsqueda general (nombre, apellido, email)
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('nombre', 'LIKE', "%{$search}%")
              ->orWhere('apellido', 'LIKE', "%{$search}%")
              ->orWhere('email_usu', 'LIKE', "%{$search}%");
        });
    }

    // Filtro por rol
    if ($request->filled('rol')) {
        $query->where('rol', $request->rol);
    }

    // Filtro por edad mínima y máxima
    if ($request->filled('edad_min')) {
        $query->where('edad', '>=', $request->edad_min);
    }

    if ($request->filled('edad_max')) {
        $query->where('edad', '<=', $request->edad_max);
    }

    // Obtener resultados
    $usuarios = $query->get(); // O paginate(10) si quieres paginación

    return view('usuarios.index', compact('usuarios'));
}




public function create()
{
    $usuario = new Usuario(); // modelo vacío
    return view('usuarios.create', compact('usuario'));
}


    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'nullable',
            'edad' => 'nullable|integer',
            'foto_perfil' => 'nullable|image|mimes:jpg,png,jpeg',
            'posicion' => 'nullable',
            'categoria' => 'nullable',
            'documento_identidad' => 'required|unique:usuario',
            'tel_usu' => 'nullable',
            'email_usu' => 'required|email|unique:usuario',
            'contra_usu' => 'nullable',
            'rol' => 'required|in:admin,jugador,entrenador',

        ]);

        if ($request->hasFile('foto_perfil')) {
            $data['foto_perfil'] = $request->file('foto_perfil')->store('fotos', 'public');
        }

        Usuario::create($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'nullable',
            'edad' => 'nullable|integer',
            'foto_perfil' => 'nullable|image|mimes:jpg,png,jpeg',
            'posicion' => 'nullable',
            'categoria' => 'nullable',
            'documento_identidad' => 'required|unique:usuario,documento_identidad,' . $usuario->id_usu . ',id_usu',
            'tel_usu' => 'nullable',
            'email_usu' => 'required|email|unique:usuario,email_usu,' . $usuario->id_usu . ',id_usu',
            'contra_usu' => 'required',
            'rol' => 'required|in:admin,jugador,entrenador',

        ]);

        if ($request->hasFile('foto_perfil')) {
            $data['foto_perfil'] = $request->file('foto_perfil')->store('fotos', 'public');
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('error', 'Usuario eliminado.');
    }
    public function show($id)
{
    // Si no quieres mostrar nada, puedes redirigir
    return redirect()->route('usuarios.index');
}

}
