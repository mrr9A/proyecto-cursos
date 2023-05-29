<?php

use App\Http\Controllers\MatrizController;
use App\Http\Controllers\UsuarioController;
use App\Models\PlanesFormacion;
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

Route::get('/', function () {
    return view('cursosplanta.home');
})->name('home');

Route::resource("cursosplanta/planesformacion", PlanesFormacion::class,[
    "names" => "planes"
]);
Route::resource("cursosplanta/usuarios", UsuarioController::class,[
    "names" => "usuarios"
]);
Route::resource("cursosplanta/matrices", MatrizController::class,[
    "names" => "matrices"
]);


