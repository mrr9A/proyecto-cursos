<?php

namespace App\Http\Controllers\empleados;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Contenido;
use App\Models\Curso;
use App\Models\Examen;
use App\Models\Leccion;
use App\Models\ModalidadCurso;
use App\Models\Opcion;
use App\Models\TipoCurso;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class empleadoController extends Controller
{
    //

    public $intentos = 3;
    public $intentoHecho = 1;


    public function index(Request $request)
    {
        $calificacionesCursos = [];
        $buscar = $request->buscador1;
        $estadoSeleccionado = $request->estado ?? "Todos";
        $cursosFiltrados = [];
        foreach (Auth::user()->userCursos as $curso) {
            if (stripos($curso->nombre, $buscar) !== false) {
                $progresoLeccion2 = 0;
                $calificacionTotal = 0;
                $examenCalifinal = 0;
                $calificacionMaxima = 0;
                $progresoTotal = 0;
                $progresototalexamen = 0;
                $totalLeccionesfinal = $curso->lecciones->count();
                foreach ($curso->lecciones as $leccion) {
                    $progresoLeccion = 0;
                    $progre = 0;
                    $calificacionLeccion = 0;
                    $calificacionLeccion2 = 0;
                    $totalContenido = $leccion->contenido->count();
                    foreach ($leccion->contenido as $contenido) {
                        $examen = $contenido->examen()->first(); // Retrieve the first exam
                        $examCurso = $curso->examen()->first();
                        
                        if (count($examen->usuarios  ?? []) > 0) {

                            foreach ($examen->usuarios as $calificacionnn) {
                                if ($calificacionnn->pivot->usuario_id == Auth::user()->id_usuario) {
                                    $calificacion = $calificacionnn->pivot->calificacion ?? 0; // Get the "calificacion" property
                                    $calificacionLeccion += $calificacion;
                                }
                                if ($examen->usuarios()->where('examen_id', $contenido->examen()->first()->id_examen)->exists() and $examen->usuarios()->where('usuario_id', Auth::user()->id_usuario)->exists()) {
                                    if ($calificacionnn->pivot->usuario_id == Auth::user()->id_usuario) {
                                        $progresoLeccion++;
                                    }
                                }
                            }
                        }

                        if (count($examCurso->usuarios ?? []) > 0) {
                            foreach ($examCurso->usuarios as $caliCu) {
                                if ($caliCu->pivot->usuario_id == Auth::user()->id_usuario) {
                                    $calificacion2 = $caliCu->pivot->calificacion ?? 0; // Get the "calificacion" property
                                    $calificacionLeccion2 += $calificacion2;
                                }
                                if ($examCurso->usuarios()->where('examen_id', $curso->examen()->first()->id_examen)->exists() and $examen->usuarios()->where('usuario_id', Auth::user()->id_usuario)->exists()) {
                                    if ($caliCu->pivot->usuario_id == Auth::user()->id_usuario) {
                                        $progresoLeccion2 = 20;
                                    }
                                }
                            }
                        }
                    }
                    $calificacionTotal += $calificacionLeccion;
                    $calificacionMaxima += $totalContenido;
                    $progresoTotal += $progresoLeccion;
                    $progresototalexamen = $progresoLeccion2;
                    $examenCalifinal += $calificacionLeccion2;
                }

                $promedioCalificacion = $calificacionMaxima > 0 ? ($calificacionTotal * 100) / ($calificacionMaxima * 100) : 0;
                $promedioContenidO = $promedioCalificacion > 0 ?  ($promedioCalificacion * 60) / 100 : 0;
                $promedioExaFinal = $examenCalifinal > 0 ? ($examenCalifinal * 40) / 100 : 0;
                $promedioFINALCURSOCOMPLETO = $promedioContenidO + $promedioExaFinal;
                $promedioProgreso = $calificacionMaxima > 0 ? ($progresoTotal / $calificacionMaxima) * 100 : 0;
                $promedioProgresoContenido = $promedioProgreso > 0 ? ($promedioProgreso * 80) / 100 : 0;
                $promedioFinaldelcurso = $promedioProgresoContenido + $progresototalexamen;
                $numero = number_format($promedioFinaldelcurso, 2);
                $numeroFormateado = number_format($promedioFINALCURSOCOMPLETO, 2);

                // Agreg0 ar la condición para determinar el estado del curso
                $estado = "";
                if ($promedioFINALCURSOCOMPLETO >= 80 and $promedioFinaldelcurso == 100) {
                    $estado = "Aprobado";
                } elseif ($promedioFinaldelcurso < 100) {
                    $estado = "Pendiente";
                } elseif ($promedioFINALCURSOCOMPLETO < 80) {
                    $estado = "Reprobado";
                }

                $fechaInicioCurso = $curso->pivot->fecha_inicio;
                $fechaTerminoCurso = $curso->pivot->fecha_termino;
                $fechaActual = date('Y-m-d');

                if ($fechaActual >= $fechaInicioCurso && $fechaActual <= $fechaTerminoCurso) {
                    // El curso está vigente
                    // Pasa la variable a la vista para indicar que el curso está vigente
                    $cursoVigente = true;
                } else {
                    // El curso no está vigente
                    // Pasa la variable a la vista para indicar que el curso no está vigente
                    $cursoVigente = false;
                }


                $calificacionesCursos[] = [
                    'curso' => $curso,
                    'calificacion' => $numeroFormateado,
                    'progreso' => $numero,
                    'estado' => $estado,
                    'lecciones' => $totalLeccionesfinal,
                    'estatus' => $cursoVigente,
                    'fecha' => $fechaActual,
                    'fecha_inicio' => $fechaInicioCurso
                ];
            }
        }
        return view('vistasEmpleados.inicio', compact('calificacionesCursos', 'estadoSeleccionado'));
    }


    public function show(string $id)
    {
        $curso = Curso::find($id);
        $categoria = Categoria::all();
        $modalidad = ModalidadCurso::all();
        $tipo = TipoCurso::all();
        $usuarios = User::all();

        return view('vistasEmpleados.cursosEmpleados.indexCurso', compact('curso', 'modalidad', 'tipo', 'usuarios', 'categoria'));
    }

    public function ver(string $id)
    {
        $contenido = Contenido::find($id);
        $archivo = public_path($contenido->media[0]->url); // Ruta al archivo que deseas obtener la extensión
        $extension = File::extension($archivo);
        $leccion = Leccion::find($contenido->leccion_id);
        return view('vistasEmpleados.vistacontenido.index', compact('contenido', 'leccion', 'extension'));
    }

    public function verExM(string $id)
    {
        $intentos = $this->intentos;
        $examen = Examen::find($id);
        $totalPreguntas = $examen->preguntas->count();
        return view('vistasEmpleados.vistaExamenEmpleado.index', compact('examen', 'intentos', 'totalPreguntas'));
    }


    public function validarExam(Request $request, string $id)
    {
        $validatedData = $request->except('_token', 'total_pregunta');
        $totalQuestions = $request->total_pregunta;
        $id_user = Auth::user()->id_usuario;
        $user = User::find($id_user);
        $examenn = Examen::find($id);
        $id_examen = $examenn->id_examen;
        $correctAnswers = 0;
        foreach ($validatedData as $pregunta => $opcion) {
            if ($this->isAnswerCorrect($opcion)) {
                ++$correctAnswers;
            }
        }
        // Calcular el promedio
        $promedio = ($correctAnswers / $totalQuestions) * 100;
        if ($user->examen()->where('examen_id', $id_examen)->exists()) {
            foreach ($user->examen as $exaaa) {
                if ($exaaa->id_examen == $id_examen) {
                    $intentoHecho = $exaaa->pivot->numero_intento;
                    $user->examen()->updateExistingPivot($id_examen, ['numero_intento' => ++$intentoHecho, 'limite_intentos' => '3', 'calificacion' => $promedio]);
                }
            }
        } else {
            $user->examen()->attach($id_examen, ['numero_intento' => $this->intentoHecho, 'limite_intentos' => '3', 'calificacion' => $promedio]);
        }
        $examenID = $examenn->contenido_id;
        $examenDI = $examenn->curso_id;
        return view('vistasEmpleados.vistaExamenEmpleado.calificacionExamen', compact('promedio', 'examenID', 'examenDI', 'id_examen'));
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
}
