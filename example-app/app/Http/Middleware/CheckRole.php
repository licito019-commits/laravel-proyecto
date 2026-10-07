<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Uso en rutas: Route::get(...)->middleware('role:administrador')
     * Puedes pasar varios roles separados por coma: 'role:empleado,administrador'
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user() || ! in_array($request->user()->role, $roles)) {
            abort(403, 'No tienes permiso para ver esta página.');
        }

        return $next($request);
    }
}