<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\PlanesFormacion;
use App\Models\Puesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanFormacionController extends Controller
{
    //
    public function index()
    {
        $planesFormacion = PlanesFormacion::all();
        $puestos = PlanesFormacion::with('puestos')->get();
        $cursos = Curso::getAllCursos();
        $puestos = Puesto::all();
        return view('cursosplanta.planes.index', compact("planesFormacion", "puestos", "cursos"));
    }

    public function store(Request $request)
    {
        $data = array();
        if (is_null($request->trabajos)) {
            foreach ($request->cursos as $curso) {
                $consulta = [
                    "curso_id" => $curso,
                    "puesto_id" => $request->puesto_id
                ];
                array_push($data, $consulta);
            }
            DB::table("puestos_cursos")->insert($data);
            return redirect()->route("matrices.index")->with('status', 'cursos agregados correctamente');
        }


        foreach ($request->trabajos as $trabajo) {
            $trabajo_id = $trabajo;
            foreach ($request->cursos as $curso) {
                $consulta = [
                    "curso_id" => $curso,
                    "trabajo_id" => $trabajo_id
                ];
                array_push($data, $consulta);
            }
        }
        DB::table("trabajos_cursos")->insert($data);
        return redirect()->route("matrices.index")->with('status', 'cursos agregados correctamente');
    }

    public function create()
    {
        $cursos = Curso::getAllCursos();
        $puestos = Puesto::all();
        return view('cursosplanta.puestosCursos.create', compact("cursos", "puestos"));
    }
}
