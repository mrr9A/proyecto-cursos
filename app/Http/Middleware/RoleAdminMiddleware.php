<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }


    public function handle($request, Closure $next)
    {
        $rol=0;
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Verificar el rol del usuario
        $user = Auth::user();
        if ($user->rol != $rol) {
            // El usuario no tiene el rol adecuado, redirigir a una página de acceso denegado o mostrar un error
            abort(403, 'Acceso denegado');
        }

        // El usuario tiene el rol adecuado, permitir el acceso a la ruta
        return $next($request);
    }
}
