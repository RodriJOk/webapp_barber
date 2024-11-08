<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $session_rol = strtolower(session()->get('rol'));

        // Convertimos todos los roles a minúsculas y verificamos si el rol del usuario está en la lista
        $roles = array_map('strtolower', $roles);

        if (!in_array($session_rol, $roles)) {
            toastr()->error('No tienes permisos para acceder a esta página');
            return redirect()->back();
        }

        return $next($request);
    }

}