<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    //
     //
     public function index()
     {
         $empleados = User::getMatrizVentas();
         return view('cursosplanta.usuarios.index', compact('empleados'));
     }
 
     public function store(Request $request)
     {
         if (!is_null($request->trabajos)) {
             $usuario = User::create([
                 "nombre" => $request->nombre,
                 "segundo_nombre" => $request->segundo_nombre,
                 "apellido_materno" => $request->apellido_materno,
                 "apellido_paterno" => $request->apellido_paterno,
                 "estado" => 1,
                 "puesto_id" => $request->puesto_id
             ]);
 
             $data = array();
             foreach ($request->trabajos as $trabajo) {
                 $consulta = [
                     "trabajo_id" => $trabajo,
                     "usuario_id" => $usuario->id_usuario,
                 ];
                 array_push($data, $consulta);
             }
             DB::table("usuarios_trabajos")->insert($data);
 
             return redirect()->route("matrices.index");
         }
         $usuario = User::create([
             "nombre" => $request->nombre,
             "segundo_nombre" => $request->segundo_nombre,
             "apellido_materno" => $request->apellido_materno,
             "apellido_paterno" => $request->apellido_paterno,
             "estado" => 1,
             "puesto_id" => $request->puesto_id
         ]);
         return redirect()->route("matrices.index");
     }
 
     public function create()
     {
         $puestos = Puesto::all();
         return view('cursosplanta.usuarios.create', compact("puestos"));
     }
}
