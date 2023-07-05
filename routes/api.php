<?php

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\PuestoController;
use App\Models\Curso;
use App\Models\ModalidadCurso;
use App\Models\Puesto;
use App\Models\TipoCurso;
use App\Models\Trabajo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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
Route::get('cursosplanta/trabajo/{id}/cursos', function (Request $request, $id) {
    $buscar = $request->buscador;
    $data = Curso::getCursesByJob($buscar,$id);
    return response()->json($data);
});
// get numero de empleados por puesto
Route::get('cursosplanta/trabajadores/datos', function () {
    $data = User::getCountEmployesByPuesto();
    return response()->json($data);
});
//get trabajos por puesto
Route::get('cursosplanta/puesto/{id}/trabajos', function ($id) {
    $data = Puesto::find($id)->trabajos;
    return response()->json($data);
});

Route::get("cursosplanta/cursos/{puesto}", function ($puesto) {
    $cursos = Curso::getCursesByPuesto($puesto);
    return response()->json($cursos);
});

Route::get('cursosplanta/puesto/{id}', function ($id) {
    $puesto = Puesto::find($id);
    $puesto->trabajos;
    $puesto->planes_formacion;
    return response()->json($puesto);
});
Route::get('cursosplanta/cursos', [ApiController::class, 'searchCursos']);

// editar la informacion de puesto
Route::put('cursosplanta/puesto/edit/{id}', [PuestoController::class, 'update']);


Route::get('cursosplanta/curso/{id}/edit', function ($id){
    $curso = Curso::find($id);
    $modalidades = ModalidadCurso::all();
    $tipos = TipoCurso::all();

    return response()->json([
        "curso" => $curso,
        "modalidades" => $modalidades,
        "tipos" => $tipos,
    ], 200);
});

Route::post('curso/{id}', function (Request $request, $id){
    $validator = Validator::make($request->all(), [
        'nombre' => 'required|string',
        'codigo' => 'required|string',
        'modalidad_id' => 'required|numeric',
        'tipo_id' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    $curso = Curso::find($id);
    $curso->update($request->all());

    return response()->json(['message'=> "curso actualizado correcatamente"], 200);
});

Route::get('buscador', [ApiController::class, 'buscar']);

// http://localhost:8000/api/puesto/${id}/trabajos/