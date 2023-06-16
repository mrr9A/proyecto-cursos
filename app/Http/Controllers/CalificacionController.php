<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalificacionController extends Controller
{
    //

    public function store(Request $request)
    {
        $cursos = $request->cursos;
        // "usuario_id:{{ $id }}-curso_id:{{ $curso->id_curso }}"
        $calificaciones = array();
        foreach ($cursos as $curso) {
            $cadena = $curso;
            $pares = explode("-", $cadena);
            $resultado = array();
            foreach ($pares as $par) {
                list($clave, $valor) = explode(":", $par);
                $resultado[$clave] = $valor;
                $resultado["estado"] = 1;
                $resultado["valor"] = "aprovado";
            }

            array_push($calificaciones, $resultado);
            
        }

        DB::table("calificaciones")->insert($calificaciones);
        return to_route("matrices.index");
    }
}
