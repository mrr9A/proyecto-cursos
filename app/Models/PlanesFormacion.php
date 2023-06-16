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


    public function puestos()
    {
        return $this->hasMany(Puesto::class, "plan_formacion_id");
    }

    public static function getMatrizVentas()
    {
        $usuarios = User::with(['trabajos.cursos.tipo', 'calificaciones'])
            ->leftJoin('calificaciones', 'calificaciones.usuario_id', '=', 'usuarios.id_usuario')
            ->whereDoesntHave("puestos", function ($query) {
                $query->whereIn("puesto", ["tecnico mecanico", 'master technician']);
            })
            ->select(
                DB::raw("CONCAT(nombre, ' ', IFNULL(segundo_nombre, ''), ' ', apellido_paterno, ' ', apellido_materno) AS empleado"),
                'usuarios.*'
            )
            ->distinct()
            ->get();

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

        return $result;



        // $cursos = $usuario->puestos()->get()->flatMap(function ($puesto) use ($usuario) {
        //     return $puesto->cursos->map(function ($curso) use ($usuario) {
        //         $calificacion = $usuario->calificaciones
        //             ->firstWhere('curso_id', $curso->id_curso);

        //         $cali = $calificacion ? $calificacion->valor : null;

        //         return (object) [
        //             'id_curso' => $curso->id_curso,
        //             'nombre_curso' => $curso->nombre,
        //             'tipo' => $curso->tipo->nombre,
        //             'id_tipo' => $curso->tipo->id_tipo_curso,
        //             'calificacion' => $cali
        //         ];
        //     });
        // });
        // dd($cursos);
        // $grupos = $cursos->groupBy('tipo');
        // $usuario->cursos = $grupos->map(function ($grupo) {
        //     return $grupo->sortBy('id_tipo')->values();
        // })->toArray();

        // dd($usuario);

        // $usuario->cursos = $cursos->groupBy('tipo')->toArray();
        // $usuario->puesto = $usuario->puestos->puesto;

        // $usuario->cursos = $grupos->sortBy('id_tipo')->toArray();
        // $usuario->cursos = $cursos->groupBy('tipo')->toArray();
        // $usuario->puesto = $usuario->puestos->puesto;
        // Se utiliza unset($usuario->puestos) para eliminar la relación puestos 
        // del resultado final. Esto evita que los datos innecesarios se incluyan en el resultado.
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
                DB::raw("CONCAT(nombre, ' ', IFNULL(segundo_nombre, ''), ' ', apellido_paterno, ' ', apellido_materno) AS empleado"),
                'usuarios.*'
            )
            ->distinct()
            ->get();

        // dd($usuarios);

        //obtiene los cursos por puesto por que varios trabjos tiene el mismo curso
        $result = $usuarios->map(function ($usuario) {
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

        // dd($result);



        // $usuarios = User::with([
        //     'puestos',
        //     'trabajos.cursos.tipo',
        //     'calificaciones'
        // ])
        //     ->whereHas('puestos', function ($query) use ($puestos) {
        //         $query->whereIn('id_puesto', $puestos);
        //     })
        //     ->select(
        //         DB::raw("CONCAT(nombre, ' ', IFNULL(segundo_nombre, ''), ' ', apellido_paterno, ' ', apellido_materno) AS empleado"),
        //         'usuarios.*'
        //     )
        //     ->get();


        // $result = $usuarios->map(function ($usuario) {
        //     $trabajos = $usuario->trabajos->map(function ($trabajo) use ($usuario) {
        //         $cursos = $trabajo->cursos->map(function ($curso) use ($usuario) {
        //             $calificacion = $usuario->calificaciones
        //                 ->firstWhere('curso_id', $curso->id_curso);

        //             $cali = $calificacion ? $calificacion->valor : null;

        //             return (object) [
        //                 'id_curso' => $curso->id_curso,
        //                 'nombre_curso' => $curso->nombre,
        //                 'tipo' => $curso->tipo->nombre,
        //                 'calificacion' => $cali
        //             ];
        //         });

        //         $cursosAgrupados = $cursos->groupBy('tipo');
        //         return [
        //             'trabajo' => $trabajo->nombre,
        //             'cursos' => $cursosAgrupados
        //         ];
        //     });

        //     return (object) [
        //         'id_usuario' => $usuario->id_usuario,
        //         'empleado' => $usuario->empleado,
        //         'puesto' => $usuario->puestos->puesto,
        //         'id_puesto' => $usuario->puestos->id_puesto,
        //         'trabajos' => $trabajos,
        //     ];
        // });
        return $result;
    }
}
