<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        return $this->belongsToMany(Curso::class, "usuarios_cursos",'usuario_id', 'curso_id');
    }

    // FUNCIONES
    public static function getCountEmployesByPuesto()
    {
        $empleados = DB::table('usuarios AS u')
            ->selectRaw('Count(u.id_usuario) as num_empleados, (Count(u.id_usuario) * 100 / (Select Count(id_usuario) From usuarios)) as promedio, p.puesto')
            ->leftJoin('puestos AS p', 'u.puesto_id', '=', 'p.id_puesto')
            ->groupBy('p.puesto')
            ->orderBy("puesto")
            ->get();


        $datos = array_reduce($empleados->toArray(), function ($acc, $currentValue) {
            // dd($currentValue);
            $promedio = $currentValue->num_empleados;
            $puesto = $currentValue->puesto;

            $acc->datos[] = $promedio;
            $acc->etiquetas[] = $puesto;

            return $acc;
        }, (object)[]);
        return $datos;
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
                DB::raw("CONCAT(nombre, ' ', IFNULL(segundo_nombre, ''), ' ', apellido_paterno, ' ', apellido_materno) AS empleado"),
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
}
