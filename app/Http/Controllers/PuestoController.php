<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePuestoRequest;
use App\Models\Curso;
use App\Models\PlanesFormacion;
use App\Models\Puesto;
use App\Models\Trabajo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PuestoController extends Controller
{
    //

    public function index()
    {
        $planesFormacion = PlanesFormacion::all();
        $puestos = Puesto::orderBy('id_puesto', 'desc')->paginate(10);
        return view("cursosplanta.puestos.index", compact("planesFormacion", "puestos"));
    }

    public function create()
    {
        return view("cursosplanta.puestos.create");
    }

    public function store(SavePuestoRequest $request)
    {
        $puesto = Puesto::create([
            "puesto" => $request->puesto,
            "codigo" => $request->codigo,
            "estado" => 1,
            "plan_formacion_id" => $request->plan_id,
        ]);

        $data = [];
        if (!is_null($request->trabajo)) {
            $trabajo = Trabajo::create([
                "nombre" => $request->puesto,
                "puesto_id" => $puesto->id_puesto,
                "estado" => 1
            ]);
            foreach ($request->trabajo as $trabajo) {
                if (is_null($trabajo)) continue;
                $consulta = [
                    "nombre" => $trabajo,
                    "puesto_id" => $puesto->id_puesto,
                    "estado" => 1
                ];
                array_push($data, $consulta);
            }
            DB::table("trabajos_sumtotal")->insert($data);
        } else {
            $trabajo = Trabajo::create([
                "nombre" => $request->puesto,
                "puesto_id" => $puesto->id_puesto,
                "estado" => 1
            ]);
        }

        return to_route("puestos.index")->with("status", "puesto creado correctamente");
    }

    public function update(Request $request, $id)
    {

        // return response()->json(['error' => $request->all()], 400);
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|unique:puestos,codigo,'.$id.',id_puesto',
            'puesto' => 'required',
            'plan_id' => 'required',
            'trabajo' => 'array',
        ]);
        if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
        }

    

        $trabajos = json_decode($request->trabajos);
        $id_puesto = $id;

        $puesto = Puesto::find($id_puesto);
        $puesto->update([
            "puesto" => $request->puesto,
            "codigo" => $request->codigo,
            "estado" => 1,
            "plan_formacion_id" => $request->plan_id,
        ]);

        foreach ($trabajos as $trabajo) {

            if (is_numeric($trabajo->id_trabajo)) {
                $trabajoEncontrado = Trabajo::find($trabajo->id_trabajo);
                if (!is_null($trabajoEncontrado)) {
                    $trabajoEncontrado->update(
                        [
                            "nombre" => $trabajo->nombre
                        ]
                    );
                }
            } else {

                Trabajo::create(
                    [
                        "nombre" => $trabajo->nombre,
                        "estado" => 1,
                        "puesto_id" => $id_puesto
                    ]
                );
            }
        }

        return response()->json([
            "message" => "Puesto actualizado correctamente"
        ]);
    }

    public function destroy($id)
    {

        $puesto = Puesto::find($id);
        $idsTrabajos = $puesto->trabajos->pluck('id_trabajo')->toArray();
        $usuario = User::where('puesto_id','=',$puesto->id_puesto)->first();
        $coincidencias = DB::table('trabajos_cursos')
            ->whereIn('trabajo_id', $idsTrabajos)
            ->exists();

        if (is_null($usuario) && !$coincidencias) {
            Trabajo::where('puesto_id', '=', $puesto->id_puesto)->delete();
            $puesto->delete();
            return to_route("puestos.index")->with("success", "Puesto eliminado correctamente");
        }
        return to_route("puestos.index")->with("error", "el puesto esta relacionado con usuarios o con cursos, no se puede eliminar");
    }

    public function asignarCursos(Request $request)
    {
        $planesFormacion = PlanesFormacion::all();
        $cursos = Curso::getAllCursos($request->buscar, false);
        $trabajos = Trabajo::all();
        return view('cursosplanta.puestosCursos.index', compact("planesFormacion", "trabajos", "cursos"));
    }
}
