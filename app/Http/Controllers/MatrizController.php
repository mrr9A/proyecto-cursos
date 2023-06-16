<?php

namespace App\Http\Controllers;

use App\Models\PlanesFormacion;
use App\Models\Puesto;
use Illuminate\Http\Request;

class MatrizController extends Controller
{
    //
    public function index(Request $request){
        $empleados = PlanesFormacion::getMatrizVentas();
        if($request->q === "tecnico"){
            $empleados = PlanesFormacion::getMatrizTecnica();
        }
        return view('cursosplanta.matrices.index', compact('empleados'));
    }

    public function show(){
        Puesto::prueba();
    }
}
