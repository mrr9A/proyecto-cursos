<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\PuestoController;
use App\Models\Curso;
use App\Models\Puesto;
use App\Models\Trabajo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// http://localhost:8000/api/cursosxplanes/1
Route::get('cursosxplanes/{id}', function ($id){
    $data = Curso::getCursesByPuesto($id);
    return response()->json($data);
});
// get numero de empleados por puesto
Route::get('cursosplanta/trabajadores/datos', function (){
    $data = User::getCountEmployesByPuesto();
    return response()->json($data);
});
//get trabajos por puesto
Route::get('cursosplanta/puesto/{id}/trabajos', function ($id){
    $data = Puesto::find($id)->trabajos;
    return response()->json($data);
});
// get progreso de los empleados de ventas
Route::get('prueba', function (){
    $data = Puesto::prueba2();
    return response()->json($data);
});
// get cursos por puesto
Route::get("cursosplanta/cursos/{puesto}", function ($puesto){
    $cursos = Curso::getCursesByPuesto($puesto);
    return response()->json($cursos);
});

Route::get('cursosplanta/puesto/{id}', function ($id){
    $puesto = Puesto::find($id);
    $puesto->trabajos;
    $puesto->planes_formacion;
    return response()->json($puesto);
});
Route::get('getProgressByUser', function (){
    $puesto = User::getProgressByUser();
    return response()->json($puesto);
});

// editar la informacion de puesto
Route::put('cursosplanta/puesto/edit/{id}', [PuestoController::class, 'update']);

Route::get('buscador', [ApiController::class, 'buscar']);

// http://localhost:8000/api/puesto/${id}/trabajos/