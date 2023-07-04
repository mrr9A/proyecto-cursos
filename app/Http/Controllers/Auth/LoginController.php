<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        /**
         * va a verificar email y password 
         * con la de la base de datos
         * y devuelve un booleano, como segundo parametro
         * recibe un boolean para indicarle si 
         * queremos recordar la sesion o no
         * para eso utlizamos el checkbox de recuerdame
         */
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed')
            ]);
        }

        $user = Auth::user();
        if (!$user->estado) {
            // El usuario no está activo, mostrar mensaje de error
            return back()->withErrors([
                'email' => 'El usuario no está activo.',
            ]);
        }


        if (auth()->user()->role == 0) {
            // retornar a vista administrador
            return to_route('home');
        }

        $request->session()->regenerate();

        return redirect()->intended()
            ->with('status', 'Inicio de sesion correcto');
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // // Evitar que el usuario retroceda en el historial
        // $request->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        // $request->headers->set('Pragma', 'no-cache');
        // $request->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return to_route('home')
            ->with('status', 'Cerrando sesion');
    }
}
