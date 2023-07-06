<?php

use App\Http\Controllers\Cursosinternos\ContenidoController;
use App\Http\Controllers\Cursosinternos\CursosController;
use App\Http\Controllers\Cursosinternos\ExamenController;
use App\Http\Controllers\Cursosinternos\LeccionesController;
use App\Http\Controllers\empleados\empleadoController;
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

    Route::resource('Lecciones', \App\Http\Controllers\Cursosinternos\LeccionesController::class);

    Route::resource('contenidos', \App\Http\Controllers\Cursosinternos\ContenidoController::class);

    Route::resource('examenes', \App\Http\Controllers\Cursosinternos\ExamenController::class);

    Route::get('ver/{id}', [ContenidoController::class, 'ver'])->name('ver');

    Route::get('verExam/{id}', [ExamenController::class, 'verExM'])->name('verExamen');

    Route::get('editExam/{id}', [ExamenController::class, 'verExMedit'])->name('editExamen');

    Route::post('Exam/{id}', [ExamenController::class, 'validarExam'])->name('validarExamen');

    Route::get('editar/{id}', [LeccionesController::class, 'edit'])->name('editLec');

    Route::get('edi/{id}', [ContenidoController::class, 'edi'])->name('ediConte');

    Route::get('buscar/{id}', [CursosController::class, 'buscarUsuario'])->name('buscarUsuario');

    Route::delete('/eliminarpuesto/{id}', [CursosController::class, 'destroyUser'])->name('destroyuser');
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
