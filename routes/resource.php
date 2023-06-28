<?php

use App\Http\Controllers\Cursosinternos\ContenidoController;
use App\Http\Controllers\Cursosinternos\CursosController;
use App\Http\Controllers\Cursosinternos\ExamenController;
use App\Http\Controllers\Cursosinternos\LeccionesController;
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

// Route::get('/', function () {
//     return view('Cursosinternos.inicio');
// });

// Route::get('/inicio',function(){
//     return view('Cursosinternos.inicio');
// })->name('inicio');

//Ruta del formulario de agregar Cursos
Route::get('curso', function () {
    return view('Cursosinternos.forms.cursoForm');
})->name('crearCurso');

//Ruta del formulario de agregar Cursos
// Route::get('usuario', function () {
//     return view('Cursosinternos.forms.usuarioForm');
// })->name('crearUsuario');

// // // Route::resource('usuarios',\App\Http\Controllers\UsuarioController::class);



Route::resource('curs',\App\Http\Controllers\Cursosinternos\CursosController::class);

Route::resource('Lecciones',\App\Http\Controllers\Cursosinternos\LeccionesController::class);

Route::resource('contenidos',\App\Http\Controllers\Cursosinternos\ContenidoController::class);

Route::resource('examenes',\App\Http\Controllers\Cursosinternos\ExamenController::class);

Route::get('ver/{id}',[ContenidoController::class,'ver'])->name('ver');

Route::get('verExam/{id}',[ExamenController::class,'verExM'])->name('verExamen');

Route::get('editExam/{id}',[ExamenController::class,'verExMedit'])->name('editExamen');

Route::post('Exam/{id}', [ExamenController::class,'validarExam'])->name('validarExamen');

Route::get('editar/{id}',[LeccionesController::class,'edit'])->name('editLec');

Route::get('edi/{id}',[ContenidoController::class,'edi'])->name('ediConte');

Route::delete('/eliminarpuesto/{id}', [CursosController::class,'destroyUser'])->name('destroyuser');

