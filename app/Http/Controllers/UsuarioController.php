<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
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
      $usuarios = User::orderBy('id_usuario', 'asc')->paginate('3');
      $sucursal = Sucursal::all();
      $puesto = Puesto::all();
      return view('usuarios.index', compact('usuarios', 'sucursal', 'puesto'));
   }

   public function store(SaveUserRequest $request)
   {
      $data = [
         'nombre' => $request->nombre,
         'segundo_nombre' => $request->segundo_nombre,
         'apellido_paterno' => $request->apellido_paterno,
         'apellido_materno' => $request->apellido_materno,
         'email' => $request->email,
         'password' => $request->password,
         'rol' => $request->rol,
         'puesto_id' => $request->puesto_id,
         'id_sgp' => $request->id_sgp,
         'id_sumtotal' => $request->id_sumtotal,
         'estado' => $request->estado,
         'fecha_alta_planta' => $request->fecha_alta_planta,
         'fecha_ingreso_puesto' => $request->fecha_ingreso_puesto
      ];



      if (!is_null($request->trabajos)) {
         $usuario = User::create($data);

         $data = array();
         foreach ($request->trabajos as $trabajo) {
            $consulta = [
               "trabajo_id" => $trabajo,
               "usuario_id" => $usuario->id_usuario,
            ];
            array_push($data, $consulta);
         }
         DB::table("usuarios_trabajos")->insert($data);

         return redirect()->route("usuarios.index");
      }
      $usuario = User::create($data);

      return redirect()->route("usuarios.index");
   }

   public function create()
   {
      $puestos = Puesto::all();
      $sucursal = Sucursal::all();
      $puestos = Puesto::all();
      return view('usuarios.create', compact('sucursal', 'puestos'));
   }

   public function edit($id){
      $usuario = User::find($id);
      $sucursal = Sucursal::all();
      $puestos = Puesto::all();
      return view('usuarios.create', compact('usuario', 'sucursal', 'puestos'));
   }

   public function update(SaveUserRequest $request){

   }
}
