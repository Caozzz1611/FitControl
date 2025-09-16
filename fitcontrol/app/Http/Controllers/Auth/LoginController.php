<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'email_usu' => 'required|email',
            'contra_usu' => 'required',
        ]);

        // Buscar usuario por email
        $usuario = Usuario::where('email_usu', $request->email_usu)->first();

        if ($usuario && Hash::check($request->contra_usu, $usuario->contra_usu)) {
            
            // Loguear usuario manualmente (sin usar Auth::attempt)
            session(['usuario_id' => $usuario->id_usu, 'rol' => $usuario->rol, 'nombre' => $usuario->nombre]);

            // Redireccionar según rol
            switch ($usuario->rol) {
                case 'admin':
                    return redirect()->route('dashboard');
                case 'jugador':
                    return redirect()->route('jugador.dashboard');
                case 'entrenador':
                    return redirect()->route('entrenador.dashboard');
                default:
                    return redirect()->route('login')->with('error', 'Rol no válido.');
            }

        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas.');
        }
    }

    // Cerrar sesión
    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
