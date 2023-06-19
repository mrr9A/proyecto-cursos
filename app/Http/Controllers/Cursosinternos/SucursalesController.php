<?php

namespace App\Http\Controllers\Cursosinternos;

use App\Http\Controllers\Controller;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
    public function index()
    {
        $sucursales = Sucursal::all();
        return view('Cursosinternos.sucursales.sucursales',compact('sucursales'));
    }

    public function store(Request $request)
    {
        $sucursales = new Sucursal($request->input());
        $sucursales->saveOrFail();
        return redirect('sucursales')->with('agregado','Agregado Correctamente');
    }

    public function show(string $id)
    {
        $sucursale = Sucursal::find($id);
        return view('Cursosinternos.sucursales.editsucursales',compact('sucursale'));
    
    }

    public function update(Request $request, string $id)
    {
        $sucursale = Sucursal::find($id);
        $sucursale->fill($request->input());
        $sucursale->saveOrFail();
        return redirect('sucursales')->with('actualizado','Actualizado Correctamente');
    }

    public function destroy(string $id)
    {
        $sucursale = Sucursal::find($id);
        $sucursale->delete();
        return redirect('sucursales')->with('eliminado','Eliminado Correctamente');
    }
}
