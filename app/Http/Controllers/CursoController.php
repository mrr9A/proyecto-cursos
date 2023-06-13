<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Puesto;
use App\Models\ModalidadCurso;
use App\Models\TipoCurso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    //
    public function index(Request $request)
    {
        $puesto = $request->puesto_id;
        $opcionSeleccionada = null;
        // dd($puesto);
        $cursos = Curso::getAllCursos();
        if (!is_null($puesto)) {
            echo "<script>console.log($puesto)</script>";
            $cursos = Curso::getCursesByPuesto(intval($puesto));
        }
        $puestos = Puesto::all();
        $modalidad = ModalidadCurso::all();
        $tipo = TipoCurso::all();
        return view("cursosplanta.cursos.index", compact("cursos", "puestos", "puesto", "modalidad", "tipo", "opcionSeleccionada"));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $curso = Curso::create([
            "nombre" => $request->nombre,
            "codigo" => $request->codigo,
            "estado" => 1,
            "modalidad_id" => $request->modalidad_id,
            "tipo_curso_id" => $request->tipo_id,
        ]);

        return redirect()->route("cursos.index")->with("status", "curso creado correctamente");
    }
}
