<?php

namespace App\Http\Controllers;

use App\Models\ModalidadCurso;
use Illuminate\Http\Request;

class ModalidadController extends Controller
{
    //
    public function store(Request $request)
    {
        $modalidadCurso = ModalidadCurso::create([
            "modalidad" => $request->modalidad,
            "estado" => 1,
        ]);

        return redirect()->route("cursos.index")->with("success", "modalidad de curso creado correctamente");
    }
}
