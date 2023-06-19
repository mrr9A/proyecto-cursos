<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    //
     //
     public function index()
     {
        //  $empleados = User::getMatrizVentas();
        //  return view('cursosplanta.usuarios.index', compact('empleados'));
        $usuarios = User::orderBy('id_usuario','desc')->paginate('3');
        // $rol = Roles::all();
        $sucursal = Sucursal::all();
        $puesto = Puesto::all();
        return view('cursosplanta.usuarios.index',compact('usuarios','sucursal','puesto'));
     }
 
     public function store(Request $request)
     {
        //  if (!is_null($request->trabajos)) {
        //      $usuario = User::create([
        //          "nombre" => $request->nombre,
        //          "segundo_nombre" => $request->segundo_nombre,
        //          "apellido_materno" => $request->apellido_materno,
        //          "apellido_paterno" => $request->apellido_paterno,
        //          "estado" => 1,
        //          "puesto_id" => $request->puesto_id
        //      ]);
 
        //      $data = array();
        //      foreach ($request->trabajos as $trabajo) {
        //          $consulta = [
        //              "trabajo_id" => $trabajo,
        //              "usuario_id" => $usuario->id_usuario,
        //          ];
        //          array_push($data, $consulta);
        //      }
        //      DB::table("usuarios_trabajos")->insert($data);
 
        //      return redirect()->route("matrices.index");
        //  }
        //  $usuario = User::create([
        //      "nombre" => $request->nombre,
        //      "segundo_nombre" => $request->segundo_nombre,
        //      "apellido_materno" => $request->apellido_materno,
        //      "apellido_paterno" => $request->apellido_paterno,
        //      "estado" => 1,
        //      "puesto_id" => $request->puesto_id
        //  ]);
        
        if(is_null($request->data)){
            return "tAS BIEN WQEY";
        };

         return "chido si llega";
        //  return redirect()->route("matrices.index");
     }
 
     public function create()
     {
         $puestos = Puesto::all();
        //  return view('cursosplanta.usuarios.create', compact("puestos"));
        return view('Cursosinternos.forms.usuarioForm');
     }
}
