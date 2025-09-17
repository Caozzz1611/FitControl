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
    // ...
    $user = Auth::user();

    // Cambia $user->role a $user->rol para que coincida con tu base de datos
    if (!in_array($user->rol, $roles)) {
        abort(403, 'Acceso no autorizado.');
    }

    return $next($request);
}
}