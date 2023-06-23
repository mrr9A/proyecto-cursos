<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\ModalidadCurso;
use App\Models\TipoCurso;
use App\Models\User;
use Illuminate\Http\Request;

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
        $modalidad = ModalidadCurso::all();
        $tipo = TipoCurso::all();
        return view('Cursosinternos.cursos.configurarCursos', compact('curso','modalidad','tipo'));
    }

    public function destroy(string $id)
    {
        $cursos = Curso::find($id);
        $cursos->delete();
        return redirect('cursos')->with('eliminado', 'Eliminado Correctamente');
    }
}
