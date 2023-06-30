<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Cursosinternos\ContenidoController;
use App\Http\Controllers\Cursosinternos\CursosController;
use App\Http\Controllers\Cursosinternos\ExamenController;
use App\Http\Controllers\Cursosinternos\LeccionesController;
use App\Http\Controllers\empleados\empleadoController;
use App\Http\Middleware\RoleAdminMiddleware;
use App\Http\Middleware\RoleEmpleadoMiddleware;
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
// RUTAS DEL LOGIN

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//---------------------------------------------------- RUTAS DE LAS VISTAS ADMINISTRADOR -----------------------------------------------------------------


Route::middleware(['auth', RoleAdminMiddleware::class])->group(function () {
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

Route::middleware(['auth',RoleEmpleadoMiddleware::class])->group(function () {
    // Rutas protegidas para el rol de empleado
    Route::get('inicioEmpleado', [empleadoController::class, 'index'])->name('inicioEmpleado');
});
