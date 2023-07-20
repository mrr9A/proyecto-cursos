<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AvanceUsuarioController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscador;
        $usuarios = User::where(function ($query) use ($buscar) {
            $query->where('nombre', 'like', $buscar . "%")
                ->orWhere('segundo_nombre', 'like', $buscar . "%")
                ->orWhere('apellido_paterno', 'like', $buscar . "%")
                ->orWhere('apellido_paterno', 'like', $buscar . "%")
                ->orWhere('apellido_materno', 'like', $buscar . "%")
                ->orWhere('id_sgp', 'like', $buscar . "%");
        })
            ->where('rol', '=', 1)
            ->orderBy('id_usuario', 'asc')
            ->get();
        if (is_null($usuarios)) {
            return redirect()->back();
        }
        $user = $this->getCursosUsuarios($usuarios);
        $datosUsuarios = [];
        foreach ($user as $userCursos) {
            $cursosUsuario = []; // Arreglo para almacenar los cursos del usuario actual
            foreach ($userCursos['cursos'] as $curso) {
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

                // Agregamos los datos del curso actual al arreglo $cursosUsuario
                $cursosUsuario[] = [
                    'curso' => $curso['curso_nombre'],
                    'calificacion' => $promedioFinalCurso,
                    'progreso_curso' => $progresototalcurso
                ];
            }
            $aprobados = 0;
            $reprobados = 0;
            $pendientes = 0;
            $encurso = 0;
            $progresoUsuarioCurso = 0;
            $totalCursos = 0;
            foreach ($cursosUsuario as $cursoCal) {
                if ($cursoCal['calificacion'] >= 80 && $cursoCal['progreso_curso'] == 100) {
                    $aprobados++;
                } elseif ($cursoCal['progreso_curso'] == 0 && $cursoCal['calificacion'] == 0) {
                    $pendientes++;
                } elseif ($cursoCal['calificacion'] < 80 && $cursoCal['progreso_curso'] < 100) {
                    $encurso++;
                }
                elseif ($cursoCal['calificacion'] > 0 && $cursoCal['calificacion'] < 80 && $cursoCal['progreso_curso'] == 100) {
                    $reprobados++;
                } 

                $progresoUsuarioCurso += $cursoCal['progreso_curso'];
            }
            $totalCursos = count($cursosUsuario);
            $progresoTotalUsuario = ($progresoUsuarioCurso > 0) ? ($progresoUsuarioCurso * 100) / ($totalCursos * 100) : 0;

            $datosUsuarios[] = [
                'id' => $userCursos['usuario_id'],
                'nombre' => $userCursos['usuario_N'],
                'nombreS' => $userCursos['usuario_S'],
                'nombreAP' => $userCursos['usuario_AP'],
                'nombreAM' => $userCursos['usuario_AM'],
                'cursos' => $cursosUsuario,
                'aprobado' => $aprobados,
                'reprobados' => $reprobados,
                'pendientes' => $pendientes,
                'encurso' => $encurso,
                'progresoTotal' => $progresoTotalUsuario,
            ];
        }

        return view('cursosinternos.index', compact('datosUsuarios'));
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

    private function getCursosUsuarios($usuarios) //funcion que obtiene todos los datos del usuario mapeado
    {
        return   $result = $usuarios->map(function ($usuario) {
            $usuario_id = $usuario->id_usuario;
            $usuario_nombre = $usuario->nombre;
            $usuario_nombreS = $usuario->segundo_nombre;
            $usuario_nombreAP = $usuario->apellido_paterno;
            $usuario_nombreAM = $usuario->apellido_materno;
            $rol = $usuario->rol;

            $cursos = $usuario->cursos->map(function ($curso) use ($usuario_id) {
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

            return [
                'usuario_id' => $usuario_id,
                'usuario_N' => $usuario_nombre,
                'usuario_S' => $usuario_nombreS,
                'usuario_AP' => $usuario_nombreAP,
                'usuario_AM' => $usuario_nombreAM,
                'rol' => $rol,
                'cursos' => $cursos,
            ];
        });
    }
}
