<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Models\Contenido;
use App\Models\Media_contenido;
use App\Models\Media_contenidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContenidoController extends Controller
{
    
    public function store(Request $request)
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
        return redirect()->back()->with('agregado', 'Agregado Correctamente');
    }

    public function show(string $id)
    {
        return view('Cursosinternos.contenido.contenido',compact('id'));
    }

    public function ver(string $id)
    {
        $contenido = Contenido::find($id);
        return view('Cursosinternos.vistaPrevia.index',compact('contenido'));
    }

    public function update (Request $request, string $id)
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
        return redirect()->back()->with('agregado', 'Agregado Correctamente');
    }

    public function edi ($id)
    {
        $contenido = Contenido::find($id);
        return view('Cursosinternos.contenido.editar',compact('contenido'));
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
