<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Puesto;
use App\Models\ModalidadCurso;
use App\Models\TipoCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CursoController extends Controller
{
    //
    public function index(Request $request)
    {
        $buscar = $request->buscador;
        // dd($puesto);
        $cursos = Curso::getAllCursos($buscar);
        $puestos = Puesto::all();
        $modalidad = ModalidadCurso::all();
        $tipos = TipoCurso::all();
        return view("cursosplanta.cursos.index", compact("cursos", "puestos", "modalidad", "tipos"));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $datosCursos = $request->except(['_token', '_method']);
        DB::beginTransaction();

        try {
            // Preparar los datos para la inserción masiva
            $cursos = [];
            foreach ($datosCursos as $cursoId => $cursoDatos) {
                $validator = Validator::make($cursoDatos, [
                    'nombre' => 'required|string',
                    'modalidad_id' => 'required|numeric',
                    'tipo_id' => 'required|numeric',
                ]);

                if ($validator->fails()) {
                    // Manejar la validación fallida de alguna manera (redirigir, mostrar errores, etc.)
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $curso = [
                    'nombre' => $cursoDatos['nombre'],
                    'codigo' => $cursoDatos['codigo'],
                    'fecha_inicio' => $cursoDatos['fecha_inicio'],
                    'fecha_termino' => $cursoDatos['fecha_termino'],
                    'modalidad_id' => $cursoDatos['modalidad_id'],
                    'tipo_curso_id' => $cursoDatos['tipo_id'],
                    'estado' => 1,
                ];
                $cursos[] = $curso;
            }
            // Insertar los cursos en la tabla cursos
            DB::table('cursos')->insert($cursos);

            // Confirmar la transacción
            DB::commit();

            // Realizar otras acciones después de guardar los cursos, si es necesario

            // Redirigir a una página de éxito o mostrar un mensaje de éxito, si es necesario
            return redirect()->route("cursos.index")->with('status', 'Los cursos se han guardado correctamente.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollback();

            // Manejar el error de alguna manera (mostrar un mensaje de error, registrar el error, etc.)
            return redirect()->back()->with('status', 'Ha ocurrido un error al guardar los cursos: ' . $e->getMessage());
        }
    }
    public function create()
    {
        $modalidades = ModalidadCurso::all();
        $tipos = TipoCurso::all();
        return view('cursosplanta.cursos.create', compact('modalidades', 'tipos'));
    }
}
