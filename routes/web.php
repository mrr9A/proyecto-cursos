<?php

use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatrizController;
use App\Http\Controllers\ModalidadController;
use App\Http\Controllers\PlanFormacionController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\UsuarioController;
use App\Models\PlanesFormacion;
use App\Models\Puesto;
use App\Models\User;
use Illuminate\Http\Request;
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

// Route::get('/pdf',function (){
//     $data = User::getProgressByUser()[0];
//     return view('prueba', compact('data'));
// });

Route::resource('sucursales', SucursalesController::class, ['names' => 'sucursales']);
Route::get('/pdf/{user}', [
    App\Http\Controllers\PDFController::class,
    'pdf'
])->name('descargarPDF');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cursosplanta/cursos-puestos/asignar-cursos', [PuestoController::class, 'asignarCursos'])->name('cursos.puestos');
Route::delete('/cursosplanta/cursos/puestos/trabajos/{id}', [TrabajoController::class, 'destroy'])->name("trabajos.destroy");

Route::resource("cursosplanta/puestos", PuestoController::class, ["names" => "puestos"]);
Route::resource("/usuarios", UsuarioController::class, ["names" => "usuarios"]);
Route::resource("cursosplanta/matrices", MatrizController::class, ["names" => "matrices"]);

Route::resource("cursosplanta/cursos/modalidad", ModalidadController::class, ["names" => "modalidad"]);
Route::resource("cursosplanta/cursos/tipos", TipoController::class, ["names" => "tipos"]);

Route::resource("cursosplanta/cursos", CursoController::class, ["names" => "cursos"]);
Route::resource("cursosplanta/planes", PlanFormacionController::class, ["names" => "planes"]);
Route::resource("cursosplanta/calificaciones", CalificacionController::class, ["names" => "calificaciones"]);

require __DIR__ . '/resource.php';

Route::fallback(function () {
    return redirect('/');
});
