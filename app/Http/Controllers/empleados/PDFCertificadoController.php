<?php

namespace App\Http\Controllers\empleados;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\User;
use  PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFCertificadoController extends Controller
{
    public function pdfcertificado($usuario)
    {
        $calificacionTotal = 0;
        $calificacionMaxima = 0;
        $progresoTotal = 0;
        $curso = Curso::find($usuario);
        $usuarioNombre = Auth::user()->nombre;
        $usuarioSegundoNombre = Auth::user()->segundo_nombre;
        $usuarioApellidoPaterno = Auth::user()->apellido_paterno;
        $usuarioApellidoMaterno = Auth::user()->apellido_materno;
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
        // Obtén la fecha de impresión actual
        $fechaImpresion = date('Y-m-d');

        $calificacionesCursos[] = [
            'curso' => $curso,
            'calificacion' => $numeroFormateado,
            'progreso' => $promedioProgreso,
            'usuario' => $usuarioNombre,
            'segundoNombre' => $usuarioSegundoNombre,
            'apellidoP' => $usuarioApellidoPaterno,
            'apellidoM' => $usuarioApellidoMaterno,
            'fechaImpresion' => $fechaImpresion,

        ];

        $pdf = PDF::loadView('pdfs.certificado', ['calificacionesCursos' => $calificacionesCursos]);
        $pdf->setPaper('letter', 'landscape');
        $pdf->setOptions(['defaultFont' => 'poppins']);

        return $pdf->stream(".pdf");

        // // Access the course ratings and progress
        // foreach ($calificacionesCursos as $calificacionesCurso) {
        //     $curso = $calificacionesCurso['curso'];
        //     $calificacion = $calificacionesCurso['calificacion'];
        //     $progreso = $calificacionesCurso['progreso'];
        //     $usua = $calificacionesCurso['usuario'];
        //     $usuaN = $calificacionesCurso['segundoNombre'];
        //     $usuaP = $calificacionesCurso['apellidoP'];
        //     $usuaM = $calificacionesCurso['apellidoM'];

        //     // Do something with the rating and progress of each course
        //     echo "Curso: " . $curso->nombre . "<br>";
        //     echo "Calificación: " . $calificacion . "<br>";
        //     echo "Progreso: " . $progreso . "%<br><br>";
        //     echo "usuario: " . $usua ,$usuaN, $usuaP, $usuaM. "<br><br>";
        // }
    }
}
