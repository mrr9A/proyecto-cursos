<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = [];
        if (!is_null($request->buscador)) {
            $data = User::progresoEmpleados($request->buscador);
        } else {
            $data = User::progresoEmpleados();
        }
        // Obtener los enlaces de paginación manualmente
        // $allPuestos = Puesto::count();
        $allEmpleados = User::where("estado", "=", 1)->count();
        $allSucursales = Sucursal::where("estado", "=", 1)->count();

        return view('cursosplanta.home', compact('data', 'allEmpleados', 'allSucursales'));
    }

    public function reporteGeneral(){
        $data = Sucursal::reporteGeneral();
        return view('cursosplanta.reportGeneral.index', compact('data'));
    }
}
