<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePlanFormacionRequest;
use App\Models\Curso;
use App\Models\PlanesFormacion;
use App\Models\Puesto;
use App\Models\User;
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
        $cursosYaCalificados = DB::table('calificaciones')->whereIn('usuario_id', function ($query) use ($trabajo_id) {
            $query->select('usuarios.id_usuario')
                ->from('usuarios')
                ->join('usuarios_trabajos', 'usuarios_trabajos.usuario_id', '=', 'usuarios.id_usuario')
                ->where('usuarios_trabajos.trabajo_id', $trabajo_id);
        })->pluck('curso_id');


        $cursos = $request->cursos;
        // $resultArray = array_diff($cursos, $cursosYaCalificados);

        $data = array();
        foreach ($cursos as $curso) {
            $consulta = [
                "curso_id" => $curso,
                "trabajo_id" => $trabajo_id
            ];
            array_push($data, $consulta);
        }

        

        DB::table('trabajos_cursos')->where('trabajo_id', $trabajo_id)->whereIn('curso_id', $cursosYaCalificados)->delete();

        DB::table("trabajos_cursos")->insertOrIgnore($data);
        return redirect()->back()->with('success', 'cursos agregados correctamente');
    }
}