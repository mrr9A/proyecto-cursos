<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrabajoController extends Controller
{
    //
    public function destroy($id){

        // primero eliminamos todas las relaciondes de trabajos tanto con cursos como con usuarios y despues eliminamos el trabajo
        $trabajosCursos = DB::table('trabajos_cursos')->where('trabajo_id', '=', $id)->exists();
        $trabajosUsuarios = DB::table('usuarios_trabajos')->where('trabajo_id', '=', $id)->exists();

        if($trabajosUsuarios){
            return to_route('puestos.index')->with("error", "El trabajo ha sido asignado a un usuario. No se puede eliminar");
        }
        if($trabajosCursos){
            return to_route('puestos.index')->with("error", "El trabajo ya tiene cursos. No se puede eliminar");
        }

        $trabajo = Trabajo::destroy($id);
        // return "hola";
        return to_route('puestos.index')->with("success", "Trabajo eliminado correctamente");
    }
}
