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
        $deleted = DB::table('trabajos_cursos')->where('trabajo_id', '=', $id)->delete();
        $deleted = DB::table('usuarios_trabajos')->where('trabajo_id', '=', $id)->delete();
        $trabajo = Trabajo::destroy($id);

        // return "hola";
        return to_route('puestos.index')->with("status", "Trabajo eliminado correctamente");
    }
}
