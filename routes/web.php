<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatrizController;
use App\Http\Controllers\ModalidadController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PlanFormacionController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Categoria;
use App\Models\ModalidadCurso;
use App\Models\TipoCurso;
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
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('preventBackHistory');


require __DIR__ . '/resource.php';
Route::middleware('auth.admin')->group(function () {
    // Rutas protegidas para el rol de administrador

    Route::get('/pdf/{user}', [PDFController::class,'pdf'])->name('descargarPDF');
    Route::get('/reporte', [ReporteController::class, 'generateExcelReport'])->name('exportarExcel');
    Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('preventBackHistory');
    Route::get('/cursosplanta/cursos-puestos/asignar-cursos', [PuestoController::class, 'asignarCursos'])->name('puestos.cursos');
    
    Route::get('/cursos', function (){
        $modalidad = ModalidadCurso::all();
        $tipos = TipoCurso::all();
        $categorias = Categoria::all();
        return view('cursos.index', compact('modalidad', 'tipos', 'categorias'));
    })->name('cursos.home');
    Route::delete('/cursosplanta/cursos/puestos/trabajos/{id}', [TrabajoController::class, 'destroy'])->name("trabajos.destroy");
    
    Route::resource('sucursales', SucursalesController::class, ['names' => 'sucursales']);
    Route::resource("cursosplanta/puestos", PuestoController::class, ["names" => "puestos"]);
    Route::resource("usuarios", UsuarioController::class, ["names" => "usuarios"]);
    Route::resource("cursosplanta/matrices", MatrizController::class, ["names" => "matrices"]);
    Route::resource("cursosplanta/cursos/modalidad", ModalidadController::class, ["names" => "modalidad"]);
    Route::resource("cursosplanta/cursos/tipos", TipoController::class, ["names" => "tipos"]);
    Route::resource("cursosplanta/cursos", CursoController::class, ["names" => "cursos"]);
    Route::resource("cursosplanta/calificaciones", CalificacionController::class, ["names" => "calificaciones"]);
    Route::resource("cursosplanta/cursos", CursoController::class, ["names" => "cursos"]);
    Route::resource("cursosplanta/planes", PlanFormacionController::class, ["names" => "planes"]);
    Route::resource("cursosplanta/calificaciones", CalificacionController::class, ["names" => "calificaciones"]);
    Route::resource("cursosplanta/reportes", ReporteController::class, ["names" => "reportes"]);
    Route::resource('categorias', CategoriaController::class, ["names" => "categorias"]);

    
    Route::fallback(function () {
        return redirect('home');
    });
});

// REPORT EXCEL

