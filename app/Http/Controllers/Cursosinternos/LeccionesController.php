<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveLeccionRequest;
use App\Models\Leccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LeccionesController extends Controller
{

    public function destroy(string $id)
    {
        $leccione = Leccion::find($id);
        if(is_null($leccione)){
            return redirect()->back();
         }
        $id_contenido = $leccione->contenido->pluck('id_contenido')->toArray();
        $coincidencias = DB::table('contenidos')
        ->whereIn('id_contenido',$id_contenido)
        ->exists();
        if (!$coincidencias) {
            $leccione->delete();
            return redirect()->back()->with('eliminado', 'Eliminado Correctamente');
        }
        return redirect()->back()->with('error', 'No se puede eliminar el registro porque está asociado a otro campo.');
    }

    public function show(string $id)
    {
        return view('Cursosinternos.lecciones.agregar', compact('id'));
    }
    
    public function edit(string $id)
    {
        $leccion = Leccion::find($id);
        if(is_null($leccion)){
            return redirect()->back();
         }
        return view('Cursosinternos.lecciones.editar', compact('leccion'));
    }

    public function update(Request $request, string $id)
    {
        $leccione = Leccion::find($id);
        if(is_null($leccione)){
            return redirect()->back();
         }
        if ($request->hasFile('url_imagen')) {
            $lecciones = $request->file('url_imagen')->store('public/leccion');
            $url = Storage::url($lecciones);
            $leccione->url_imagen = $url;
        }
        $leccione->nombre = $request->post('nombre');
        $leccione->descripcion = $request->post('descripcion');
        $leccione->curso_id = $request->post('curso_id');
        $leccione->saveOrFail();
        $curso = $leccione->curso_id;
        return to_route("curs.show", $curso)->with('agregado', 'Leccion Actualizada Correctamente');
    }

    public function store(SaveLeccionRequest $request)
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
        return to_route("curs.show", $curso)->with('agregado', 'Leccion Agregado Correctamente');
    }
}
