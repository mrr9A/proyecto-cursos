<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\Trabajo;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class ReporteController extends Controller
{
    //
    
    public function index(Request $request)
    {
        $sucursales = Sucursal::all();
        $puestos = Puesto::all();
        $trabajos = Trabajo::all();
        $cursos = Curso::getAllCursos();
    
        
        $sucursal_id = $request->filtros['sucursal_id'] ?? 0;
        $puesto_id = $request->filtros['puesto_id'] ?? 0;
        $trabajo_id = $request->filtros['trabajo_id'] ?? 0;
        $curso_id = $request->filtros['curso_id'] ?? 0;
        
        $data = [];
        if($sucursal_id || $puesto_id){
            $data = User::getUsuariosWithCurses($sucursal_id, $puesto_id,$trabajo_id, $curso_id);
        }
    
        if ($request->has('export')) {
            $export = new ReportExport($data->toArray());
            return Excel::download($export, 'reporte.xlsx');
        }
    
        return view('cursosplanta.reportes.index', compact('sucursales', 'puestos', 'trabajos', 'cursos', 'data'));
    }
}
