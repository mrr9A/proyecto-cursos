<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    //
    public function index(){
        return view("config.cierreMes");
    }

    public function cierreMes(){
        Sucursal::cierreMes();

        return redirect()->back()->with('success', 'cierre de mes generado correctamente');
    }
}
