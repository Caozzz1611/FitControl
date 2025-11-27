<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Usuario::query();

        // Filtro por búsqueda general (nombre, apellido, email)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
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
    // 1. Validar los datos
    $data = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'direccion' => 'nullable|string|max:255',
        'edad' => 'nullable|integer|min:1|max:120',
        'foto_perfil' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Añadí límite y tipos
        'posicion' => 'nullable|string|max:255',
        'categoria' => 'nullable|string|max:255',
        // Exclusión de ID del usuario actual para la regla unique
        'documento_identidad' => 'required|string|unique:usuario,documento_identidad,' . $usuario->id_usu . ',id_usu',
        'tel_usu' => 'nullable|string|between:7,15', // Ajusté la validación de teléfono
        // Exclusión de ID del usuario actual para la regla unique
        'email_usu' => 'required|email|unique:usuario,email_usu,' . $usuario->id_usu . ',id_usu',
        // La contraseña es OPCIONAL al editar. Aplica el patrón solo si está presente.
        'contra_usu' => 'nullable|string|min:6|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{6,}$/',
        'rol' => 'required|in:admin,jugador,entrenador',
    ]);

    // 2. Manejo de la Contraseña
    // Preparamos los datos a actualizar, excluyendo la contraseña
    $dataToUpdate = $request->except('contra_usu'); 
    
    // Verificamos si el usuario ingresó una NUEVA contraseña
    if ($request->filled('contra_usu')) {
        // Si la ingresó, la hasheamos y la añadimos a los datos a actualizar
        $dataToUpdate['contra_usu'] = Hash::make($request->input('contra_usu'));
    } 
    // Si el campo está vacío, $dataToUpdate NO incluye 'contra_usu', manteniendo la anterior.

    // 3. Manejo de la Foto de Perfil
    if ($request->hasFile('foto_perfil')) {
        // Eliminar la foto anterior si existe
        if ($usuario->foto_perfil) {
            Storage::disk('public')->delete($usuario->foto_perfil);
        }
        
        // Guardar la nueva foto
        $path = $request->file('foto_perfil')->store('fotos', 'public');
        $dataToUpdate['foto_perfil'] = $path;
    }


    // 4. Actualizar el modelo
    $usuario->update($dataToUpdate);

    return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado.');
}
    public function destroy(Usuario $usuario)
    {
        try {
            // Eliminar notificaciones relacionadas
            $usuario->notificaciones()->delete();

            // Eliminar estadísticas relacionadas
            $usuario->estadisticasPartido()->delete();

            // Finalmente eliminar el usuario
            $usuario->delete();

            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('usuarios.index')
                    ->with('error', 'No se puede eliminar este usuario porque tiene registros relacionados.');
            }

            throw $e;
        }
    }

    public function show($id)
    {
        // Redirigir o mostrar información si lo deseas
        return redirect()->route('usuarios.index');
    }
}
