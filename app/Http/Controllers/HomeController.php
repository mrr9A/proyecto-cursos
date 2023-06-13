<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Puesto::prueba();
        // dd($request -> $empleados)
        if (!is_null($request->empleados) && $request->empleados == "tecnicos") {
            $data = Puesto::prueba2();
        }

        return view('cursosplanta.home', compact('data'));
    }
}
