<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePuestoRequest;
use App\Models\Curso;
use App\Models\PlanesFormacion;
use App\Models\Puesto;
use App\Models\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PuestoController extends Controller
{
    //

    public function index()
    {
        $planesFormacion = PlanesFormacion::all();
        $puestos = Puesto::all();
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

    public function update(Request $request)
    {
        $trabajos = json_decode($request->trabajos);
        $id_puesto = $request->id_puesto;

        $puesto = Puesto::find($id_puesto);
        $puesto->update([
            "puesto" => $request->puesto,
            "estado" => 1,
            "plan_formacion_id" => $request->plan_formacion_id,
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
                        "puesto_id" => $request->id_puesto
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
        $puesto->delete();

        return to_route("puestos.index")->with("status", "Puesto eliminado correctamente");
    }


    public function asignarCursos()
    {
        $planesFormacion = PlanesFormacion::all();
        $puestos = PlanesFormacion::with('puestos')->get();
        $cursos = Curso::getAllCursos();
        $puestos = Puesto::all();
        return view('cursosplanta.puestosCursos.index', compact("planesFormacion", "puestos", "cursos"));
    }
}
