<?php

namespace App\Http\Controllers;

use App\Models\PlanesFormacion;
use App\Models\Puesto;
use Illuminate\Http\Request;

class MatrizController extends Controller
{
    //
    public function index(Request $request){

        $data = [];
        if($request->q === "tecnico"){
            $data = PlanesFormacion::getMatrizTecnica($request->buscador);
        }else{
            $data = PlanesFormacion::getMatrizVentas($request->buscador);
        }
        $puestos = Puesto::all();
        return view('cursosplanta.matrices.index', compact('data', 'puestos'));
    }

    public function show(){
        Puesto::prueba();
    }
}
