<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Puesto;
use App\Models\ModalidadCurso;
use App\Models\TipoCurso;
use App\Models\Trabajo;
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
        $datosCursos = $request->cursos;
        $trabajos = $request->trabajos;

        DB::beginTransaction();

        try {
            // Preparar los datos para la inserción masiva
            $cursos = [];
            foreach ($datosCursos as $cursoId => $cursoDatos) {
                $validator = Validator::make($cursoDatos, [
                    'nombre' => 'required|string|unique:cursos',
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
                    'modalidad_id' => $cursoDatos['modalidad_id'],
                    'tipo_curso_id' => $cursoDatos['tipo_id'],
                    'estado' => 1,
                ];
                $cursoId = DB::table('cursos')->insertGetId($curso);
                $cursos[] = $cursoId;
            }
            // Insertar los cursos en la tabla cursos y obtener los IDs de los cursos insertados

            // Crear un arreglo con los IDs de los cursos y los IDs de los puestos
            $trabajosCursos = [];
            if (!is_null($trabajos)) {
                foreach ($trabajos as $trabajoId) {
                    foreach ($cursos as $cursoId) {
                        $trabajosCursos[] = [
                            'trabajo_id' => $trabajoId,
                            'curso_id' => $cursoId,
                        ];
                    }
                }
            }

            // Insertar los datos en la tabla puestos_cursos
            DB::table('trabajos_cursos')->insert($trabajosCursos);

            // Confirmar la transacción
            DB::commit();

            // Realizar otras acciones después de guardar los cursos, si es necesario

            // Redirigir a una página de éxito o mostrar un mensaje de éxito, si es necesario
            return redirect()->route("cursos.index")->with('success', 'Los cursos se han guardado correctamente.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollback();

            // Manejar el error de alguna manera (mostrar un mensaje de error, registrar el error, etc.)
            return redirect()->back()->with('error', 'Ha ocurrido un error al guardar los cursos: ' . $e->getMessage());
        }
    }
    public function create()
    {
        $modalidades = ModalidadCurso::all();
        $tipos = TipoCurso::all();
        $trabajos = Trabajo::where('estado', '=', 1)->get();
        return view('cursosplanta.cursos.create', compact('modalidades', 'tipos', 'trabajos'));
    }

    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {

        $coincidencia = DB::table('trabajos_cursos')->where('curso_id', '=', $id)->exists();

        if ($coincidencia) {
            return redirect()->back()->with('error', 'El curso ya esta enlazado a un trabajos. No se puede eliminar');
        }

        $curso = Curso::find($id)->delete();
        return redirect()->back()->with('success', 'curso eliminado correctamente');
    }
}
