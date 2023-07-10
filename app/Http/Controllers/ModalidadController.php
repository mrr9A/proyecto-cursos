<?php

namespace App\Http\Controllers;

use App\Models\ModalidadCurso;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ModalidadController extends Controller
{
    //
    public function store(Request $request)
    {
        $modalidadCurso = ModalidadCurso::create([
            "modalidad" => $request->modalidad,
            "estado" => 1,
        ]);

        return redirect()->back()->with("success", "modalidad de curso creado correctamente");
    }

    public function update(Request $request, $id)
    {
        $tipo = ModalidadCurso::find($id);
        $tipo->update([
            "modalidad" => $request->modalidad,
        ]);

        return redirect()->back()->with('success', 'modalidad de curso actualizado correctamente');
    }
    public function destroy($id)
    {
        $tipo = ModalidadCurso::find($id);

        try {
            $tipo->delete();
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'no se puede eliminar la modalidad');
        }

        return redirect()->back()->with('success', 'modalidad eliminado correctamente');
    }
}
