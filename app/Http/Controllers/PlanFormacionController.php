<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePlanFormacionRequest;
use App\Models\Curso;
use App\Models\PlanesFormacion;
use App\Models\Puesto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PlanFormacionController extends Controller
{
    //
    public function index()
    {
        $planesFormacion = PlanesFormacion::all();
        $puestos = PlanesFormacion::with('puestos')->get();
        $cursos = Curso::getAllCursos("", false);
        $puestos = Puesto::all();
        return view('cursosplanta.planes.index', compact("planesFormacion", "puestos", "cursos"));
    }

    public function store(SavePlanFormacionRequest $request)
    {
        $trabajos = $request->trabajos;
        $cursos = $request->cursos;

        // Crear un arreglo con los IDs de los cursos y los IDs de los puestos
        $trabajosCursos = [];
        foreach ($trabajos as $trabajoId) {
            foreach ($cursos as $cursoId) {
                $trabajosCursos[] = [
                    'trabajo_id' => $trabajoId,
                    'curso_id' => $cursoId,
                ];
            }
        }
        DB::table("trabajos_cursos")->insertOrIgnore($trabajosCursos);
        return redirect()->back()->with('success', 'cursos asignados correctamente');
    }



    public function destroy(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cursos' => 'required'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->with('error', "selecione los cursos a eliminar");
        }

        $cursos = $request->cursos; // esto es un arreglo de ids de cursos

        // Obtener los ids de los usuario que tiene el trabajo recivido
        $idsUsers = DB::table('usuarios')->join('usuarios_trabajos', 'usuarios.id_usuario', '=', 'usuarios_trabajos.usuario_id')
            ->where('trabajo_id', $id)->pluck('id_usuario');

        


        // Verificar si existen calificaciones para los cursos seleccionados y que son de los usuario con el trabajo correspondiente
        $calificacionesExistentes = DB::table('calificaciones')
            ->whereIn('curso_id', $cursos)
            ->whereIn('usuario_id', $idsUsers)
            ->exists();

            // dd($calificacionesExistentes);

        if ($calificacionesExistentes) {
            // Hay coincidencias en la tabla calificaciones, no se pueden eliminar los cursos
            return redirect()->back()->with('error', 'No se pueden eliminar los cursos con calificaciones asociadas');
        }

        // No hay coincidencias en la tabla calificaciones, se pueden eliminar los cursos
        // return [
        //     "id"=> $id,
        //     "cursos" => $cursos
        // ];
        DB::table('trabajos_cursos')
            ->where('trabajo_id', $id)
            ->whereIn('curso_id', $cursos)
            ->delete();

        return redirect()->back()->with('success', 'cursos eliminados correctamente');
    }
}
