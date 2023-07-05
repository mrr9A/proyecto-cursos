<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\Trabajo;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    //
    public function index(){

        $sucursales =Sucursal::all();
        $puestos = Puesto::all();
        $trabajos = Trabajo::all();
        $cursos = Curso::getAllCursos();

        return view('cursosplanta.reportes.index', compact('sucursales','puestos','trabajos', 'cursos'));
    }
}
