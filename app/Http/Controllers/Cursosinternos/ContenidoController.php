<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveContenidoRequest;
use App\Models\Contenido;
use App\Models\Leccion;
use App\Models\Media_contenido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContenidoController extends Controller
{

    public function store(SaveContenidoRequest $request)
    {

        //Este apartado es para crear un contenido
        $contenido = new Contenido();
        $contenido->nombre = $request->post('nombre');
        $contenido->descripcion = $request->post('descripcion');
        $contenido->leccion_id = $request->post('leccion_id');
        $contenido->saveOrFail();
        //Esta parte es para obtener el id del contenido
        $id_cont = $contenido->id_contenido;
        // crear en otra tabla
        $media = new Media_contenido();
        $contenidos = $request->file('url')->store('public/contenido');
        $url = Storage::url($contenidos);
        $media->url = $url;
        $media->contenido_id = $id_cont;
        $media->saveOrFail();
        $leccion = Leccion::find($request->leccion_id);
        $curso = $leccion->curso_id;

        return to_route("curs.show", $curso)->with('agregado', 'Contenido Agregado Correctamente');
    }

    public function show(string $id)
    {
        return view('Cursosinternos.contenido.contenido', compact('id'));
    }

    public function ver(string $id)
    {
        $contenido = Contenido::find($id);
        // $archivos = Storage::files('public/archivos');
        // return view('vista', compact('archivos'));
        return view('Cursosinternos.vistaPrevia.index', compact('contenido'));
    }

    public function update(Request $request, string $id)
    {
        $contenido = Contenido::find($id);
        $contenido->nombre = $request->post('nombre');
        $contenido->descripcion = $request->post('descripcion');
        $contenido->leccion_id = $request->post('leccion_id');
        $contenido->saveOrFail();
        //Esta parte es para obtener el id del contenido
        $id_cont = $contenido->id_contenido;
        // crear en otra tabla
        $id_media = $contenido->media[0]->id_media;
        $media = Media_contenido::find($id_media);
        if ($request->hasFile('url')) {
            $medias = $request->file('url')->store('public/contenido');
            $url = Storage::url($medias);
            $media->url = $url;
        }
        $media->contenido_id = $id_cont;
        $media->saveOrFail();
        $leccion = Leccion::find($request->leccion_id);
        $curso = $leccion->curso_id;

        return to_route("curs.show", $curso)->with('agregado', 'Contenido Agregado Correctamente');
        // return redirect()->back()->with('actualizado', 'Actualizado Correctamente');
    }

    public function edi($id)
    {
        $contenido = Contenido::find($id);
        return view('Cursosinternos.contenido.editar', compact('contenido'));
    }

    public function destroy(string $id)
    {
        $contenido = Contenido::find($id);
        $id_media = $contenido->media[0]->id_media;
        $media = Media_contenido::find($id_media);
        $media->delete();
        $contenido->delete();
        return redirect()->back()->with('eliminado', 'Eliminado Correctamente');
    }
}
