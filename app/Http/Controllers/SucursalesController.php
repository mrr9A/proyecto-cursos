<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
    public function index()
    {
        $sucursales = Sucursal::all();
        return view('sucursales.index',compact('sucursales'));
    }

    public function store(Request $request)
    {
        $data = [
            "nombre" =>$request->nombre,
            "ciudad"=>$request->ciudad,
            "estado" => 1
        ];
        Sucursal::create($data);
        return redirect()->route('sucursales.index')->with('agregado','Agregado Correctamente');
    }

    public function show(string $id)
    {
        $sucursale = Sucursal::find($id);
        return view('sucursales.editsucursales',compact('sucursale'));
    }
    
    public function edit($id){
        $sucursale = Sucursal::find($id);
        return view('sucursales.edit',compact('sucursale'));
    }

    public function update(Request $request, string $id)
    {
        $sucursale = Sucursal::find($id);
        $sucursale->fill($request->input());
        $sucursale->saveOrFail();
        return redirect()->route('sucursales.index')->with('actualizado','Actualizado Correctamente');
    }

    public function destroy(string $id)
    {
        $sucursale = Sucursal::find($id);
        $sucursale->delete();
        return redirect()->route('sucursales.index')->with('eliminado','Eliminado Correctamente');
    }
}