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
        $puesto = $request->buscar;
        // dd($puesto);
        $cursos = Curso::getAllCursos();
        $puestos = Puesto::all();
        $modalidad = ModalidadCurso::all();
        $tipo = TipoCurso::all();
        return view("cursosplanta.cursos.index", compact("cursos", "puestos", "puesto", "modalidad", "tipo"));
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
