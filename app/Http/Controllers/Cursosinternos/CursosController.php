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
            ->where('interno_planta', '=', 1)
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

        $buscar1 = $request->input('buscar1');
        $cursoId1 = $request->input('curso_id2');
        $curso = Curso::where('id_curso',$id)->where('interno_planta', 1)->first();
        if(is_null($curso)){
           return redirect()->back();
        }
        $usuariosS = $curso->usuarioCurso()->paginate(5);
        $categoria = Categoria::all();
        $modalidad = ModalidadCurso::all();
        $tipo = TipoCurso::all();

        if ($buscar1) {
            $resultados2 = User::whereHas('cursos', function ($query) use ($cursoId1) {
                $query->where('curso_id', $cursoId1);
            })
                ->where(function ($query) use ($buscar1) {
                    $query->where('nombre', 'LIKE', '%' . $buscar1 . '%')
                        ->orWhere('segundo_nombre', 'LIKE', '%' . $buscar1 . '%')
                        ->orWhere('apellido_paterno', 'LIKE', '%' . $buscar1 . '%')
                        ->orWhere('apellido_materno', 'LIKE', '%' . $buscar1 . '%')
                        ->orWhere('id_sgp', 'LIKE', '%' . $buscar1 . '%');
                })
                ->get();
        } else {
            $resultados2 = null;
        }

        $usuarios = User::all();

        return view('Cursosinternos.cursos.configurarCursos', compact('curso', 'modalidad', 'tipo', 'usuarios', 'categoria', 'resultados2','usuariosS'));
    }



    public function update(Request $request, string $id)
    {
        $curso = Curso::find($id);
        if(is_null($curso)){
            return redirect()->back();
         }
        if ($request->hasFile('imagen')) {
            $img = $request->file('imagen')->store('public/imagenes');
            $url = Storage::url($img);
            $curso->imagen = $url;
        }
        $curso->codigo = $request->post('codigo');
        $curso->nombre = $request->post('nombre');
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
        // dd($request);
        $request->validate(['usuarios' => 'array|required']);
        $dataUsuarios = [];
        foreach ($request->usuarios as $usuario) {

            $consulta = [
                "usuario_id" => $usuario,
                "curso_id" => $request->curso_id,
                "fecha_inicio" => $request->fecha_inicio,
                "fecha_termino" => $request->fecha_termino
            ];
            array_push($dataUsuarios, $consulta);
        }
        DB::table("usuarios_cursos")->insert($dataUsuarios);
        return redirect()->back()->with('agregado', 'Usuario agregado a curso');


    }

    public function destroyUser(string $id)
    {
        $user = User::find($id);
        if(is_null($user)){
            return redirect()->back();
         }
        $id_user = $user->id_usuario;
        if ($user->examen()->where('usuario_id', $id_user)->exists()) {
            return redirect()->back()->with('error', 'No se puede eliminar el registro porque está asociado a otro campo');
        } else {
            $Curso = $user->cursos[0]->id_curso;
            $user->cursos()->detach($Curso);
            return redirect()->back()->with('eliminado', 'Eliminado Correctamente');
        }
    }
}
