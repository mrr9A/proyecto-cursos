<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePlanFormacionRequest;
use App\Models\Curso;
use App\Models\PlanesFormacion;
use App\Models\Puesto;
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

    public function store(SavePlanFormacionRequest $request)
    {
        $trabajo_id = $request->trabajo_id;
        $data = array();
        foreach ($request->cursos as $curso) {
            $consulta = [
                "curso_id" => $curso,
                "trabajo_id" => $trabajo_id
            ];
            array_push($data, $consulta);
        }

        DB::table('trabajos_cursos')->where('trabajo_id', '=', $trabajo_id)->delete();
        DB::table("trabajos_cursos")->insertOrIgnore($data);
        return redirect()->back()->with('status', 'cursos agregados correctamente');
    }
}
