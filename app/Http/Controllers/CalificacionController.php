<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalificacionController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate(['cursos' => 'array|required']);
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
                $resultado["valor"] = "100";
            }

            array_push($calificaciones, $resultado);
        }


        $ignoredData = [];
        foreach ($calificaciones as $registro) {
            $affected = DB::table('calificaciones')->insertOrIgnore($registro);
            echo "<script>console.log(" . $affected . ")</script>";
            if ($affected === 0) {
                $ignoredData[] = $registro;
                DB::table('calificaciones')
                    ->where('usuario_id', $registro['usuario_id'])
                    ->where('curso_id', $registro['curso_id'])
                    ->update([
                        'valor' => $registro['valor'],
                    ]);
            }
        }

        // DB::table("calificaciones")->insertOrIgnore($calificaciones);
        return redirect()->back()->with('success', 'usuarios calificados correctamente');
    }

    public function update(Request $request, $id)
    {
        $estados = $request->estado;
        $data = [];
        foreach ($request->cursos as $curso => $value) {

            $consulta = [
                "usuario_id" => $id,
                "curso_id" => $curso,
                "valor" => $value,
                "estado" => $estados[$curso]
            ];
            array_push($data, $consulta);
        }


        $ignoredData = [];
        foreach ($data as $registro) {
            $affected = DB::table('calificaciones')->insertOrIgnore($registro);
            echo "<script>console.log(" . $affected . ")</script>";
            if ($affected === 0) {
                $ignoredData[] = $registro;
                DB::table('calificaciones')
                    ->where('usuario_id', $id)
                    ->where('curso_id', $registro['curso_id'])
                    ->update([
                        'valor' => $registro['valor'],
                        'estado' => $registro['estado'],
                    ]);
            }
        }
        return redirect()->back();
    }
}
