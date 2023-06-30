<?php

namespace App\Http\Controllers\empleados;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class empleadoController extends Controller
{
    //
    public function index()
    {
        return view('vistasEmpleados.inicio');
    }
}
