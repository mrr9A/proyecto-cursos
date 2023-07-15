<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;

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

        $resultados = User::progresoEmpleados($request->buscar);
        // $resultados->toArray();
        return response()->json($resultados);
    }

    public function searchCursos(Request $request){
        $buscar = $request->buscador;
        $data = Curso::getAllCursos($buscar, false);

        return response()->json($data, 200);
    }
}
