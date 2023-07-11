<?php

namespace App\Http\Controllers;

use App\Models\PlanesFormacion;
use App\Models\Puesto;
use Illuminate\Http\Request;

class MatrizController extends Controller
{
    //
    public function index(Request $request)
    {

        $data = [];
        $data = PlanesFormacion::getMatrices($request->buscador);
        $puestos = Puesto::all();
        return view('cursosplanta.matrices.index', compact('data', 'puestos'));
    }

    public function show($id)
    {
        $data = PlanesFormacion::getMatrizByUser($id);
        if(!$data){
            return redirect()->back();
        }
        $data=$data[0];
        $opciones = [
            0 => 'reprovado',
            1 => 'aprovado',
            2 => 'progreso',
        ];
        return view('cursosplanta.matrices.show', compact('data', 'opciones'));
    }
}
