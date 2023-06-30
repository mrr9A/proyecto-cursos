<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCursoInternoRequest;
use App\Models\Categoria;
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
    public function index(Request $request)
    {
        // $cursos = Curso::where('interno_planta', '=', '1')->orderBy('id_curso', 'desc')->paginate('10');
        $buscar = $request->buscador;
        $cursos = Curso::where(function ($query) use ($buscar) {
            $query->where('nombre', 'like', $buscar . "%")
                ->orWhere('codigo', 'like', $buscar . "%")
                ->orWhere('fecha_inicio', 'like', $buscar . "%");
        })
            ->orWhereHas('categoria', function ($query) use ($buscar) {
                $query->where('nombre', 'like', $buscar . "%");
            })
            ->orderBy('id_curso', 'desc')
            ->paginate(8);
        $autores = User::all();
        $categrias = Categoria::all();
        return view('Cursosinternos.cursos.catalago', compact('cursos', 'autores', 'categrias'));
    }
    public function show(Request $request, string $id)
    {
        $curso = Curso::find($id);
        $categoria = Categoria::all();
        $modalidad = ModalidadCurso::all();
        $tipo = TipoCurso::all();
        $usuarios = User::all();
        return view('Cursosinternos.cursos.configurarCursos', compact('curso', 'modalidad', 'tipo', 'usuarios', 'categoria'));
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
        $categorias = $curso->categoria()->detach($curso->categoria->pluck('id_categoria'));
        $categorias = $curso->categoria()->attach($request->post('categoria_id'));
        $curso->saveOrFail();
        return redirect()->back()->with('actualizado', 'Actualizado Correctamente');
    }

    public function store(Request $request)
    {
        $request->validate(['usuarios' => 'array|required']);
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

    public function destroy(Request $request, string $id)
    {
        $request->validate(['usuarios' => 'array|required']);

        foreach ($request->usuarios as $usuario) {
            $useri = User::find($usuario);
            $curso = $useri->cursos[0]->id_curso;
            $useri->cursos()->detach($curso);
        }
        return redirect()->back()->with('eliminado', 'Eliminado Correctamente');
    }

    public function destroyUser(string $id)
    {
        $user = User::find($id);
        $Curso = $user->cursos[0]->id_curso;
        $user->cursos()->detach($Curso);
        return redirect()->back()->with('eliminado', 'Eliminado Correctamente');
    }
}
