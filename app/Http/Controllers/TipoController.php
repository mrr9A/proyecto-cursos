<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    //
    public function index(){

        return view("cursosplanta.trabajos.index");
    }

    public function create(){
        return view("cursosplanta.trabajos.create");
    }

    public function store(Request $request){

        $trabajo = Trabajo::create([
            "nombre" => $request->nombre,
            "estado" => 1,
            "puesto_id" => $request->puesto_id
        ]);

        return to_route("")->with("status", "trabajo creado correctamente");
    }
}
