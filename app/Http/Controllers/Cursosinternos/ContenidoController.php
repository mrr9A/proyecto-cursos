<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveContenidoRequest;
use App\Models\Contenido;
use App\Models\Leccion;
use App\Models\Media_contenido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ContenidoController extends Controller
{

    public function store(SaveContenidoRequest $request)
    {

        //Este apartado es para crear un contenido
        $contenido = new Contenido();
        $contenido->nombre = $request->post('nombre');
        $contenido->descripcion = $request->post('descripcion');
        $contenido->leccion_id = $request->post('leccion_id');
        $contenido->estado = 0;
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
        $archivo = public_path($contenido->media[0]->url); // Ruta al archivo que deseas obtener la extensión
        $extension = File::extension($archivo);
        $leccion = Leccion::find($contenido->leccion_id);
        return view('Cursosinternos.vistaPrevia.index', compact('contenido', 'leccion', 'extension'));
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

        return to_route("curs.show", $curso)->with('actualizado', 'Contenido Actualizada Correctamente');
        // return redirect()->back()->with('actualizado', 'Actualizado Correctamente');
    }

    public function edi($id)
    {
        $contenido = Contenido::find($id);
        $archivo = public_path($contenido->media[0]->url); // Ruta al archivo que deseas obtener la extensión
        $extension = File::extension($archivo);
        return view('Cursosinternos.contenido.editar', compact('contenido', 'extension'));
    }

    public function destroy(string $id)
    {
        $contenido = Contenido::find($id);
        // dd( $contenido->examen->pluck('id_examen')->toArray());
        $id_exam = $contenido->examen->pluck('id_examen')->toArray();
        $coincidencias = DB::table('examen')
            ->whereIn('id_examen', $id_exam)
            ->exists();
        // dd($coincidencias);
        if (!$coincidencias) {
            // $contenido->delete();
            $id_media = $contenido->media[0]->id_media;
            $media = Media_contenido::find($id_media);
            $media->delete();
            $contenido->delete();
            return redirect()->back()->with('eliminado', 'Eliminado Correctamente');
        }
        return redirect()->back()->with('error', 'No se puede eliminar el registro contenido porque está asociado a otro campo.');
    }
}
