<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = [];
        if (!is_null($request->buscador)) {
            $data = Puesto::progresoEmpleados($request->buscador);
        }else{
            $data = Puesto::progresoEmpleados();
        }

        return view('cursosplanta.home', compact('data'));
    }
}
