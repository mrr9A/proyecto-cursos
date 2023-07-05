<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Models\Contenido;
use App\Models\Curso;
use App\Models\Examen;
use App\Models\Leccion;
use App\Models\Opcion;
use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
{
    public function store(Request $request)
    {
        $dataExamen = [
            "nombre" => $request->nombre,
            "duracion" => $request->duracion,
            "contenido_id" => $request->contenido_id,
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
        return to_route("curs.show", $CuRsO)->with('agregado', 'Examen Agregado Correctamente');
    }


    public function show(string $id)
    {
        return view('Cursosinternos.examenes.examen', compact('id'));
    }

    public function verExM(string $id)
    {
        $intentos = 3;
        $contenido = Contenido::find($id);
        $examen = $contenido->examen;
        $totalPreguntas = $examen[0]->preguntas->count();
        return view('Cursosinternos.examenes.vistaExamen', compact('examen', 'intentos', 'totalPreguntas'));
    }

    public function verExMedit(string $id)
    {
        $contenido = Contenido::find($id);
        $examen = $contenido->examen;
        return view('Cursosinternos.examenes.editar', compact('examen', 'id'));
    }

    public function update(Request $request, string $id)
    {
        // dd($request);
        $examen = Examen::find($request->id_examen);

        // Validar los datos enviados desde el formulario de edición
        $validatedData = $request->validate([
            'nombre' => 'required',
            'duracion' => 'required',
            'contenido_id' => 'required'
            // Agrega las reglas de validación para los demás campos del examen
        ]);

        // Actualizar los datos del examen con los valores proporcionados en el formulario
        $examen->update($validatedData);

        foreach ($request->preguntas as $preguntaId => $preguntaData) {
            $pregunta = Pregunta::find($preguntaId);
            $nombrepregunta = $preguntaData['titulo'];
            $pregunta->pregunta = $nombrepregunta;
            $pregunta->saveOrFail();

            $opcionCorrect = $preguntaData['respuesta'];
            // dd($opcionCorrect);

            foreach ($preguntaData['opciones'] as $opcionId => $opcionData) {

                // dd($opcionCorrect);
                if ($opcionCorrect == $opcionId) {

                    $opcion = Opcion::find($opcionId);
                    $nombreOpcion = $opcionData['titulo'];
                    // dd($nombreOpcion);
                    $opcion->opcion = $nombreOpcion;
                    $opcion->correcta = true;
                    $opcion->saveOrFail();
                    continue;
                }
                $opcion = Opcion::find($opcionId);
                $nombreOpcion = $opcionData['titulo'];
                $opcion->opcion = $nombreOpcion;
                $opcion->correcta = false;
                $opcion->saveOrFail();
            }
        }
        // ESTA PARTE ES OARA GUARADAR LAS NUEVAS PREGUNTAS
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

        // return "holis";
        $conT = Contenido::find($request->contenido_id);
        $LecC = $conT->leccion_id;
        $LecCI = Leccion::find($LecC);
        $idCuS = $LecCI->curso_id;
        $CuRsO = Curso::find($idCuS);
        // return "HOLIS SI GUARDO";
        return to_route("curs.show", $CuRsO)->with('actualizado', 'Examen actualizado Correctamente');
    }

    public function validarExam(Request $request, string $id)
    {
        $validatedData = $request->except('_token', 'total_pregunta');
        // Procesar las respuestas del test
        $totalQuestions = $request->total_pregunta;
        $correctAnswers = 0;

        foreach ($validatedData as $pregunta => $opcion) {
            if ($this->isAnswerCorrect($opcion)) {
                ++$correctAnswers;
            }
        }
        // Calcular el promedio
        $promedio = ($correctAnswers / $totalQuestions) * 100;

        return view('cursosinternos.examenes.calificacion', compact('promedio'));
    }

    private function isAnswerCorrect($par)
    {
        $opcion = Opcion::find($par);
        if ($opcion->correcta == 1) {
            return true;
        } else {
            return false;
        }
        // return $opcion[0]->correcta === $correcta;

    }

    public function destroy(string $id)
    {
        $examen = Examen::find($id);
        $id_exam = $examen->id_examen;
        // dd($examen->usuarios()->where('examen_id', $id_exam)->exists());
        $idPregun = $examen->preguntas->pluck('id_pregunta')->toArray();
        // dd($examen->preguntas->pluck('id_pregunta')->toArray());
        $pregunt = Pregunta::find($idPregun);
        // dd($pregunt);
        if ($examen->usuarios()->where('examen_id', $id_exam)->exists()) {
            return redirect()->back()->with('error', 'No se puede eliminar el registro porque está asociado a otro campo1');
        } else {
            foreach ($pregunt as $pregunta) {

                $idOpcion = $pregunta->opciones->pluck('id_opciones')->toArray();
                $opciondelete = DB::table('opciones')
                    ->whereIn('id_opciones', $idOpcion)
                    ->delete();
                $pregunta->delete();
            }
            $examen->delete();
            return redirect()->back()->with('eliminado', 'Eliminado Correctamente');
        }

        // $examen->delete();
        // return redirect()->back()->with('eliminado', 'Eliminado Correctamente');
    }
}
