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
                return $empleado->nombre_curso . '|' . $empleado->fecha;
            })->map(function ($empleadosPorCursoFecha) use ($totalEmpleadosSucursalPorTipos) {
                $porcentajeAprobadoTotal = $empleadosPorCursoFecha->sum('porcentaje_aprobado');
                $nombreCurso = $empleadosPorCursoFecha->first()->nombre_curso;
                $fecha = $empleadosPorCursoFecha->first()->fecha;
                $sucursal = $empleadosPorCursoFecha->first()->sucursal;
                // dd($sucursal);


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
        // return $datosProcesados;

        // Recorrer los datos agrupados por sucursal, nombre_curso y fecha
        foreach ($datosProcesados as $sucursal => $empleadosPorSucursal) {
            foreach ($empleadosPorSucursal as $clave => $empleadosPorCursoFecha) {
                $porcentajeAprobadoPromedio = $empleadosPorCursoFecha['porcentaje_aprobado_promedio'];
                // dd( $empleadosPorCursoFecha['fecha']);
                $fecha = Carbon::createFromFormat('Y-m', $empleadosPorCursoFecha['fecha']);
                $nombreCurso = $empleadosPorCursoFecha['nombre_curso'];

                // Obtener la cantidad de empleados únicos para la sucursal y tipo de curso actual
                // $numEmpleadosUnicos = $empleadosPorTipo[$sucursal][$nombreCurso] ?? 0;

                // Calcular el objetivo según las condiciones especificadas
                $fechaMinima = Carbon::createFromFormat('Y-m', $empleadosPorSucursal->min('fecha'));
                $objetivo = ($fecha == $fechaMinima)
                    ? 16
                    : ($porcentajeAprobadoPromedio + 16);

                // Ahora puedes almacenar los datos en la tabla historia
                // Reemplaza 'nombre_tabla_historia' con el nombre real de tu tabla 'historia'
                DB::table('historial')->insert([
                    'sucursal' => $sucursal,
                    'objetivo' => $objetivo,
                    'real' => $porcentajeAprobadoPromedio,
                    'fecha' => $fecha,
                    'tipo' => $nombreCurso,
                    // Agrega los demás campos que correspondan...
                ]);
            }
        }
        return "hola";
    }
}
