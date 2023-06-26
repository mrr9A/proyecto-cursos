<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCursoInternoRequest;
use App\Models\Curso;
use App\Models\Examen;
use App\Models\ModalidadCurso;
use App\Models\TipoCurso;
use App\Models\User;
use App\Models\Usuario_curso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CursosController extends Controller
{
    public function index()
    {
        $cursos = Curso::where('interno_planta', '=', '1')->orderBy('id_curso', 'desc')->paginate('10');
        $autores = User::all();
        return view('Cursosinternos.cursos.catalago', compact('cursos', 'autores'));
    }
    public function show($id)
    {
        $curso = Curso::find($id);
        // $fechaInicio = date('y-m-d', $curso->fecha_inicio );
        // $fechaTermino =  date('y-m-d',$curso->fecha_termino);

    //    $fechaInicio = $curso->fecha_inicio; // Obtén la fecha completa del campo de fecha de la base de datos
    //    $fecha = Carbon::parse($fechaInicio)->format('Y-m-d'); // Obtén solo la fecha en el formato deseado

    //    $fechaTermino = $curso->fecha_termino; // Obtén la fecha completa del campo de fecha de la base de datos
    //    $fecha = Carbon::parse($fechaTermino)->format('Y-m-d'); // Obtén solo la fecha en el formato deseado

    //    $curso->fecha_inicio = $fechaInicio;
    //    $curso->fecha_termino = $fechaTermino;


        $modalidad = ModalidadCurso::all();
        $tipo = TipoCurso::all();
        $usuarios = User::all();
        return view('Cursosinternos.cursos.configurarCursos', compact('curso', 'modalidad', 'tipo', 'usuarios'));
    }


    public function update(Request $request, string $id)
    {
        $curso = Curso::find($id);
        if ($request->hasFile('imagen')) {
            $img = $request->file('imagen')->store('public/imagenes');
            $url = Storage::url($img);
            $curso->imagen = $url;
        }
        $curso->codigo = $request->post('codigo');
        $curso->nombre = $request->post('nombre');
        $curso->fecha_inicio = $request->post('fecha_inicio');
        $curso->fecha_termino = $request->post('fecha_termino');
        $curso->estado = $request->post('estado');
        $curso->modalidad_id = $request->post('modalidad_id');
        $curso->tipo_curso_id = $request->post('tipo_curso_id');
        $curso->saveOrFail();
        return redirect()->back()->with('actualizado', 'Actualizado Correctamente');
    }

    public function store(Request $request)
    {
        $dataUsuarios = [];
        foreach ($request->usuarios as $usuario) {

            $consulta = [
                "usuario_id" => $usuario,
                "curso_id" => $request->curso_id
            ];
            array_push($dataUsuarios, $consulta);
        }
        DB::table("usuarios_cursos")->insert($dataUsuarios);
        return redirect()->back()->with('agregado', 'Usuario agregado a curso');
    }

    public function destroy(string $id)
    {
        $cursos = Curso::find($id);
        $cursos->delete();
        return redirect('cursos')->with('eliminado', 'Eliminado Correctamente');
    }

    public function destroyUser(string $id)
    {
        $user = User::find($id);
        $Curso = $user->cursos[0]->id_curso;
        $user->cursos()->detach($Curso);
        return redirect()->back()->with('eliminado', 'Eliminado Correctamente');
    }
}
