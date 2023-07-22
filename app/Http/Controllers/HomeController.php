<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = [];
        if (!is_null($request->buscador)) {
            $data = User::progresoEmpleados($request->buscador);
        } else {
            $data = User::progresoEmpleados();
        }
        // Obtener los enlaces de paginación manualmente
        // $allPuestos = Puesto::count();
        $allEmpleados = User::where("estado", "=", 1)->count();
        $allSucursales = Sucursal::where("estado", "=", 1)->count();

        // Registros de la tabla historial a mostrar
        $fechaActual = Carbon::now(); // Obtiene la fecha y hora actual
        $primerDiaMesAnterior = Carbon::now()->subMonth()->startOfMonth(); // Obtiene el primer día del mes anterior

        $historial = DB::table("historial")
            ->whereBetween('fecha', [$primerDiaMesAnterior, $fechaActual])
            ->get()->groupBy('sucursal')->map(function ($registro) {
                return $registro->groupBy('fecha');
            });
        return view('cursosplanta.home', compact('data', 'allEmpleados', 'allSucursales', 'historial'));
    }
}
