<?php

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

Route::get('cursosplanta/trabajadores/datos', function (){
    
    $data = User::getCountEmployesByPuesto();
    return response()->json($data);
});

Route::get('puesto/{id}/trabajos', function ($id){
    $data = Puesto::find($id)->trabajos;
    return response()->json($data);
});
Route::get('prueba', function (){
    $data = Puesto::prueba();
    return response()->json($data);
});

http://localhost:8000/api/puesto/${id}/trabajos