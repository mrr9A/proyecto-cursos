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
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Round;

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
    $data = Curso::getCursesByJob($buscar, $id);
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
    if (is_null($puesto)) {
        return response()->json(['error' => 'not found'], 400);
    }
    $puesto->trabajos;
    $puesto->planes_formacion;
    return response()->json($puesto);
});
Route::get('cursosplanta/cursos', [ApiController::class, 'searchCursos']);

// editar la informacion de puesto
Route::put('cursosplanta/puesto/edit/{id}', [PuestoController::class, 'update']);


Route::get('cursosplanta/curso/{id}/edit', function ($id) {
    $curso = Curso::find($id);
    $modalidades = ModalidadCurso::all();
    $tipos = TipoCurso::all();

    return response()->json([
        "curso" => $curso,
        "modalidades" => $modalidades,
        "tipos" => $tipos,
    ], 200);
});

Route::post('curso/{id}', function (Request $request, $id) {
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

    return response()->json(['message' => "curso actualizado correcatamente"], 200);
});

Route::get('buscador', [ApiController::class, 'buscar']);

// http://localhost:8000/api/puesto/${id}/trabajos/

// prueba
// http://localhost:8000/api/cursosxplanes/1
Route::get('cursosplanta/cursosxplanes/{id}', function (Request $request, $id) {
    $buscar = $request->buscador;
    // return $id;
    $data = Curso::getCursesAsigned($buscar, $id);
    return response()->json($data);
});


Route::get('usuarios', function (Request $request) {
    // curso_id

    $searchTerm = $request->search;
    $id_curso = $request->curso_id;
    $usuarios = User::where('rol', '=', 1)
        ->where('nombre', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('segundo_nombre', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('apellido_paterno', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('apellido_materno', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('id_sgp', 'LIKE', '%' . $searchTerm . '%')
        ->get();


    foreach ($usuarios as $usuario) {
        if (count($usuario->cursos) < 1) {
            $usuario->inscrito = 0;
            continue;
        }

        foreach ($usuario->cursos as $curso) {
            if ($curso->id_curso == $id_curso) {
                $usuario->inscrito = 1;
                break;
            }
            $usuario->inscrito = 0;
        }
    }

    // $cursoUser = $curso->usuarioCurso;

    return response()->json(['data' => $usuarios], 200);
});
// http://localhost:8000/api/cursosplanta/cursosxplanes/5