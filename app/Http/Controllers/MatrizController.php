<?php

namespace App\Http\Controllers;

use App\Models\PlanesFormacion;
use App\Models\Puesto;
use Illuminate\Http\Request;

class MatrizController extends Controller
{
    //
    public function index(){
        $empleados = PlanesFormacion::getMatrizVentas();
        return view('cursosplanta.matrices.index', compact('empleados'));
    }

    public function show(){
        Puesto::prueba();
    }
}
