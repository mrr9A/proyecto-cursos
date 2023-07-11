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
    public function usercursos()
    {
        return $this->belongsToMany(Curso::class, "usuarios_cursos", 'usuario_id', 'curso_id')->withPivot('fecha_inicio','fecha_termino');
    }

    public function examen()
    {
        return $this->belongsToMany(Examen::class, 'intentos', 'usuario_id', 'examen_id')->withPivot('limite_intentos', 'numero_intento', 'calificacion');
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
    // este metodo lo utilizaba en pdf controller pero es lo mismo que el que esta en planesformacion con el nombre getMatrizByUser
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

        if ($usuarios->isEmpty()) {
            // El usuario no existe, manejar el caso de error aquí
            return 0;
        }

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
                $cursosPasados = $cursos->where('calificacion', '=', '100')->count();
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
        $usuarios = User::with([
            'puestos',
            'trabajos.cursos.tipo',
            'calificaciones'
        ])
            ->leftJoin('puestos', 'usuarios.puesto_id', '=', 'puestos.id_puesto')
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
            ->select(
                'usuarios.id_usuario',
                DB::raw("CONCAT(nombre, ' ', IFNULL(segundo_nombre, ''), ' ', apellido_paterno, ' ', IFNULL(apellido_materno, '')) AS empleado"),
                'usuarios.*'
            )
            ->orderBy('puestos.puesto', 'asc')
            ->paginate(10)->appends(request()->query());

        // dd($usuarios);

        // if ($usuarios->isEmpty()) {
        //     // El usuario no existe, manejar el caso de error aquí
        //     return 0;
        // }

        $result = $usuarios->map(function ($usuario) {
            $todosCursosTotal = 0;
            $cursosPasadosTotal = 0;
            $cursosProgreso = [];
            // & indica que la variable esta siendo pasada por referencia
            $trabajos = $usuario->trabajos->map(function ($trabajo) use ($usuario, &$todosCursosTotal, &$cursosPasadosTotal, &$cursosProgreso) {
                $cursos = $trabajo->cursos->map(function ($curso) use ($usuario) {
                    $calificacion = $usuario->calificaciones
                        ->firstWhere('curso_id', $curso->id_curso);
                    $cali = $calificacion ? $calificacion->valor : null;

                    return (object) [
                        'calificacion' => $cali,
                        'curso' => $curso->nombre,
                        'tipo' => $curso->tipo->nombre,
                        'id_curso' => $curso->id_curso,
                    ];
                });

                $todosCursos = $cursos->count();
                $todosCursosTotal += $todosCursos;
                $cursosPasados = $cursos->where('calificacion', '=', '100')->count();
                $cursosEnProgreso = $cursos->where('calificacion', '<', '100')->where('calificacion', '>', 0)->pluck('calificacion')->toArray();
                array_push($cursosProgreso, $cursosEnProgreso);
                $cursosPasadosTotal += $cursosPasados;

                return [
                    'trabajo' => $trabajo->nombre,
                    'cursos' => $cursos->groupBy('tipo'),
                ];
            });
            // echo "<script>console.log(" . json_encode($cursosProgreso) . ")</script>";
            $calCursosProgreso = array_reduce($cursosProgreso, function ($carry, $item) {
                return $carry + array_sum($item);
            }, 0);
            $porcentaje = bcdiv(($todosCursosTotal != 0) ? (((($cursosPasadosTotal * 100) + $calCursosProgreso) * 100) / ($todosCursosTotal * 100)) : 0, '1', 2);

            return (object) [
                'id_usuario' => $usuario->id_usuario,
                "id_sgp" => $usuario->id_sgp,
                "id_sumtotal" => $usuario->id_sumtotal,
                'empleado' => $usuario->empleado,
                'puesto' => $usuario->puestos->puesto,
                'total' => $todosCursosTotal,
                'totalCursosPasados' => $cursosPasadosTotal,
                'cursosEnProgreso' => count($cursosProgreso),//aqui quite esto [0]
                'promedioTotal' => $porcentaje,
            ];
        });

        return [
            "data" => $result,
            "links" => $usuarios->links()
        ];
    }

    public static function getUsuariosWithCurses($sucursal_id, $puesto_id)
    {
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $usuarios = DB::table('usuarios')
            ->select(
                'usuarios.id_usuario',
                'sucursales.nombre as sucursal',
                DB::raw("CONCAT(usuarios.nombre, ' ', IFNULL(segundo_nombre, ''), ' ', apellido_paterno, ' ', IFNULL(apellido_materno, '')) AS empleado"),
                'usuarios.id_sgp',
                'usuarios.id_sumtotal',
                'puestos.puesto',
                'trabajos_sumtotal.nombre as trabajo',
                'cursos.nombre as curso',
                'calificaciones.valor'
            )
            ->join('sucursales_usuarios', 'sucursales_usuarios.usuario_id', '=', 'usuarios.id_usuario')
            ->join('sucursales', 'sucursales.id_sucursal', '=', 'sucursales_usuarios.sucursal_id')
            ->join('puestos', 'puestos.id_puesto', '=', 'usuarios.puesto_id')
            ->join('usuarios_trabajos', 'usuarios_trabajos.usuario_id', '=', 'usuarios.id_usuario')
            ->join('trabajos_sumtotal', 'trabajos_sumtotal.id_trabajo', '=', 'usuarios_trabajos.trabajo_id')
            ->join('trabajos_cursos', 'trabajos_cursos.trabajo_id', '=', 'trabajos_sumtotal.id_trabajo')
            ->join('cursos', 'cursos.id_curso', '=', 'trabajos_cursos.curso_id')
            ->leftJoin('calificaciones', 'calificaciones.usuario_id', '=', 'usuarios.id_usuario')
            ->when($sucursal_id, function ($query, $sucursal_id) {
                return $query->where('id_sucursal', $sucursal_id);
            })
            ->when($puesto_id, function ($query, $puesto_id) {
                return $query->where('id_puesto', $puesto_id);
            })
            ->groupBy('curso', 'empleado')
            ->orderBy('id_puesto', 'asc')
            ->orderBy('id_usuario', 'asc')
            ->get();

        return $usuarios;
    }

}
