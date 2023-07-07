<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePlanFormacionRequest;
use App\Models\Curso;
use App\Models\PlanesFormacion;
use App\Models\Puesto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanFormacionController extends Controller
{
    //
    public function index()
    {
        $planesFormacion = PlanesFormacion::all();
        $puestos = PlanesFormacion::with('puestos')->get();
        $cursos = Curso::getAllCursos();
        $puestos = Puesto::all();
        return view('cursosplanta.planes.index', compact("planesFormacion", "puestos", "cursos"));
    }

    public function store(SavePlanFormacionRequest $request)
    {
        $trabajo_id = $request->trabajo_id;


        $cursos = $request->cursos;

        $data = array();
        foreach ($cursos as $curso) {
            $consulta = [
                "curso_id" => $curso,
                "trabajo_id" => $trabajo_id
            ];
            array_push($data, $consulta);
        }
        DB::table("trabajos_cursos")->insertOrIgnore($data);
        return redirect()->back()->with('success', 'cursos agregados correctamente');
    }



    public function destroy(Request $request, $id)
    {
        $request->validate(['cursos' => 'required']);
        $cursos = $request->cursos; // esto es un arreglo de ids de cursos

        // Obtener los ids de los usuario que tiene el trabajo recivido
        $idsUsers = DB::table('usuarios')->join('usuarios_trabajos', 'usuarios.id_usuario', '=', 'usuarios_trabajos.usuario_id')
            ->where('trabajo_id', $id)->pluck('id_usuario');

        // dd($idsUsers);


        // Verificar si existen calificaciones para los cursos seleccionados y que son de los usuario con el trabajo correspondiente
        $calificacionesExistentes = DB::table('calificaciones')
            ->whereIn('curso_id', $cursos)
            ->whereIn('usuario_id', $idsUsers)
            ->exists();


        if ($calificacionesExistentes) {
            // Hay coincidencias en la tabla calificaciones, no se pueden eliminar los cursos
            return redirect()->back()->with('error', 'No se pueden eliminar los cursos con calificaciones asociadas');
        }

        // No hay coincidencias en la tabla calificaciones, se pueden eliminar los cursos
        DB::table('trabajos_cursos')
            ->where('trabajo_id', $id)
            ->whereIn('curso_id', $cursos)
            ->delete();

        return redirect()->back()->with('success', 'cursos eliminados correctamente');
    }
}
