<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Models\User;
use  PDF;
use Illuminate\Http\Request;

class ReporteAvanceUsuarioController extends Controller
{
    public function show(string $id)
    {
        $usuarios = User::find($id);
        if (is_null($usuarios)) {
            return redirect()->back();
        }
        $user = $this->getCursosUsuarios($usuarios);
        $datosUsuarios = [];
            $cursosUsuario = []; // Arreglo para almacenar los cursos del usuario actual
            foreach ($user as $curso) {
                $calificacionContenido = 0;
                $totalContenido = 0;
                $contenidosCompletados = 0;
                $totalprogresoFinalexamen = 0;
                foreach ($curso['leccion'] as $leccion) {
                    $totalContenido += $leccion['contenidos']->count();  //cantidad de contenidos
                    foreach ($leccion['contenidos'] as $contenido) {
                        foreach ($contenido['examen'] as $examen) {
                            foreach ($examen['calificacionContenido'] as $calificacion) {
                                $calificacionContenido += $calificacion['calificacion'];
                                if ($calificacion['calificacion'] >= 0) {
                                    $contenidosCompletados++;
                                }
                            }
                        }
                    }
                }

                $calificacionExamenFinal = 0;
                $totalprogresoexamen = 0;
                $totalExamenFinal = $curso['examenfinal']->count(); // Cantidad real de exámenes finales disponibles

                if ($totalExamenFinal > 0) {
                    foreach ($curso['examenfinal'] as $exFinal) {
                        foreach ($exFinal['calificacionExamen'] as $califinalexamen) {
                            $calificacionExamenFinal += $califinalexamen['calificacionexamenFinal'];
                            if ($calificacionExamenFinal >= 0) {
                                $totalprogresoexamen++;
                            }
                        }
                    }
                }
                // Calculamos el promedio de calificación de los contenidos para este curso
                $promedioContenido = ($totalContenido > 0) ? ($calificacionContenido / $totalContenido) : 0;
                $promediocontenidofinal = ($promedioContenido > 0) ? ($promedioContenido * 0.60) : 0;

                // Calculamos el promedio del examen final para este curso
                $promedioExamenFinal = ($totalExamenFinal > 0) ? ($calificacionExamenFinal / $totalExamenFinal) : 0;
                $promedioExamenFinal = ($promedioExamenFinal > 0) ? ($promedioExamenFinal * 0.40) : 0;

                // Calculamos el promedio final del curso sumando los promedios del contenido y el examen final
                $promedioFinalCurso = $promediocontenidofinal + $promedioExamenFinal;

                //calculamos el progreso por leccion
                $progresoconte = ($contenidosCompletados > 0) ? ($contenidosCompletados * 100) / $totalContenido : 0;
                $progresofinalcontenido = ($progresoconte > 0) ? ($progresoconte * 0.80) : 0;

                //calculamos del examen final
                $progresoexamenF = ($totalprogresoexamen > 0) ? ($totalprogresoexamen * 100) / 100 : 0;
                $progresoexamenFINAL = ($progresoexamenF > 0) ? ($progresoexamenF * 20) : 0;

                //imprimimos el progreso total
                $progresototalcurso = $progresofinalcontenido + $progresoexamenFINAL;
                
                //CONVERTIMOS LOS DECIMALES EN DOS NADA MÁS 
                $numerocalificacion = number_format($promedioFinalCurso, 2);
                $numeroProgreso = number_format($progresototalcurso, 2);

                // Agregamos los datos del curso actual al arreglo $cursosUsuario
                $cursosUsuario[] = [
                    'curso' => $curso['curso_nombre'],
                    'calificacion' => $numerocalificacion,
                    'progreso_curso' => $numeroProgreso
                ];
            }
            $aprobados = 0;
            $reprobados = 0;
            $pendientes = 0;
            $encurso = 0;
            $progresoUsuarioCurso = 0;
            $totalCursos = 0;
            foreach ($cursosUsuario as $cursoCal) {
                if ($cursoCal['calificacion'] >= 80) {
                    $aprobados++;
                } elseif ($cursoCal['calificacion'] < 80 && $cursoCal['progreso_curso'] == 100) {
                    $reprobados++;
                } elseif ($cursoCal['progreso_curso'] == 0 && $cursoCal['calificacion'] == 0) {
                    $pendientes++;
                } elseif ($cursoCal['calificacion'] < 80 && $cursoCal['progreso_curso'] < 100) {
                    $encurso++;
                }

                $progresoUsuarioCurso += $cursoCal['progreso_curso'];
            }
            $totalCursos = count($cursosUsuario);
            $progresoTotalUsuario = ($progresoUsuarioCurso > 0) ? ($progresoUsuarioCurso * 100) / ($totalCursos * 100) : 0;
            // dd($progresoTotalUsuario);

            $datosUsuarios[] = [
                'cursos' => $cursosUsuario,
                'aprobado' => $aprobados,
                'reprobados' => $reprobados,
                'pendientes' => $pendientes,
                'encurso' => $encurso,
                'progresoTotal' => $progresoTotalUsuario,
            ];
        // dd($datosUsuarios);

        $pdf = PDF::loadView('pdfs.reporteAvances', ['datosUsuarios' => $datosUsuarios]);
        $pdf->setOptions(['defaultFont' => 'poppins']);
        $pdf->setPaper('letter', 'landscape');

        return $pdf->stream("certificado.pdf");
    }

    private function getExamenUsuario($examen, $id_usuario) //funcion para obtener los datos del examen por contenido
    {
        $caliContenido = 0;
        $contenidocompleto = 0;
        return $resultado = $examen->map(function ($examen) use ($id_usuario, &$caliContenido, &$contenidocompleto) {
            $usuarios = $examen->usuarios->map(function ($examUser) use ($id_usuario, &$caliContenido,  &$contenidocompleto) {
                if ($examUser->id_usuario == $id_usuario) {
                    $calificacion = $examUser->pivot->calificacion ?? 0;
                    $caliContenido = $calificacion;
                    $contenidocompleto++;
                    return [
                        'usuario_id' => $id_usuario,
                        'usuario_nombre' => $examUser->nombre,
                        'calificacion' => $caliContenido,
                        'contenidocompleto' => $contenidocompleto
                    ];
                }
                return [
                    'usuario_id' => $examUser->id_usuario,
                    'usuario_nombre' => $examUser->nombre,
                    'calificacion' => 0,
                    'contenidocompleto' => 0
                ];
            });

            return [
                'examen_id' => $examen->id_examen,
                'calificacionContenido' => $usuarios->where('usuario_id', '=', $id_usuario)
            ];
        });
    }

    private function getExamenfinal($examen, $id_usuario) //funcion para obtener los datos del examen final
    {
        $caliexam = 0;
        $examencompleto = 0;
        return $resultado = $examen->map(function ($examen) use ($id_usuario, &$caliexam, &$examencompleto) {
            $usuariosexamen = $examen->usuarios->map(function ($examuserfinal) use ($id_usuario, &$caliexam, &$examen, &$examencompleto) {
                if ($examuserfinal->id_usuario == $id_usuario) {
                    $calificacion = $examuserfinal->pivot->calificacion ?? 0;
                    $caliexam = $calificacion;
                    $examencompleto++;
                    return [
                        'usuario_id' => $id_usuario,
                        'usuario_nombre2' => $examuserfinal->nombre,
                        'calificacionexamenFinal' => $caliexam,
                        'progresoexamen' => $examencompleto
                    ];
                }
                return [
                    'usuario_id' => $examuserfinal->id_usuario,
                    'usuario_nombre2' => $examuserfinal->nombre,
                    'calificacionfinalexamen' => 0,
                    'progresoexamen' => $examencompleto
                ];
            });
            return [
                'examen_idfinal' => $examen->id_examen,
                'calificacionExamen' => $usuariosexamen->where('usuario_id', '=', $id_usuario)
            ];
        });
    }

    private function getCursosUsuarios($usuario) //funcion que obtiene todos los datos del usuario mapeado
    {
        $usuario_id = $usuario->id_usuario;
        return $cursos = $usuario->cursos->map(function ($curso) use ($usuario_id) {
            $curexamefina = $curso->examen;
            $finalexam = $this->getExamenfinal($curexamefina, $usuario_id);
            $lecciones = $curso->lecciones->map(function ($leccion) use ($usuario_id) {
                $contenidos = $leccion->contenido->map(function ($contenido) use ($usuario_id) {
                    $examen1 = $contenido->examen;
                    $cursUsuario = $this->getExamenUsuario($examen1, $usuario_id);

                    return [
                        'contenido_id' => $contenido->id_contenido,
                        'nombre' => $contenido->nombre,
                        'examen' => $cursUsuario,
                    ];
                });

                return [
                    'leccion_id' => $leccion->id_leccion,
                    'nombre_leccion' => $leccion->nombre,
                    'contenidos' => $contenidos,
                ];
            });

            return [
                'curso_id' => $curso->id_curso,
                'curso_nombre' => $curso->nombre,
                'examenfinal' => $finalexam,
                'leccion' => $lecciones,
            ];
        });
    }
}
