<?php

namespace App\Http\Controllers\empleados;

use App\Exports\ReportExport;
use App\Exports\ReportsCursosInternos;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReporteCursoInternoController extends Controller
{
    public function index(Request $request)
    {
        $cursos = Curso::getAllCursoSS();
        $sucursales = Sucursal::all();
        $curso_id = $request->curso_id;
        $sucursal_id = $request->sucursal_id;
        $data = [];
        // ------------------------------------------
        if ($curso_id && $sucursal_id) {
            $curso = Curso::find($curso_id);
            if (is_null($curso)) {
                return redirect()->back();
            }
            $usuario = [];
            $usuarios_curso = $this->getUsuariosCursos($curso, $sucursal_id);
            foreach ($usuarios_curso as $usuarios) {
                if ($usuarios != null) {
                    $usuario[] = [
                        'usuarios' => $usuarios
                    ];
                }
            }
            $data = $this->obtenerCalificacion($usuario);
        } elseif ($curso_id) {
            $curso = Curso::find($curso_id);
            if (is_null($curso)) {
                return redirect()->back();
            }
            $usuario = [];
            $usuarios_curso = $this->getUsuariosCursosSolo($curso);
            foreach ($usuarios_curso as $usuarios) {
                if ($usuarios != null) {
                    $usuario[] = [
                        'usuarios' => $usuarios
                    ];
                }
            }
            $data = $this->obtenerCalificacion($usuario);
            // dd($data);
        } elseif ($sucursal_id) {
            $sucursal = Sucursal::find($sucursal_id);
            if (is_null($sucursal_id)) {
                return redirect()->back();
            }
            $user = $sucursal->usuarios;
            $nombresucursal = $sucursal->nombre;
            $usua = $this->getCursosUsuariosSucursal($user, $nombresucursal);
            $data = $this->obtenerCalificacionSucursal($usua);
            // dd($data['cursos']);
        }
        //-------------------------------------------------------

        if ($request->has('export')) {
            $export = new ReportsCursosInternos($data['cursos']);
            return Excel::download($export, 'reporte.xlsx');
        }

        return view('cursosinternos.reportes.reports', compact('cursos', 'sucursales', 'data'));
    }

    // --------------------------------------------CONSULTAS PARA CURSO-SUCURSAL Y CURSO---------------------------------------------------------

    private function obtenerCalificacion($user) //funcion para obtener las calificaciones de cada curso
    {
        $datosUsuarios = [];
        $cursosUsuario = []; // Arreglo para almacenar los cursos del usuario actual
        foreach ($user as $usuarios) {
            foreach ($usuarios as $usuario) {
                foreach ($usuario['curso'] as $curso) {
                    // dd($curso);
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

                    //verificamos el estatus del curso
                    $estatus = "";
                    if ($promedioFinalCurso >= 80) {
                        $estatus = "aprobado";
                    } elseif ($promedioFinalCurso < 80 && $progresototalcurso == 100) {
                        $estatus = "reprobado";
                    } elseif ($progresototalcurso == 0 && $promedioFinalCurso == 0) {
                        $estatus = "pendiente";
                    } elseif ($promedioFinalCurso < 80 && $progresototalcurso < 100) {
                        $estatus = "en curso";
                    }

                    // Agregamos los datos del curso actual al arreglo $cursosUsuario
                    $cursosUsuario[] = [
                        'sucursal' => $usuario['sucursal'],
                        'nombre' => $usuario['usuario_nombre'],
                        'segundo_nombre' => $usuario['usuario_NS'],
                        'apellido_paterno' => $usuario['usuario_AP'],
                        'apellido_materno' => $usuario['usuario_AM'],
                        'curso' => $curso['curso_nombre'],
                        'codigo' => $curso['curso_codigo'],
                        'calificacion' => $numerocalificacion,
                        'progreso_curso' => $numeroProgreso,
                        'estatus' => $estatus,
                    ];
                }
            }
        }
        return $datosUsuarios[] = [
            'cursos' => $cursosUsuario,
        ];
    }

    private function getUsuariosCursos($curso, $sucursal_id) //funcion que obtiene todos los datos del curso mapeado buscando por curso y sucursal
    {
        $curso_id = $curso->id_curso;
        $curso_nombre = $curso->nombre;

        return $usuarios = $curso->usersSSS->map(function ($usuario) use ($curso_id, &$sucursal_id, &$curso_nombre) {
            $sucursal_id_usuario = $usuario->sucursales[0]->id_sucursal;
            $sucursal_nombre = $usuario->sucursales[0]->nombre;
            if ($sucursal_id == $sucursal_id_usuario) {
                $user = $this->getCursosUsuarios($usuario, $curso_id);
                return [
                    'sucursal' => $sucursal_nombre,
                    'usuario_id' => $usuario->id_usuario,
                    'usuario_nombre' => $usuario->nombre,
                    'usuario_NS' => $usuario->segundo_nombre,
                    'usuario_AP' => $usuario->apellido_paterno,
                    'usuario_AM' => $usuario->apellido_materno,
                    'curso' => $user->where('curso_id', '=', $curso_id),
                ];
            }
        });
    }

    private function getUsuariosCursosSolo($curso) //funcion que obtiene todos los datos del curso mapeado solo buscando por curso
    {
        $curso_id = $curso->id_curso;
        $curso_nombre = $curso->nombre;

        return $usuarios = $curso->usersSSS->map(function ($usuario) use ($curso_id, &$curso_nombre) {
            $sucursal_id_usuario = $usuario->sucursales[0]->id_sucursal;
            $sucursal_nombre = $usuario->sucursales[0]->nombre;
            $user = $this->getCursosUsuarios($usuario, $curso_id);
            return [
                'sucursal' => $sucursal_nombre,
                'usuario_id' => $usuario->id_usuario,
                'usuario_nombre' => $usuario->nombre,
                'usuario_NS' => $usuario->segundo_nombre,
                'usuario_AP' => $usuario->apellido_paterno,
                'usuario_AM' => $usuario->apellido_materno,
                'curso' => $user->where('curso_id', '=', $curso_id),
            ];
        });
    }

    private function getCursosUsuarios($usuario, $curso_id) //funcion que obtiene todos los datos del usuario mapeado
    {
        $usuario_id = $usuario->id_usuario;
        $id_curso = $curso_id;
        return $cursos = $usuario->cursos->map(function ($curso) use ($usuario_id, &$id_curso) {
            if ($curso->id_curso == $id_curso) {
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
                    'curso_codigo' => $curso->codigo,
                    'examenfinal' => $finalexam,
                    'leccion' => $lecciones,
                ];
            }
        });
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
    // -----------------------------------------------------CONSULTAS PARA SOLO POR SUCURSAL------------------------------------------------------------

    private function getCursosUsuariosSucursal($usuarios, $nombresucursal) //funcion para obtener los usuarios por sucursal
    {
        return   $result = $usuarios->map(function ($usuario) use ($nombresucursal) {
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
                    'curso_codigo' => $curso->codigo,
                    'curso_id' => $curso->id_curso,
                    'curso_nombre' => $curso->nombre,
                    'examenfinal' => $finalexam,
                    'leccion' => $lecciones,
                ];
            });

            return [
                'sucursal' => $nombresucursal,
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

    private function obtenerCalificacionSucursal($user) //funcion para obtener calificacion por sucursal
    {
        $datosUsuarios = [];
        $todosUser = [];
        $cursosUsuario = []; // Arreglo para almacenar los cursos del usuario actual
        foreach ($user as $userCursos) {
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

                //CONVERTIMOS LOS DECIMALES EN DOS NADA MÁS 
                $numerocalificacion = number_format($promedioFinalCurso, 2);
                $numeroProgreso = number_format($progresototalcurso, 2);
                //verficamos su estatus
                $estatus = "";
                if ($promedioFinalCurso >= 80) {
                    $estatus = "aprobado";
                } elseif ($promedioFinalCurso < 80 && $progresototalcurso == 100) {
                    $estatus = "reprobado";
                } elseif ($progresototalcurso == 0 && $promedioFinalCurso == 0) {
                    $estatus = "pendiente";
                } elseif ($promedioFinalCurso < 80 && $progresototalcurso < 100) {
                    $estatus = "en curso";
                }
                // Agregamos los datos del curso actual al arreglo $cursosUsuario
                $cursosUsuario[] = [
                    'sucursal' => $userCursos['sucursal'],
                    'nombre' => $userCursos['usuario_N'],
                    'segundo_nombre' => $userCursos['usuario_S'],
                    'apellido_paterno' => $userCursos['usuario_AP'],
                    'apellido_materno' => $userCursos['usuario_AM'],
                    'curso' => $curso['curso_nombre'],
                    'codigo' => $curso['curso_codigo'],
                    'calificacion' => $numerocalificacion,
                    'progreso_curso' => $numeroProgreso,
                    'estatus' => $estatus,
                ];
            }
        }
        return $todosUser[] = [
            'cursos' => $cursosUsuario,
        ];
    }
}
