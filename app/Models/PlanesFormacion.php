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

    public static function getMatrizVentas()
    {
        $puestos = DB::table('planes_formacion as pf')
            ->join('puestos as p', "p.plan_formacion_id", "=", "pf.id_plan_formacion")
            ->where("area", "like", "tecnica")
            ->pluck('id_puesto');
        $puestos->toArray();

        $usuarios = User::with(['trabajos.cursos.tipo', 'calificaciones'])
            ->leftJoin('calificaciones', 'calificaciones.usuario_id', '=', 'usuarios.id_usuario')
            ->whereDoesntHave("puestos", function ($query) use ($puestos) {
                $query->whereIn("puesto_id", $puestos);
            })
            ->select(
                DB::raw("CONCAT(nombre, ' ', IFNULL(segundo_nombre, ''), ' ', apellido_paterno, ' ', IFNULL(apellido_materno, '')) AS empleado"),
                'usuarios.*'
            )
            ->distinct();

        $usuariosPaginados = $usuarios->paginate(10);
        $usuariosPaginados->appends(request()->query());

        $result = $usuariosPaginados->map(function ($usuario) {
            $trabajos = $usuario->trabajos->map(function ($trabajo) use ($usuario) {
                $cursos = $trabajo->cursos->map(function ($curso) use ($usuario) {
                    $calificacion = $usuario->calificaciones
                        ->firstWhere('curso_id', $curso->id_curso);

                    $cali = $calificacion ? $calificacion->valor : null;

                    return (object) [
                        'id_curso' => $curso->id_curso,
                        'nombre_curso' => $curso->nombre,
                        'tipo' => $curso->tipo->nombre,
                        'calificacion' => $cali
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
            'links' => $usuariosPaginados->links()
        ];
    }


    public static function getMatrizTecnica()
    {

        // obtener todos los puestos de la matriz tecnica
        //         select p.id_puesto from planes_formacion as pf
        // inner join puestos p on p.plan_formacion_id = pf.id_plan_formacion
        // where area like "tecnica"
        // ; 
        $puestos = DB::table('planes_formacion as pf')
            ->join('puestos as p', "p.plan_formacion_id", "=", "pf.id_plan_formacion")
            ->where("area", "like", "tecnica")
            ->pluck('id_puesto');
        $puestos->toArray();

        $usuarios = User::with(['calificaciones', 'trabajos.cursos.tipo'])
            ->leftJoin('calificaciones', 'calificaciones.usuario_id', '=', 'usuarios.id_usuario')
            ->whereHas('puestos', function ($query) use ($puestos) {
                $query->whereIn('id_puesto', $puestos);
            })
            ->select(
                DB::raw("CONCAT(nombre, ' ', IFNULL(segundo_nombre, ''), ' ', apellido_paterno, ' ', IFNULL(apellido_materno, '')) AS empleado"),
                'usuarios.*'
            )
            ->distinct();

        // dd($usuarios);
        $usuariosPaginados = $usuarios->paginate(10);
        $usuariosPaginados->appends(request()->query());

        //obtiene los cursos por puesto por que varios trabjos tiene el mismo curso
        $result = $usuariosPaginados->map(function ($usuario) {
            // obtiene los cursos de cada trabajo
            $trabajos = $usuario->trabajos->map(function ($trabajo) use ($usuario) {
                $cursos = $trabajo->cursos->map(function ($curso) use ($usuario) {
                    $calificacion = $usuario->calificaciones
                        ->firstWhere('curso_id', $curso->id_curso);

                    $cali = $calificacion ? $calificacion->valor : null;

                    return (object) [
                        'id_curso' => $curso->id_curso,
                        'nombre_curso' => $curso->nombre,
                        'tipo' => $curso->tipo->nombre,
                        'calificacion' => $cali
                    ];
                });

                $cursosAgrupados = $cursos->groupBy('tipo');
                return [
                    'trabajo' => $trabajo->nombre,
                    'cursos' => $cursosAgrupados
                ];
            });
            $usuario->puesto = $usuario->puestos->puesto;
            $usuario->trabajos = $trabajos->groupBy('trabajo')->toArray();

            // Se utiliza unset($usuario->puestos) para eliminar la relación puestos 
            // del resultado final. Esto evita que los datos innecesarios se incluyan en el resultado.
            unset($usuario->puestos);
            return $usuario;
        });
        return [
            'usuarios' => $result,
            'links' => $usuariosPaginados->links()
        ];
    }
}
