<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = [];
        if (!is_null($request->buscador)) {
            $data = User::progresoEmpleados($request->buscador);
        }else{
            $data = User::progresoEmpleados();
        }
        $allPuestos = Puesto::count();
        $allEmpleados = User::where("estado","=",1 )->count();
        $allSucursales = Sucursal::where("estado","=",1 )->count();

        return view('cursosplanta.home', compact('data', 'allPuestos', 'allEmpleados', 'allSucursales'));
    }
}
