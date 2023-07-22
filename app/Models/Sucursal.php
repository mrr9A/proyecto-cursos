<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sucursal extends Model
{
    use HasFactory;
    protected $table = 'sucursales';
    protected $primaryKey = "id_sucursal";
    protected $fillable = ["nombre", "ciudad", "estado", "codigo"];
    public $timestamps = false;

    public function usuarios()
    {
        return $this->belongsToMany(User::class, "sucursales_usuarios", "sucursal_id", "usuario_id")->where("usuarios.rol", "=", 1);
    }

    // // PRUEBA NUMERO 1000 PARA GENERARA EL HISTORIAL
    public static function reporteGeneral($buscar = "consultor")
    {
        $resultados = DB::select('CALL progresoEmpleados()');
        $totalEmpleadosSucursalPorTipos = DB::select('CALL totalEmpleadosSucursal()');
        // Convertir los resultados a una colección de Laravel
        $coleccionResultados = collect($resultados);

        // Agrupar los datos por sucursal
        $datosAgrupadosPorSucursal = $coleccionResultados->groupBy('sucursal');

        // Realizar el agrupamiento por nombre_curso y fecha dentro de cada sucursal
        $datosProcesados = $datosAgrupadosPorSucursal->map(function ($empleadosPorSucursal) use ($totalEmpleadosSucursalPorTipos) {
            return $empleadosPorSucursal->groupBy(function ($empleado) {
                return $empleado->nombre_curso;
            })->map(function ($empleadosPorCursoFecha) use ($totalEmpleadosSucursalPorTipos) {
                $porcentajeAprobadoTotal = $empleadosPorCursoFecha->sum('porcentaje_aprobado');
                $nombreCurso = $empleadosPorCursoFecha->first()->nombre_curso;
                $fecha = $empleadosPorCursoFecha->first()->fecha;
                $sucursal = $empleadosPorCursoFecha->first()->sucursal;

                // Obtener la cantidad de empleados únicos para la sucursal y tipo de curso actual
                $numEmpleadosUnicos = collect($totalEmpleadosSucursalPorTipos)
                    ->filter(function ($item) use ($sucursal, $nombreCurso) {
                        return $item->sucursal === $sucursal && $item->tipo_curso === $nombreCurso;
                    })
                    ->first()
                    ->cantidad_usuarios ?? 0;

                // Calcular el porcentaje aprobado promedio
                $porcentajeAprobadoPromedio = $porcentajeAprobadoTotal / max(1, $numEmpleadosUnicos);

                return [
                    'nombre_curso' => $nombreCurso,
                    'fecha' => $fecha,
                    'porcentaje_aprobado_promedio' => $porcentajeAprobadoPromedio,
                ];
            });
        });
        return $datosProcesados;

        // Recorrer los datos agrupados por sucursal, nombre_curso y fecha
        foreach ($datosProcesados as $sucursal => $empleadosPorSucursal) {
            // ===========
            $fechaActual = Carbon::now();
            $mesAnterior = $fechaActual->subMonth()->month;
            $registrosMesAnterior = DB::table('historial')
                ->whereMonth('fecha', $mesAnterior)
                ->get();
            // ===========

            if (count($registrosMesAnterior) < 1) {
                $registros = [];
                foreach ($empleadosPorSucursal as $clave => $empleadosPorCursoFecha) {
                    $porcentajeAprobadoPromedio = $empleadosPorCursoFecha['porcentaje_aprobado_promedio'];
                    $fecha = Carbon::createFromFormat('Y-m', $empleadosPorCursoFecha['fecha']);
                    $nombreCurso = $empleadosPorCursoFecha['nombre_curso'];
                    $registros[] = [
                        'sucursal' => $sucursal,
                        'objetivo' => 16,
                        'real' => $porcentajeAprobadoPromedio,
                        'fecha' => $fecha,
                        'tipo' => $nombreCurso,
                    ];
                }
                DB::table('historial')->insertOrIgnore($registros);
            }


            foreach ($empleadosPorSucursal as $clave => $empleadosPorCursoFecha) {
                $porcentajeAprobadoPromedio = $empleadosPorCursoFecha['porcentaje_aprobado_promedio'];
                $fecha = Carbon::createFromFormat('Y-m', $empleadosPorCursoFecha['fecha']);
                $nombreCurso = $empleadosPorCursoFecha['nombre_curso'];
                $objetivo = 16;
                foreach ($registrosMesAnterior as $mesAnteriora) {
                    if ($mesAnteriora->tipo == $nombreCurso) {
                        $objetivo = $mesAnteriora->real + 16;
                    }
                }
                $fechaActual = Carbon::now();
                if ($mesAnterior != $fechaActual->month) {
                    $mesActual = [
                        'sucursal' => $sucursal,
                        'objetivo' => $objetivo,
                        'real' => $porcentajeAprobadoPromedio,
                        'fecha' => $fecha,
                        'tipo' => $nombreCurso,
                    ];
                    DB::table('historial')->insertOrIgnore($mesActual);
                }
            }
        }
        return "hola";
    }
}

// Obtener el año y mes de la fecha actual y de la fecha mínima
// $anioFecha = $fecha->year;
// $mesFecha = $fecha->month;

// $anioFechaMinima = $fechaMinima->year;
// $mesFechaMinima = $fechaMinima->month;
                    // // Validar si son iguales tanto en el año como en el mes
                    // if ($anioFecha === $anioFechaMinima && $mesFecha === $mesFechaMinima) {
                    //     // Son iguales en el año y el mes, entonces objetivo es 16
                    //     $objetivo = 16;
                    // } else {
                    //     // No son iguales en el año y el mes, se utiliza el porcentaje_anterior + 16
                    //     $objetivo = $porcentaje_anterior + 16;
                    //     $porcentajeAprobadoPromedio += $porcentaje_anterior;
                    // }




                                        // Reemplaza 'nombre_tabla_historia' con el nombre real de tu tabla 'historia'
                    // try {
                    //     DB::table('historial')->insertOrIgnore([
                    //         'sucursal' => $sucursal,
                    //         'objetivo' => 16,
                    //         'real' => $porcentajeAprobadoPromedio,
                    //         'fecha' => $fecha,
                    //         'tipo' => $nombreCurso,
                    //         // Agrega los demás campos que correspondan...
                    //     ]);
                    // } catch (\Illuminate\Database\QueryException $exception) {
                    //     // Verificar si el error es el código de error SQLSTATE '45000'
                    //     if ($exception->getCode() === '45000') {
                    //         // Manejar el error aquí (por ejemplo, mostrar un mensaje o registrar un error en el registro)
                    //         // ...
                    //     } else {
                    //         // Si es otro tipo de error, relanzar la excepción para que Laravel la maneje
                    //         throw $exception;
                    //     }
                    // }




                                    // $empleadosPorCursoFecha = $empleadosPorCursoFecha->sortBy(function ($curso, $fecha) {
                //     return Carbon::createFromFormat('Y-m', $fecha);
                // })->values();












                // foreach ($empleadosPorSucursal as $clave => $empleadosPorCursoFecha) {


                //     dd($empleadosPorCursoFecha);
    
                //     foreach ($empleadosPorCursoFecha as $key => $curso) {
    
                //         $porcentajeAprobadoPromedio = $curso['porcentaje_aprobado_promedio'];
                //         $fecha = Carbon::createFromFormat('Y-m', $curso['fecha']);
                //         $nombreCurso = $curso['nombre_curso'];
                //         // Obtener la cantidad de empleados únicos para la sucursal y tipo de curso actual
    
                //         if (count($registrosMesAnterior) < 1) {
                //             DB::table('historial')->insertOrIgnore([
                //                 'sucursal' => $sucursal,
                //                 'objetivo' => 16,
                //                 'real' => $porcentajeAprobadoPromedio,
                //                 'fecha' => $fecha,
                //                 'tipo' => $nombreCurso,
                //                 // Agrega los demás campos que correspondan...
                //             ]);
                //             continue;
                //         }
    
                //         // dd("hola");
                //         // $objetivo = 16;
                //         // foreach ($registrosMesAnterior as $mesAnteriora) {
                //         //     if ($mesAnteriora->tipo == $nombreCurso) {
                //         //         $objetivo = $mesAnteriora->real + 16;
                //         //     }
                //         // }
                //         // if ($mesAnterior != $fechaActual->month) {
                //         //     $mesActual = [
                //         //         'sucursal' => $sucursal,
                //         //         'objetivo' => $objetivo,
                //         //         'real' => $porcentajeAprobadoPromedio,
                //         //         'fecha' => $fecha,
                //         //         'tipo' => $nombreCurso,
                //         //     ];
                //         //     DB::table('historial')->insertOrIgnore($mesActual);
                //         // }
                //     }
                // }