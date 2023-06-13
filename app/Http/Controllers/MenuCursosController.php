<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\ModalidadCurso;
use App\Models\Puesto;
use App\Models\TipoCurso;
use Illuminate\Http\Request;

class MenuCursosController extends Controller
{
    //
    public function opcion1()
    {
        $opcionSeleccionada = 'cursosplanta.trabajos.index';
        $puesto = 1;
        $cursos = Curso::getAllCursos();
        $puestos = Puesto::all();
        $modalidad = ModalidadCurso::all();
        $tipo = TipoCurso::all();
        return view("cursosplanta.cursos.index", compact("cursos", "puestos", "puesto", "modalidad", "tipo","opcionSeleccionada"));
    }

    public function opcion2()
    {
        $opcionSeleccionada = 'cursosplanta.cursos.create';
        $puesto = 1;
        $cursos = Curso::getAllCursos();
        $puestos = Puesto::all();
        $modalidad = ModalidadCurso::all();
        $tipo = TipoCurso::all();
        return view("cursosplanta.cursos.index", compact("cursos", "puestos", "puesto", "modalidad", "tipo","opcionSeleccionada"));
    }
}
