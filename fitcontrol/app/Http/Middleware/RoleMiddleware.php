<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        // Verifica si hay usuario autenticado
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        // Verifica si el rol del usuario está en los permitidos
        if (!in_array($user->rol, $roles)) {
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
