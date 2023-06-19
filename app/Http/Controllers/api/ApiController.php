<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Puesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //
    public function buscar(Request $request){

        // $resultados = DB::table('cursos as c')
        // ->select("c.nombre as nombre")
        // ->join("tipo_cursos as tc", "c.tipo_curso_id", "=", "tc.id_tipo_curso")
        // ->where(function($q) use($request){
        //     $q->where('c.nombre', 'like', $request->buscar."%")
        //       ->orWhere('tc.nombre', 'like', $request->buscar."%")
        //       ->orWhere('c.codigo', 'like', $request->buscar."%");
        //  })->get();

        $resultados = Puesto::progresoEmpleados($request->buscar);
        // $resultados->toArray();
        return response()->json($resultados);
    }
}
