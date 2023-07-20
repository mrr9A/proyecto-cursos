<?php

namespace App\Models;

use DateTime;
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

    // PRUEBA NUMERO 1000 PARA GENERARA EL HISTORIAL
    public static function progresoEmpleadosPorTipo($buscar="consultor")
    {
        $usuarios = User::with([
            'puestos',
            'trabajos.cursos.tipo',
            'calificaciones'
        ])
            ->leftJoin('puestos', 'usuarios.puesto_id', '=', 'puestos.id_puesto')
            ->join('sucursales_usuarios', 'sucursales_usuarios.usuario_id', '=', 'usuarios.id_usuario')
            ->join('sucursales', 'sucursales.id_sucursal', '=', 'sucursales_usuarios.sucursal_id')
            ->whereNotNull('usuarios.fecha_alta_planta')
            ->where("sucursales.estado", 1)
            ->where(function ($q) use ($buscar) {
                $q->where('usuarios.nombre', 'like', $buscar . "%")
                    ->orWhere(DB::raw('CONCAT(usuarios.nombre, " ", IFNULL(usuarios.segundo_nombre, ""), " ", usuarios.apellido_paterno, " ", IFNULL(usuarios.apellido_materno, ""))'), 'like', $buscar . "%")
                    ->orWhere('usuarios.segundo_nombre', 'like', $buscar . "%")
                    ->orWhere('usuarios.apellido_paterno', 'like', $buscar . "%")
                    ->orWhere('usuarios.apellido_materno', 'like', $buscar . "%")
                    ->orWhere('usuarios.id_sgp', 'like', $buscar . "%")
                    ->orWhere('usuarios.id_sumtotal', 'like', $buscar . "%")
                    ->orWhere('puestos.puesto', 'like', $buscar . "%")
                    ->where("usuarios.estado", '=', 1);
            })
            ->where("usuarios.rol", '=', 1)
            ->select(
                'usuarios.id_usuario',
                DB::raw("CONCAT(usuarios.nombre, ' ', IFNULL(segundo_nombre, ''), ' ', apellido_paterno, ' ', IFNULL(apellido_materno, '')) AS empleado"),
                'usuarios.*'
            )
            ->orderBy('puestos.puesto', 'asc')
            ->paginate(10)->appends(request()->query());


        $result = $usuarios->map(function ($usuario) {
            $todosCursosTotal = 0;
            $cursosPasadosTotal = 0;
            $cursosProgreso = [];
            $cursosReprobados = [];
            // & indica que la variable esta siendo pasada por referencia
            $trabajos = $usuario->trabajos->map(function ($trabajo) use ($usuario, &$todosCursosTotal, &$cursosPasadosTotal, &$cursosProgreso, &$cursosReprobados) {
                $cursos = $trabajo->cursos->map(function ($curso) use ($usuario) {
                    $calificacion = $usuario->calificaciones
                        ->firstWhere('curso_id', $curso->id_curso);
                    $cali = $calificacion ? $calificacion->valor : null;

                    return (object) [
                        'calificacion' => $cali,
                        'estado' => $calificacion->estado ?? 2,
                        'curso' => $curso->nombre,
                        'tipo' => $curso->tipo->nombre,
                        'id_curso' => $curso->id_curso,
                    ];
                });

                $todosCursos = $cursos->count();
                $todosCursosTotal += $todosCursos;
                $cursosPasados = $cursos->where('calificacion', '=', '100')->where('estado', '=', 1)->count();
                $cursosEnProgreso = $cursos->where('calificacion', '<=', '100')->where('calificacion', '>', 0)->where('estado', 2)->pluck('calificacion')->toArray();
                $cursoReprobados = $cursos->where('estado', 0)->pluck('calificacion')->toArray();
                array_push($cursosProgreso, $cursosEnProgreso);
                array_push($cursosReprobados, $cursoReprobados);
                $cursosPasadosTotal += $cursosPasados;

                return [
                    'trabajo' => $trabajo->nombre,
                    'cursos' => $cursos->groupBy('tipo'),
                ];
            });
            $calCursosProgreso = array_reduce($cursosProgreso, function ($carry, $item) {
                return $carry + array_sum($item);
            }, 0);

            $calcCursosReprobados = array_reduce($cursosReprobados, function ($carry, $item) {
                return $carry + array_sum($item);
            }, 0);
            $porcentaje = bcdiv(($todosCursosTotal != 0) ? (((($cursosPasadosTotal * 100) + $calCursosProgreso + $calcCursosReprobados) * 100) / ($todosCursosTotal * 100)) : 0, '1', 2);

            return (object) [
                'id_usuario' => $usuario->id_usuario,
                "id_sgp" => $usuario->id_sgp,
                "id_sumtotal" => $usuario->id_sumtotal,
                'empleado' => $usuario->empleado,
                'puesto' => $usuario->puestos->puesto,
                'total' => $todosCursosTotal,
                'totalCursosPasados' => $cursosPasadosTotal,
                'cursosEnProgreso' => count($cursosProgreso[0]), //aqui quite esto [0]
                'cursosReprobados' => count($cursosReprobados[0]), //aqui quite esto [0]
                'promedioTotal' => $porcentaje,
            ];
        });

        return [
            "data" => $result,
            "links" => $usuarios->links()
        ];
    }
}
