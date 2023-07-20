<?php

namespace App\Http\Controllers;

use App\Models\PlanesFormacion;
use App\Models\Puesto;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class MatrizController extends Controller
{
    //
    public function index(Request $request)
    {

        $data = [];
        $data = PlanesFormacion::getMatrices($request->buscador, $request->sucursal_id);
        $puestos = Puesto::all();
        $sucursales = Sucursal::all()->where('estado',1);
        return view('cursosplanta.matrices.index', compact('data', 'puestos', 'sucursales'));
    }

    public function show($id)
    {
        $data = PlanesFormacion::getMatrizByUser($id);
        if(!$data){
            return redirect()->back();
        }
        $data=$data[0];
        $opciones = [
            0 => 'reprobado',
            1 => 'aprobado',
            2 => 'progreso',
        ];
        return view('cursosplanta.matrices.show', compact('data', 'opciones'));
    }
}
