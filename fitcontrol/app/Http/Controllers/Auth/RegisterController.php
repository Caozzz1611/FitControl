<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Cambiado a Usuario para que coincida con tu tabla
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email_usu' => 'required|string|email|max:255|unique:USUARIO,email_usu',
        'contra_usu' => 'required|string|min:8|confirmed',
    ]);

    try {
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email_usu' => $request->email_usu,
            'contra_usu' => $request->contra_usu, // no hagas Hash::make aquí, ya lo hace el mutador
            'rol' => 'jugador',
        ]);

        if (!$usuario) {
            return back()->withErrors(['msg' => 'No se pudo crear el usuario.']);
        }

    } catch (\Exception $e) {
        return back()->withErrors(['msg' => 'Error al crear usuario: ' . $e->getMessage()]);
    }

    return redirect()->route('login')->with('success', 'Usuario registrado correctamente.');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
}

}
