<?php

use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatrizController;
use App\Http\Controllers\MenuCursosController;
use App\Http\Controllers\PlanFormacionController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\UsuarioController;
use App\Models\PlanesFormacion;
use App\Models\Puesto;
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
Route::get('/graficas', function (){
    return view("cursosplanta.grafica");
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cursosplanta/cursos-puestos/asignar-cursos', [PuestoController::class, 'asignarCursos'])->name('cursos.puestos');

Route::resource("cursosplanta/puestos", PuestoController::class,[
    "names" => "puestos"
]);
Route::resource("cursosplanta/usuarios", UsuarioController::class,[
    "names" => "usuarios"
]);
Route::resource("cursosplanta/matrices", MatrizController::class,[
    "names" => "matrices"
]);

Route::resource("cursosplanta/cursos", CursoController::class, [
    "names"=>"cursos"
]);
Route::resource("cursosplanta/planes", PlanFormacionController::class, [
    "names"=>"planes"
]);
Route::resource("cursosplanta/calificaciones", CalificacionController::class, [
    "names"=>"calificaciones"
]);
Route::fallback(function () {
    return redirect('/');
});


Route::get('/opcion1',[MenuCursosController::class, 'opcion1']);
Route::get('/opcion2', [MenuCursosController::class, 'opcion2']);