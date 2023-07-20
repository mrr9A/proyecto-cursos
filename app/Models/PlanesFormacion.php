<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanesFormacion extends Model
{
    use HasFactory;
    protected $primaryKey = "id_plan_formacion";
    protected $table = "planes_formacion";
    protected $fillable = ['tema', 'area', 'estado'];
    public $timestamps = false;


    public function puestos()
    {
        return $this->hasMany(Puesto::class, "plan_formacion_id");
    }

    public static function getMatrices($buscar = "", $sucursal)
    {
        $usuarios = User::with(['trabajos.cursos.tipo', 'calificaciones'])
            ->leftJoin('calificaciones', 'calificaciones.usuario_id', '=', 'usuarios.id_usuario')
            ->join('sucursales_usuarios', 'sucursales_usuarios.usuario_id', '=', 'usuarios.id_usuario')
            ->join('sucursales', 'sucursales.id_sucursal', '=', 'sucursales_usuarios.sucursal_id')
            ->where(function ($query) use ($sucursal) {
                if ($sucursal !== null) {
                    $query->where('sucursales.id_sucursal', $sucursal);
                }
            })
            ->where(function ($q) use ($buscar, $sucursal) {
                $q->where(function ($innerQuery) use ($buscar) {
                    $innerQuery->where('usuarios.nombre', 'like', $buscar . "%")
                        ->orWhere(DB::raw('CONCAT(usuarios.nombre, " ", IFNULL(usuarios.segundo_nombre, ""), " ", usuarios.apellido_paterno, " ", IFNULL(usuarios.apellido_materno, ""))'), 'like', $buscar . "%")
                        ->orWhere('usuarios.segundo_nombre', 'like', $buscar . "%")
                        ->orWhere('usuarios.apellido_paterno', 'like', $buscar . "%")
                        ->orWhere('usuarios.apellido_materno', 'like', $buscar . "%");
                })
                    ->orWhereHas('trabajos', function ($innerQuery) use ($buscar) {
                        $innerQuery->where('nombre', 'like', $buscar . "%");
                    })
                    ->orWhere('usuarios.id_sgp', 'like', $buscar . "%")
                    ->orWhere('usuarios.id_sumtotal', 'like', $buscar . "%");
            })
            ->where("usuarios.estado", '=', 1)
            ->where("usuarios.rol", '=', 1)
            ->whereNotNull("usuarios.fecha_alta_planta")
            ->where('sucursales.estado', 1)

            ->select(
                DB::raw("CONCAT(usuarios.nombre, ' ', IFNULL(segundo_nombre, ''), ' ', apellido_paterno, ' ', IFNULL(apellido_materno, '')) AS empleado"),
                'usuarios.*'
            )
            ->orderBy('puesto_id', 'asc')
            ->distinct()
            ->paginate(6)->appends(request()->query());
        $result = $usuarios->map(function ($usuario) {
            $trabajos = $usuario->trabajos->map(function ($trabajo) use ($usuario) {
                $cursos = $trabajo->cursos->map(function ($curso) use ($usuario) {
                    $calificacion = $usuario->calificaciones
                        ->firstWhere('curso_id', $curso->id_curso);

                    $cali = $calificacion ? $calificacion->valor : null;

                    return (object) [
                        'id_curso' => $curso->id_curso,
                        'nombre_curso' => $curso->nombre,
                        'tipo' => $curso->tipo->nombre,
                        'calificacion' => $cali,
                        'estado' => $calificacion->estado ?? 2
                    ];
                });

                $cursosAgrupados = $cursos->groupBy('tipo');
                return [
                    'trabajo' => $trabajo->nombre,
                    'cursos' => $cursosAgrupados
                ];
            });

            $usuario->trabajos = $trabajos->groupBy('trabajo')->toArray();
            $usuario->puesto = $usuario->puestos->puesto;
            unset($usuario->puestos);
            return $usuario;
        });

        return [
            'usuarios' => $result,
            'links' => $usuarios->links()
        ];
    }

    public static function getMatrizByUser($user)
    {
        $usuarios = User::with([
            'puestos',
            'trabajos.cursos.tipo',
            'calificaciones'
        ])
            ->where("id_usuario", "=", $user)
            ->select(
                'usuarios.id_usuario',
                DB::raw("CONCAT(nombre, ' ', IFNULL(segundo_nombre, ''), ' ', apellido_paterno, ' ', IFNULL(apellido_materno, '')) AS empleado"),
                'usuarios.*'
            )
            ->get();
        if ($usuarios->isEmpty()) {
            // El usuario no existe, manejar el caso de error aquí
            return 0;
        }

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
            // echo "<script>console.log(" . json_encode($cursosReprobados) . ")</script>";
            $cursosProgreso = array_reduce($cursosProgreso, function ($carry, $item) {
                return $carry + array_sum($item);
            }, 0);

            $cursosReprobados = array_reduce($cursosReprobados, function ($carry, $item) {
                return $carry + array_sum($item);
            }, 0);
            $porcentaje = bcdiv(($todosCursosTotal != 0) ? (((($cursosPasadosTotal * 100) + $cursosProgreso + $cursosReprobados) * 100) / ($todosCursosTotal * 100)) : 0, '1', 2);

            return (object) [
                'id_usuario' => $usuario->id_usuario,
                'nombre' => $usuario->empleado,
                'puesto' => $usuario->puestos->puesto,
                'id_puesto' => $usuario->puestos->id_puesto,
                'totalCursos' => $todosCursosTotal,
                'cursosPasados' => $cursosPasadosTotal,
                'cursosPro' => $cursosProgreso,
                'progreso' => $porcentaje,
                'trabajos' => $trabajos,
            ];
        });
        // dd($result);
        return $result;
    }
}
