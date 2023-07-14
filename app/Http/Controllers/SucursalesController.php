<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveSucursalRequest;
use App\Models\Sucursal;

class SucursalesController extends Controller
{
    public function index()
    {
        $sucursales = Sucursal::all();
        return view('sucursales.index',compact('sucursales'));
    }

    public function store(SaveSucursalRequest $request)
    {
        $data = [
            "codigo" =>$request->codigo,
            "nombre" =>$request->nombre,
            "ciudad"=>$request->ciudad,
            "estado" => 1
        ];
        Sucursal::create($data);
        return redirect()->route('sucursales.index')->with('success',' Sucursal creada Correctamente');
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

    public function update(SaveSucursalRequest $request, string $id)
    {
        $sucursale = Sucursal::find($id);
        $sucursale->fill($request->input());
        $sucursale->saveOrFail();
        return redirect()->route('sucursales.index')->with('success','Sucursal actualizada Correctamente');
    }

    public function destroy(string $id)
    {

        $sucursale = Sucursal::find($id);
        if(count($sucursale->usuarios) < 1){
            $sucursale->delete();
        }else{
            $sucursale->estado = 0;
            $sucursale->save();
        }
        return redirect()->route('sucursales.index')->with('success','Sucursal eliminado Correctamente');
    }
}
