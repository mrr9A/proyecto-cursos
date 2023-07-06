<?php

namespace App\Http\Controllers\empleados;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Contenido;
use App\Models\Curso;
use App\Models\Examen;
use App\Models\Intento;
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
        foreach (Auth::user()->cursos as $curso) {
            if (stripos($curso->nombre, $buscar) !== false) {
                $calificacionTotal = 0;
                $calificacionMaxima = 0;
                $progresoTotal = 0;

                foreach ($curso->lecciones as $leccion) {
                    $progresoLeccion = 0;
                    $progre = 0;
                    $calificacionLeccion = 0;
                    $totalContenido = $leccion->contenido->count();

                    foreach ($leccion->contenido as $contenido) {
                        $examen = $contenido->examen()->first(); // Retrieve the first exam
                        foreach ($examen->usuarios as $calificacionnn) {
                            if ($calificacionnn->pivot->usuario_id == Auth::user()->id_usuario) {
                                $calificacion = $calificacionnn->pivot->calificacion ?? 0; // Get the "calificacion" property
                                $calificacionLeccion += $calificacion;
                            }
                            if ($examen->usuarios()->where('examen_id', $contenido->examen()->first()->id_examen)->exists() and $examen->usuarios()->where('usuario_id', Auth::user()->id_usuario)->exists()) {
                                if($calificacionnn->pivot->usuario_id == Auth::user()->id_usuario){
                                    $progresoLeccion++;
                                }
                            }
                        }
                    }

                    $calificacionTotal += $calificacionLeccion;
                    $calificacionMaxima += $totalContenido;
                    $progresoTotal += $progresoLeccion;
                }

                $promedioCalificacion = $calificacionMaxima > 0 ? ($calificacionTotal * 100) / ($calificacionMaxima * 100) : 0;
                $promedioProgreso = $calificacionMaxima > 0 ? ($progresoTotal / $calificacionMaxima) * 100 : 0;
                $numeroFormateado = number_format($promedioCalificacion, 2);

                // Agreg0 ar la condición para determinar el estado del curso
                $estado = "";
                if ($promedioCalificacion >= 80 and $promedioProgreso == 100) {
                    $estado = "Aprobado";
                } elseif ($promedioProgreso < 100) {
                    $estado = "Pendiente";
                } elseif ($promedioCalificacion < 80) {
                    $estado = "Reprobado";
                }


                $calificacionesCursos[] = [
                    'curso' => $curso,
                    'calificacion' => $numeroFormateado,
                    'progreso' => $promedioProgreso,
                    'estado' => $estado,
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
        return view('vistasEmpleados.vistaExamenEmpleado.calificacionExamen', compact('promedio', 'examenID', 'id_examen'));
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
