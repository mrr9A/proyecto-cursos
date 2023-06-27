<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'nombre',
    //     'apellido_paterno',
    //     'apellido_materno',
    //     'segundo_nombre',
    //     'estado',
    //     'email',
    //     'password',
    //     "puesto_id"
    // ];
    protected $fillable = [
        'nombre',
        'segundo_nombre',
        'apellido_paterno',
        'apellido_materno',
        'id_sgp',
        'id_sumtotal',
        'rol',
        'sucursal_id',
        'puesto_id',
        'email',
        'estado',
        'password',
        'fecha_alta_planta',
        'fecha_ingreso_puesto'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    // ATRIBUTOS
    protected $table = "usuarios";
    protected $primaryKey = "id_usuario";
    public $timestamps = false;

    // REALACIONES DE LA TABLA
    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class, "sucursales_usuarios", "usuario_id", "sucursal_id");
    }
    public function puestos()
    {
        return $this->belongsTo(Puesto::class, "puesto_id", "id_puesto");
    }

    public function trabajos()
    {
        return $this->belongsToMany(Trabajo::class, "usuarios_trabajos", "usuario_id", 'trabajo_id');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, "usuario_id");
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, "usuarios_cursos", 'usuario_id', 'curso_id');
    }

    // FUNCIONES
    public static function getCountEmployesByPuesto()
    {
        $empleados = DB::table('puestos AS p')
            ->leftJoin('usuarios AS u', 'u.puesto_id', '=', 'p.id_puesto')
            ->selectRaw('Count(u.id_usuario) as num_empleados, p.puesto, p.id_puesto')
            // ->selectRaw('Count(u.id_usuario) as num_empleados, (Count(u.id_usuario) * 100 / (Select Count(id_usuario) From usuarios)) as promedio, p.puesto, p.id_puesto')
            ->where("u.estado", 1)
            ->groupBy('p.id_puesto')
            ->orderBy("puesto")
            ->get()->toArray();

        return $empleados;
    }

    public static function getProgressByUser($user)
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


        $result = $usuarios->map(function ($usuario) {
            $todosCursosTotal = 0;
            $cursosPasadosTotal = 0;
            // & indica que la variable esta siendo pasada por referencia
            $trabajos = $usuario->trabajos->map(function ($trabajo) use ($usuario, &$todosCursosTotal, &$cursosPasadosTotal) {
                $cursos = $trabajo->cursos->map(function ($curso) use ($usuario) {
                    $calificacion = $usuario->calificaciones
                        ->firstWhere('curso_id', $curso->id_curso);
                    $cali = $calificacion ? $calificacion->valor : null;

                    return (object) [
                        'calificacion' => $cali,
                        'curso' => $curso->nombre,
                        'tipo' => $curso->tipo->nombre
                    ];
                });

                $todosCursos = $cursos->count();
                $todosCursosTotal += $todosCursos;
                $cursosPasados = $cursos->where('calificacion', '=', 'aprovado')->count();
                $cursosPasadosTotal += $cursosPasados;

                return [
                    'trabajo' => $trabajo->nombre,
                    'cursos' => $cursos->groupBy('tipo'),
                ];
            });

            $porcentaje = bcdiv(($todosCursosTotal != 0) ? ($cursosPasadosTotal / $todosCursosTotal) * 100 : 0, '1', 2);

            return (object) [
                'id_usuario' => $usuario->id_usuario,
                'nombre' => $usuario->empleado,
                'puesto' => $usuario->puestos->puesto,
                'id_puesto' => $usuario->puestos->id_puesto,
                'totalCursos' => $todosCursosTotal,
                'cursosPasados' => $cursosPasadosTotal,
                'progreso' => $porcentaje,
                'trabajos' => $trabajos,
            ];
        });
        // dd($result);
        return $result;
    }


    public static function progresoEmpleados($buscar = "")
    {
        // puestos que son tecnicos
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        // $resultado = User::with(['trabajos.cursos.tipo'])
        //     ->select(
        //         'usuarios.id_usuario',
        //         'usuarios.id_sgp',
        //         'usuarios.id_sumtotal',
        //         DB::raw('COUNT(DISTINCT c.nombre) AS total_cursos'),
        //         DB::raw('COUNT(calificaciones.valor) AS cursos_pasados'),
        //         DB::raw('CONCAT(usuarios.nombre, " ", IFNULL(usuarios.segundo_nombre, ""), " ", usuarios.apellido_paterno, " ", IFNULL(usuarios.apellido_materno, "")) AS empleados'),
        //         'puestos.puesto',
        //         'tipo_cursos.nombre AS tipo'
        //     )
        //     ->join('puestos', 'usuarios.puesto_id', '=', 'puestos.id_puesto')
        //     ->join('usuarios_trabajos as ut', 'usuarios.id_usuario', '=', 'ut.usuario_id')
        //     ->join('trabajos_sumtotal as ts', "ts.id_trabajo", "=", "ut.trabajo_id")
        //     ->join('trabajos_cursos as tc', "tc.trabajo_id", "=", "ut.trabajo_id")
        //     ->join('cursos as c', 'tc.curso_id', '=', 'c.id_curso')
        //     ->join('tipo_cursos', 'c.tipo_curso_id', '=', 'tipo_cursos.id_tipo_curso')
        //     ->leftJoin('calificaciones', function ($join) {
        //         $join->on('c.id_curso', '=', 'calificaciones.curso_id')
        //             ->on('usuarios.id_usuario', '=', 'calificaciones.usuario_id');
        //     })
        //     ->groupBy('id_usuario', 'puestos.puesto', 'tipo_cursos.nombre')
        //     ->where("tipo_cursos.nombre", "!=", "complementarios")
        //     ->where(function ($q) use ($buscar) {
        //         $q->where('usuarios.nombre', 'like', $buscar . "%")
        //             ->orWhere(DB::raw('CONCAT(usuarios.nombre, " ", IFNULL(usuarios.segundo_nombre, ""), " ", usuarios.apellido_paterno, " ", IFNULL(usuarios.apellido_materno, ""))'), 'like', $buscar . "%")
        //             ->orWhere('usuarios.segundo_nombre', 'like', $buscar . "%")
        //             ->orWhere('usuarios.apellido_paterno', 'like', $buscar . "%")
        //             ->orWhere('usuarios.apellido_materno', 'like', $buscar . "%")
        //             ->orWhere('puestos.puesto', 'like', $buscar . "%")
        //             ->orWhere('usuarios.id_sgp', 'like', $buscar . "%")
        //             ->orWhere('usuarios.id_sumtotal', 'like', $buscar . "%");
        //     })
        //     ->orderBy('puestos.puesto')
        //     ->orderBy('empleados')
        //     ->get();
        $resultado = User::with(['trabajos.cursos.tipo'])
            ->select(
                'usuarios.id_usuario',
                'usuarios.id_sgp',
                'usuarios.id_sumtotal',
                DB::raw('COUNT(DISTINCT c.nombre) AS total_cursos'),
                DB::raw('COUNT(calificaciones.valor) AS cursos_pasados'),
                DB::raw('CONCAT(usuarios.nombre, " ", IFNULL(usuarios.segundo_nombre, ""), " ", usuarios.apellido_paterno, " ", IFNULL(usuarios.apellido_materno, "")) AS empleados'),
                'puestos.puesto',
                'tipo_cursos.nombre AS tipo'
            )
            ->join('puestos', 'usuarios.puesto_id', '=', 'puestos.id_puesto')
            ->join('usuarios_trabajos as ut', 'usuarios.id_usuario', '=', 'ut.usuario_id')
            ->join('trabajos_sumtotal as ts', "ts.id_trabajo", "=", "ut.trabajo_id")
            ->leftJoin('trabajos_cursos as tc', "tc.trabajo_id", "=", "ut.trabajo_id")
            ->leftJoin('cursos as c', function ($join) {
                $join->on('tc.curso_id', '=', 'c.id_curso')
                    ->on('c.tipo_curso_id', '!=', DB::raw("'complementarios'"));
            })
            ->leftJoin('tipo_cursos', 'c.tipo_curso_id', '=', 'tipo_cursos.id_tipo_curso')
            ->leftJoin('calificaciones', function ($join) {
                $join->on('c.id_curso', '=', 'calificaciones.curso_id')
                    ->on('usuarios.id_usuario', '=', 'calificaciones.usuario_id');
            })
            ->groupBy('id_usuario', 'puestos.puesto', 'tipo_cursos.nombre')
            ->where(function ($q) use ($buscar) {
                $q->where('usuarios.nombre', 'like', $buscar . "%")
                    ->orWhere(DB::raw('CONCAT(usuarios.nombre, " ", IFNULL(usuarios.segundo_nombre, ""), " ", usuarios.apellido_paterno, " ", IFNULL(usuarios.apellido_materno, ""))'), 'like', $buscar . "%")
                    ->orWhere('usuarios.segundo_nombre', 'like', $buscar . "%")
                    ->orWhere('usuarios.apellido_paterno', 'like', $buscar . "%")
                    ->orWhere('usuarios.apellido_materno', 'like', $buscar . "%")
                    ->orWhere('puestos.puesto', 'like', $buscar . "%")
                    ->orWhere('usuarios.id_sgp', 'like', $buscar . "%")
                    ->orWhere('usuarios.id_sumtotal', 'like', $buscar . "%")
                    ->where("usuarios.estado", '=', 1);
            })
            ->orderBy('puestos.puesto')
            ->orderBy('empleados')
            ->paginate(10)->appends(request()->query());
        // ->get();


        $resultado = $resultado->toArray();
        // dd($resultado['data']);
        // $resultado = $resultado->toArray();
        $totalCursos = 0;
        $totalCursosPasados = 0;
        $map = array_reduce($resultado['data'], function ($acc, $cur) use ($totalCursos, $totalCursosPasados) {
            $usuario_id = $cur['id_usuario'];
            if (!array_key_exists($usuario_id, $acc)) {
                $acc[$usuario_id] = (object)[
                    "id_usuario" => $usuario_id,
                    "id_sgp" => $cur['id_sgp'],
                    "id_sumtotal" => $cur['id_sumtotal'],
                    "empleado" => $cur['empleados'],
                    "puesto" => $cur['puesto'],
                    "total" => $totalCursos,
                    "totalCursosPasados" => $totalCursosPasados,
                    "cursos" => []
                ];
            }
            $totalCursos = $cur['total_cursos'] + $acc[$usuario_id]->total;
            $totalCursosPasados = $cur['cursos_pasados'] + $acc[$usuario_id]->totalCursosPasados;

            $acc[$usuario_id]->total = $totalCursos;
            $acc[$usuario_id]->totalCursosPasados = $totalCursosPasados;
            // $acc[$usuario_id]->promedioTotal = (bcdiv($totalCursosPasados / $totalCursos * 100, '1', 2)) ?? 0;
            try {
                $promedioTotal = 0;
                if ($totalCursos != 0) {
                    $promedioTotal = bcdiv($totalCursosPasados / $totalCursos * 100, '1', 2);
                }
                $acc[$usuario_id]->promedioTotal = $promedioTotal;
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
                // Aquí puedes mostrar el mensaje de error o realizar acciones adicionales de manejo de errores
                $acc[$usuario_id]->promedioTotal = 0;
            }

            $obj = [
                "tipo" => $cur["tipo"],
                "objetivo" => $cur["total_cursos"],
                "real" => $cur["cursos_pasados"],
                "progeso" => bcdiv(($cur["total_cursos"] != 0) ? ($cur["cursos_pasados"] / $cur["total_cursos"]) * 100 : 0, '1', 2),
            ];

            array_push($acc[$usuario_id]->cursos, $obj);
            return $acc;
        }, []);

        return [
            "data" => $map,
            "links" => $resultado['links']
        ];
    }
}
