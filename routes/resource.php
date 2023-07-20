<?php

use App\Http\Controllers\Cursosinternos\ContenidoController;
use App\Http\Controllers\Cursosinternos\CursosController;
use App\Http\Controllers\Cursosinternos\ExamenController;
use App\Http\Controllers\Cursosinternos\LeccionesController;
use App\Http\Controllers\empleados\empleadoController;
use App\Http\Controllers\empleados\ReporteCursoInternoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//---------------------------------------------------- RUTAS DE LAS VISTAS ADMINISTRADOR -----------------------------------------------------------------


Route::middleware('auth.admin')->group(function () {
    // Rutas protegidas para el rol de administrador

    //Ruta del formulario de agregar Cursos
    Route::get('curso', function () {
        return view('Cursosinternos.forms.cursoForm');
    })->name('crearCurso');

    Route::resource('curs', \App\Http\Controllers\Cursosinternos\CursosController::class);

    Route::resource('avances', \App\Http\Controllers\Cursosinternos\AvanceUsuarioController::class);

    Route::resource('Reporteavances', \App\Http\Controllers\Cursosinternos\ReporteAvanceUsuarioController::class);

    Route::resource('Lecciones', \App\Http\Controllers\Cursosinternos\LeccionesController::class);

    Route::resource('contenidos', \App\Http\Controllers\Cursosinternos\ContenidoController::class);

    Route::resource('examenes', \App\Http\Controllers\Cursosinternos\ExamenController::class);

    Route::get('ver/{id}', [ContenidoController::class, 'ver'])->name('ver');

    Route::get('verExam/{id}', [ExamenController::class, 'verExM'])->name('verExamen');

    Route::get('verExamFINAL/{id}', [ExamenController::class, 'verExamenFinal'])->name('verExamenFinal');

    Route::get('editExam/{id}', [ExamenController::class, 'verExMedit'])->name('editExamen');

    Route::get('editExamfinal/{id}', [ExamenController::class, 'verExFinalMedit'])->name('verExFinalMedit');

    Route::post('Exam/{id}', [ExamenController::class, 'validarExam'])->name('validarExamen');

    Route::get('newnewExamen/{id}', [ExamenController::class, 'examenfinal1'])->name('newExamen');

    Route::post('createex', [ExamenController::class, 'ExamenFinal'])->name('examenFinal');

    Route::put('actuaExamen/{id}', [ExamenController::class, 'actualizar'])->name('examenactualizado');

    Route::get('editar/{id}', [LeccionesController::class, 'edit'])->name('editLec');

    Route::get('edi/{id}', [ContenidoController::class, 'edi'])->name('ediConte');

    Route::get('buscar/{id}', [CursosController::class, 'buscarUsuario'])->name('buscarUsuario');

    Route::delete('/eliminarpuesto/{id}', [CursosController::class, 'destroyUser'])->name('destroyuser');

    Route::resource("cursosinternos/reportes", ReporteCursoInternoController::class, ["names" => "reportesinternos"]);

});

//---------------------------------------------------- RUTAS PARA LAS VIDAS DE USUARIOS EMPLEADOS -----------------------------------------------------------------

Route::middleware('auth')->group(function () {
    // Rutas protegidas para el rol de empleado
    Route::get('inicioEmpleado', [empleadoController::class, 'index'])->name('inicioEmpleado');

    Route::get('verContenido/{id}', [empleadoController::class, 'ver'])->name('verContenido');

    Route::resource('cursosEmpleados', \App\Http\Controllers\empleados\empleadoController::class);

    Route::get('verExamenempleado/{id}', [empleadoController::class, 'verExM'])->name('verExamenempleado');

    Route::post('validarExamenempleado/{id}', [empleadoController::class, 'validarExam'])->name('validarExamenempleado');

    Route::get('pdfcerti/{usuario}', [
        App\Http\Controllers\empleados\PDFCertificadoController::class,
        'pdfcertificado'
    ])->name('descargarCertificado');

});
