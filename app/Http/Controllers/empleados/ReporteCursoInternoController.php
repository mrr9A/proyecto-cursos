<?php

namespace App\Http\Controllers\empleados;

use App\Exports\ReportExport;
use App\Exports\ReportsCursosInternos;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReporteCursoInternoController extends Controller
{
    //
    public function index(Request $request)
    {
        $cursos = Curso::getAllCursoSS();
        $sucursales = Sucursal::all();
        $curso_id = $request->curso_id;
        $sucursal_id = $request->sucursal_id;
        $calificacionesCursos = [];
        $data = [];

        if ($curso_id and $sucursal_id) {
            $cursoS = Curso::find($curso_id);
            if (is_null($cursoS)) {
                return redirect()->back();
            }
            $data = $usuarios = $cursoS->usersSSS;
            // ---------------------------------------------------------------------------------------------
            $calificacionesCursos = [];
            foreach ($cursoS->usersSSS as $usuario) {
                $sucursalUser = "";
                foreach ($usuario->sucursales as $sucursal) {
                    if ($sucursal->id_sucursal == $sucursal_id) {
                        $sucursalUser = $sucursal->nombre;
                        foreach ($usuario->cursos as $cursoUser) {
                            if ($cursoUser->id_curso == $cursoS->id_curso) {
                                $calificacionTotal = 0;
                                $calificacionLeccion = 0;
                                $calificacionLeccion2 = 0;
                                $calificacionMaxima = 0;
                                $examenCalifinal = 0;
                                $progresoTotal = 0;
                                $progresoLeccion2 = 0;
                                $progresototalexamen = 0;
                                foreach ($cursoUser->lecciones as $leccion) {
                                    $progresoLeccion = 0;
                                    $totalContenido = $leccion->contenido->count();
                                    foreach ($leccion->contenido as $contenido) {
                                        $examen = $contenido->examen()->first(); // Retrieve the first exam
                                        $examCurso = $cursoS->examen()->first();
                                        if (count($examen->usuarios  ?? []) > 0) {
                                            foreach ($examen->usuarios as $calificacionnn) {
                                                if ($calificacionnn->pivot->usuario_id == $usuario->id_usuario) {
                                                    $calificacion = $calificacionnn->pivot->calificacion ?? 0; // Get the "calificacion" property
                                                    $calificacionLeccion += $calificacion;
                                                }
                                                if ($examen->usuarios()->where('examen_id', $contenido->examen()->first()->id_examen)->exists() and $examen->usuarios()->where('usuario_id',  $usuario->id_usuario)->exists()) {
                                                    if ($calificacionnn->pivot->usuario_id ==  $usuario->id_usuario) {
                                                        $progresoLeccion++;
                                                    }
                                                }
                                            }
                                        }
                                        if (count($examCurso->usuarios ?? []) > 0) {
                                            foreach ($examCurso->usuarios as $caliCu) {
                                                if ($caliCu->pivot->usuario_id == $usuario->id_usuario) {
                                                    $calificacion2 = $caliCu->pivot->calificacion ?? 0; // Get the "calificacion" property
                                                    $calificacionLeccion2 = $calificacion2;
                                                }
                                                if ($examCurso->usuarios()->where('examen_id', $cursoS->examen()->first()->id_examen)->exists() and $examen->usuarios()->where('usuario_id', $usuario->id_usuario)->exists()) {
                                                    if ($caliCu->pivot->usuario_id == $usuario->id_usuario) {
                                                        $progresoLeccion2 = 20;
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    $calificacionTotal = $calificacionLeccion;
                                    $calificacionMaxima += $totalContenido;
                                    $progresoTotal += $progresoLeccion;
                                    $progresototalexamen = $progresoLeccion2;
                                    $examenCalifinal = $calificacionLeccion2;
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

                                $estado = "";
                                if ($numeroFormateado >= 80 and $promedioProgreso == 100) {
                                    $estado = "Aprobado";
                                } elseif ($promedioProgreso < 100) {
                                    $estado = "Pendiente";
                                } elseif ($numeroFormateado < 80) {
                                    $estado = "Reprobado";
                                }

                                $calificacionesCursos[] = [
                                    'sucursal' => $sucursalUser,
                                    'cursoC' => $cursoS->codigo,
                                    'cursoN' => $cursoS->nombre,
                                    'usuarioN' => $usuario->nombre,
                                    'usuarioSN' => $usuario->segundo_nombre,
                                    'usuarioAP' => $usuario->apellido_paterno,
                                    'usuarioAM' => $usuario->apellido_materno,
                                    'estado' => $estado,
                                    'calificacion' => $numeroFormateado,
                                    'progreso' => $numero,
                                ];
                            }
                        }
                    }
                }
            }
        } elseif ($curso_id) {
            $cursoS = Curso::find($curso_id);
            if (is_null($cursoS)) {
                return redirect()->back();
            }
            $data = $usuarios = $cursoS->usersSSS;
            // ---------------------------------------------------------------------------------------------
            $calificacionesCursos = [];

            foreach ($cursoS->usersSSS as $usuario) {
                $sucursalUser = "";
                foreach ($usuario->sucursales as $sucursal) {
                    $sucursalUser = $sucursal->nombre;
                }
                foreach ($usuario->cursos as $cursoUser) {
                    if ($cursoUser->id_curso == $cursoS->id_curso) {
                        $calificacionTotal = 0;
                        $calificacionLeccion = 0;
                        $calificacionLeccion2 = 0;
                        $calificacionMaxima = 0;
                        $examenCalifinal = 0;
                        $progresoTotal = 0;
                        $progresoLeccion2 = 0;
                        $progresototalexamen = 0;
                        foreach ($cursoUser->lecciones as $leccion) {
                            $progresoLeccion = 0;
                            $totalContenido = $leccion->contenido->count();
                            foreach ($leccion->contenido as $contenido) {
                                $examen = $contenido->examen()->first(); // Retrieve the first exam
                                $examCurso = $cursoS->examen()->first();
                                if (count($examen->usuarios  ?? []) > 0) {
                                    foreach ($examen->usuarios as $calificacionnn) {
                                        if ($calificacionnn->pivot->usuario_id == $usuario->id_usuario) {
                                            $calificacion = $calificacionnn->pivot->calificacion ?? 0; // Get the "calificacion" property
                                            $calificacionLeccion += $calificacion;
                                        }
                                        if ($examen->usuarios()->where('examen_id', $contenido->examen()->first()->id_examen)->exists() and $examen->usuarios()->where('usuario_id',  $usuario->id_usuario)->exists()) {
                                            if ($calificacionnn->pivot->usuario_id ==  $usuario->id_usuario) {
                                                $progresoLeccion++;
                                            }
                                        }
                                    }
                                }
                                if (count($examCurso->usuarios ?? []) > 0) {
                                    foreach ($examCurso->usuarios as $caliCu) {
                                        if ($caliCu->pivot->usuario_id == $usuario->id_usuario) {
                                            $calificacion2 = $caliCu->pivot->calificacion ?? 0; // Get the "calificacion" property
                                            $calificacionLeccion2 = $calificacion2;
                                        }
                                        if ($examCurso->usuarios()->where('examen_id', $cursoS->examen()->first()->id_examen)->exists() and $examen->usuarios()->where('usuario_id', $usuario->id_usuario)->exists()) {
                                            if ($caliCu->pivot->usuario_id == $usuario->id_usuario) {
                                                $progresoLeccion2 = 20;
                                            }
                                        }
                                    }
                                }
                            }

                            $calificacionTotal = $calificacionLeccion;
                            $calificacionMaxima += $totalContenido;
                            $progresoTotal += $progresoLeccion;
                            $progresototalexamen = $progresoLeccion2;
                            $examenCalifinal = $calificacionLeccion2;
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

                        $estado = "";
                        if ($numeroFormateado >= 80 and $promedioProgreso == 100) {
                            $estado = "Aprobado";
                        } elseif ($promedioProgreso < 100) {
                            $estado = "Pendiente";
                        } elseif ($numeroFormateado < 80) {
                            $estado = "Reprobado";
                        }

                        $calificacionesCursos[] = [
                            'sucursal' => $sucursalUser,
                            'cursoC' => $cursoS->codigo,
                            'cursoN' => $cursoS->nombre,
                            'usuarioN' => $usuario->nombre,
                            'usuarioSN' => $usuario->segundo_nombre,
                            'usuarioAP' => $usuario->apellido_paterno,
                            'usuarioAM' => $usuario->apellido_materno,
                            'estado' => $estado,
                            'calificacion' => $numeroFormateado,
                            'progreso' => $numero,
                        ];
                    }
                }
            }
        } elseif ($sucursal_id) {
            $sucursalS = Sucursal::find($sucursal_id);
            if (is_null($sucursalS)) {
                return redirect()->back();
            }
            $data = $usuarios = $sucursalS->usuarios;
            // ---------------------------------------------------------------------------------------------
            $calificacionesCursos = [];

            foreach ($sucursalS->usuarios as $usuario) {
                foreach ($usuario->cursos as $cursoUser) {
                    $calificacionTotal = 0;
                    $calificacionLeccion = 0;
                    $calificacionLeccion2 = 0;
                    $calificacionMaxima = 0;
                    $examenCalifinal = 0;
                    $progresoTotal = 0;
                    $progresoLeccion2 = 0;
                    $progresototalexamen = 0;
                    foreach ($cursoUser->lecciones as $leccion) {
                        $progresoLeccion = 0;
                        $totalContenido = $leccion->contenido->count();
                        // dd($usuario->cursos);
                        foreach ($leccion->contenido as $contenido) {
                            $examen = $contenido->examen()->first(); // Retrieve the first exam
                            $examCurso = $cursoUser->examen()->first();

                            if (count($examen->usuarios  ?? []) > 0) {
                                foreach ($examen->usuarios as $calificacionnn) {
                                    if ($calificacionnn->pivot->usuario_id == $usuario->id_usuario) {
                                        $calificacion = $calificacionnn->pivot->calificacion ?? 0; // Get the "calificacion" property
                                        $calificacionLeccion += $calificacion;
                                    }
                                    if ($examen->usuarios()->where('examen_id', $contenido->examen()->first()->id_examen)->exists() and $examen->usuarios()->where('usuario_id',  $usuario->id_usuario)->exists()) {
                                        if ($calificacionnn->pivot->usuario_id ==  $usuario->id_usuario) {
                                            $progresoLeccion++;
                                        }
                                    }
                                }
                            }
                            if (count($examCurso->usuarios ?? []) > 0) {
                                foreach ($examCurso->usuarios as $caliCu) {
                                    if ($caliCu->pivot->usuario_id == $usuario->id_usuario) {
                                        $calificacion2 = $caliCu->pivot->calificacion ?? 0; // Get the "calificacion" property
                                        $calificacionLeccion2 = $calificacion2;
                                    }
                                    if ($examCurso->usuarios()->where('examen_id', $cursoUser->examen()->first()->id_examen)->exists() and $examen->usuarios()->where('usuario_id', $usuario->id_usuario)->exists()) {
                                        if ($caliCu->pivot->usuario_id == $usuario->id_usuario) {
                                            $progresoLeccion2 = 20;
                                        }
                                    }
                                }
                            }
                        }

                        $calificacionTotal = $calificacionLeccion;
                        $calificacionMaxima += $totalContenido;
                        $progresoTotal += $progresoLeccion;
                        $progresototalexamen = $progresoLeccion2;
                        $examenCalifinal = $calificacionLeccion2;
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

                    $estado = "";
                    if ($numeroFormateado >= 80 and $promedioProgreso == 100) {
                        $estado = "Aprobado";
                    } elseif ($promedioProgreso < 100) {
                        $estado = "Pendiente";
                    } elseif ($numeroFormateado < 80) {
                        $estado = "Reprobado";
                    }
                    $calificacionesCursos[] = [
                        'sucursal' => $sucursalS->nombre,
                        'cursoC' => $cursoUser->codigo,
                        'cursoN' => $cursoUser->nombre,
                        'usuarioN' => $usuario->nombre,
                        'usuarioSN' => $usuario->segundo_nombre,
                        'usuarioAP' => $usuario->apellido_paterno,
                        'usuarioAM' => $usuario->apellido_materno,
                        'estado' => $estado,
                        'calificacion' => $numeroFormateado,
                        'progreso' => $numero,
                    ];
                }
            }
        }


        if ($request->has('export')) {
            $export = new ReportsCursosInternos($calificacionesCursos);
            return Excel::download($export, 'reporte.xlsx');
        }

        return view('cursosinternos.reportes.reports', compact('cursos', 'sucursales', 'calificacionesCursos'));
    }
}
