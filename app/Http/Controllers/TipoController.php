<?php

namespace App\Http\Controllers;

use App\Models\TipoCurso;
use App\Models\Trabajo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function store(Request $request)
    {

        $tipoCurso = TipoCurso::create([
            "nombre" => $request->nombre,
            "estado" => 1,
            "duracion" => $request->duracion,
        ]);

        return redirect()->route("cursos.index")->with("status", "tipo de curso creado correctamente");
    }
}
