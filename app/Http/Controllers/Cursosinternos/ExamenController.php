<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Models\Contenido;
use App\Models\Curso;
use App\Models\Examen;
use App\Models\Leccion;
use App\Models\Opcion;
use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
{
    public function store(Request $request)
    {
        $dataExamen = [
            "nombre" => $request->nombre,
            "duracion" => $request->duracion,
            "leccion_id" => $request->contenido_id,
        ];

        $examen = Examen::create($dataExamen);

        foreach ($request->arreglo as $preguntas) {

            $dataPregunta = [
                "pregunta" => $preguntas[0],
                "examen_id" => $examen->id_examen
            ];

            $pregunta = Pregunta::create($dataPregunta);



            $dataOpciones = [];
            $opcionCorrecta = $preguntas['respuesta'];
            for ($i = 0; $i < count($preguntas['opciones']); $i++) {
                if ($opcionCorrecta == $i) {
                    $consulta = [
                        'opcion' => $preguntas['opciones'][$i],
                        "pregunta_id" => $pregunta->id_pregunta,
                        "correcta" => true,
                    ];
                    array_push($dataOpciones, $consulta);
                    continue;
                }

                $consulta = [
                    'opcion' => $preguntas['opciones'][$i],
                    "pregunta_id" => $pregunta->id_pregunta,
                    "correcta" => false,
                ];

                array_push($dataOpciones, $consulta);
            }
            DB::table("opciones")->insert($dataOpciones);
        }

    
        $conT = Contenido::find($request->contenido_id);
        $LecC = $conT->leccion_id;
        $LecCI = Leccion::find($LecC);
        $idCuS = $LecCI->curso_id;
        $CuRsO = Curso::find($idCuS);
        // return "HOLIS SI GUARDO";
        return to_route("curs.show",$CuRsO)->with('agregado', 'Examen Agregado Correctamente');
    }


    public function show(string $id)
    {
        return view('Cursosinternos.examenes.examen', compact('id'));
    }

    public function destroy(string $id)
    {
        // $examen = Examen::find($id);
        // $id_pregunta = $examen->preguntas[0]->id_pregunta;
        // $pregunta = Pregunta::find($id_pregunta);
        // // $id_opcion[] = $pregunta->opciones[0]->id_opciones;
        // // $opcion = Opcion::find($id_opcion);
        // return $pregunta;
        // // $id_media = $contenido->media[0]->id_media;
        // // $media = Media_contenido::find($id_media);
        // // $media->delete();
        // // $contenido->delete();
        // // return redirect()->back()->with('eliminado', 'Eliminado Correctamente');
    }
}
