<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //
    public function store(Request $request)
    {

        $categoria = Categoria::create($request->all());

        return redirect()->back()->with('success', 'categoria agregada correctamente');
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        $categoria->update([
            "nombre" => $request->nombre,
            "descripcion" => $request->descripcion
        ]);

        return redirect()->back()->with('success', 'categoria actualizado correctamente');
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (is_null($categoria)) {
            return redirect()->back()->with('error', 'no se entro la categoria a eliminar');
        }

        try {
            $categoria->delete();
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'no se puede eliminar la categoria');
        }

        return redirect()->back()->with('success', 'categoria eliminada correctament');
    }
}
