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
    public static function cierreMes()
    {
        $datosProcesados = Sucursal::reporteMesActual();


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
                        'empleados' => $empleadosPorCursoFecha["empleados"],
                        'bajas' => 0,
                        'altas' => 0,
                        'observaciones' => "",
                    ];
                }
                DB::table('historial')->insertOrIgnore($registros);
                continue;
            }




            foreach ($empleadosPorSucursal as $clave => $empleadosPorCursoFecha) {
                $porcentajeAprobadoPromedio = $empleadosPorCursoFecha['porcentaje_aprobado_promedio'];
                $fecha = Carbon::createFromFormat('Y-m', $empleadosPorCursoFecha['fecha']);
                $nombreCurso = $empleadosPorCursoFecha['nombre_curso'];
                $empleados = $empleadosPorCursoFecha["empleados"];
                $objetivo = 16;
                $bajas = 0;
                $altas = 0;
                $observaciones = "";

                foreach ($registrosMesAnterior as $mesAnteriora) {
                    if ($mesAnteriora->tipo == $nombreCurso && $mesAnteriora->sucursal == $sucursal) {
                        $objetivo = $mesAnteriora->real + 16;
                        if (intval($mesAnteriora->empleados) > $empleados) {
                            $bajas = intval($mesAnteriora->empleados) - $empleados;
                            $observaciones = "se dieron de baja " . $bajas . " empleados";
                        }
                        if (intval($mesAnteriora->empleados) < $empleados) {
                            $altas = $empleados - intval($mesAnteriora->empleados);
                            $observaciones = "se dieron de alta a " . $altas . " empleados";
                        }
                    }
                }

                $fechaActual = Carbon::now();
                // dd($mesAnterior);
                if ($mesAnterior != $fechaActual->month) {
                    $mesActual = [
                        'sucursal' => $sucursal,
                        'objetivo' => $objetivo,
                        'real' => $porcentajeAprobadoPromedio,
                        'fecha' => $fechaActual,
                        'tipo' => $nombreCurso,
                        'empleados' => $empleados,
                        'bajas' => $bajas,
                        'altas' => $altas,
                        'observaciones' => $observaciones
                    ];
                    try {
                        DB::table('historial')->insertOrIgnore($mesActual);
                    } catch (\Illuminate\Database\QueryException $exception) {
                        // Verificar si el error es el código de error SQLSTATE '45000'
                        if ($exception->getCode() === '45000') {
                            // Manejar el error aquí (por ejemplo, mostrar un mensaje o registrar un error en el registro)
                            // ...
                        } else {
                            // Si es otro tipo de error, relanzar la excepción para que Laravel la maneje
                            throw $exception;
                        }
                    }
                }
            }
        }
    }

    public static function reporteMesActual()
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
                    'porcentaje_aprobado_promedio' => number_format($porcentajeAprobadoPromedio, 2),
                    'empleados' => $numEmpleadosUnicos
                ];
            });
        });
        return $datosProcesados;
    }
}
