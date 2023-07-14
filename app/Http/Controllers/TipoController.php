<?php

namespace App\Http\Controllers;

use App\Models\TipoCurso;
use App\Models\Trabajo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function store(Request $request)
    {

        $tipoCurso = TipoCurso::create([
            "nombre" => $request->nombre,
            "estado" => 1,
        ]);

        return redirect()->back()->with("success", "tipo de curso creado correctamente");
    }


    public function update(Request $request, $id)
    {
        $tipo = TipoCurso::find($id);
        $tipo->update([
            "nombre" => $request->nombre,
        ]);

        return redirect()->back()->with('success', 'tipo de curso actualizado correctamente');
    }
    public function destroy($id)
    {
        $tipo = TipoCurso::find($id);

        try {
            $tipo->delete();
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'no se puede eliminar el tipo de curso');
        }

        return redirect()->back()->with('success', 'tipo  de curso eliminado correctamente');
    }
}
