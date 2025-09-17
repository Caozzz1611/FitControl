<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email_usu', 'contra_usu');

        if (Auth::attempt([
            'email_usu' => $credentials['email_usu'],
            'password' => $credentials['contra_usu']
        ])) {
            $usuario = Auth::user();

            // Validar según rol
            if ($usuario->rol === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($usuario->rol === 'jugador') {
                return redirect()->route('jugador.dashboard');
            } elseif ($usuario->rol === 'entrenador') {
                return redirect()->route('entrenador.dashboard');
            }
        }

        return back()->withErrors([
            'email_usu' => 'Credenciales incorrectas',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
