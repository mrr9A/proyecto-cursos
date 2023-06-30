<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // El usuario ha sido autenticado correctamente
        if (Auth::attempt($credentials)) {
            // Regenerar el ID de sesión después de autenticarse
            $request->session()->regenerate();
            if (Auth::user()->rol === 0) {
                // Si el usuario es un administrador, redirigir a la página de administrador
                return redirect('home');
            } elseif (Auth::user()->rol === 1) {
                // El usuario es un usuario normal, redirigir a la página de usuario normal
                // return redirect()->intended('/vistasEmpleados/inicio');
                return redirect('inicioEmpleado');
            }
        }
        // Las credenciales no son válidas
        return back()->withErrors([
            'email' => 'Las credenciales ingresadas no son válidas.',
        ]);
    }


    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
