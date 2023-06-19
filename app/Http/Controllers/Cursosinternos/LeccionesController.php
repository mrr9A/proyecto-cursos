<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Models\Leccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeccionesController extends Controller
{
    
    public function destroy(string $id)
    {
        $leccione = Leccion::find($id);
        $leccione->delete();
        return redirect()->back();
    }

    public function show(string $id)
    {
        return view('Cursosinternos.lecciones.agregar',compact('id'));
    }

    public function store(Request $request)
    {
        $leccione = new Leccion();
        $leccione->nombre = $request->post('nombre');
        $leccione->descripcion = $request->post('descripcion');
        $leccione->curso_id = $request->post('curso_id');
        $lecciones = $request->file('url_imagen')->store('public/leccion');
        $url = Storage::url($lecciones);
        $leccione->url_imagen = $url;
        $leccione->saveOrFail();
        $curso = $leccione->curso_id;
        return to_route("cursos.show",$curso)->with('agregado', 'Leccion Agregado Correctamente');
    }
}
