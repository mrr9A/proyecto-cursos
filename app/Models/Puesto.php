<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Puesto extends Model
{
    use HasFactory;
    protected $primaryKey = "id_puesto";
    public $timestamps = false;

    protected $fillable = ["puesto", "estado", "plan_formacion_id"];

    public function usuarios()
    {
        return $this->hasMany(User::class, "puesto_id", "id_puesto");
    }

    public function planes_formacion()
    {
        return $this->belongsTo(PlanesFormacion::class, "plan_formacion_id");
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, "puestos_cursos", 'puesto_id', 'curso_id');
    }
    public function trabajos()
    {
        return $this->hasMany(Trabajo::class, "puesto_id", 'id_puesto');
    }

    public static function getPuestosByPlanformacion()
    {
    }

    // get progreso de los empleados de ventas
    public static function prueba()
    {
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $resultado = User::with(['puestos.cursos.tipo'])
            ->select(
                'usuarios.id_usuario',
                DB::raw('COUNT(cursos.nombre) AS total_cursos'),
                // DB::raw('COUNT(DISTINCT cursos.nombre) AS total_cursos') -> se elimino por que hay cursos con el mismo nombre pero en caso de que no sea el caso se puede descomentar,
                DB::raw('COUNT(calificaciones.valor) AS cursos_pasados'),
                DB::raw('CONCAT(usuarios.nombre, " ", IFNULL(usuarios.segundo_nombre, ""), " ", usuarios.apellido_paterno, " ", usuarios.apellido_materno) AS empleados'),
                'puestos.puesto',
                'tipo_cursos.nombre AS tipo'
            )
            ->join('puestos', 'usuarios.puesto_id', '=', 'puestos.id_puesto')
            ->join('puestos_cursos', 'puestos.id_puesto', '=', 'puestos_cursos.puesto_id')
            ->join('cursos', 'puestos_cursos.curso_id', '=', 'cursos.id_curso')
            ->join('tipo_cursos', 'cursos.tipo_curso_id', '=', 'tipo_cursos.id_tipo_curso')
            ->leftJoin('calificaciones', function ($join) {
                $join->on('cursos.id_curso', '=', 'calificaciones.curso_id')
                    ->on('usuarios.id_usuario', '=', 'calificaciones.usuario_id');
            })
            ->groupBy('id_usuario', 'puestos.puesto', 'tipo_cursos.nombre')
            ->whereHas('puestos', function ($query) {
                // un arreglo con los valores que no queremos
                $query->whereNotIn('puesto', ["tecnico mecanico"]);
            })
            ->where("tipo_cursos.nombre", "!=", "complementarios")
            ->orderBy('puestos.puesto')
            ->orderBy('empleados')
            ->get();

        $resultado = $resultado->toArray();
        $totalCursos = 0;
        $totalCursosPasados = 0;
        $map = array_reduce($resultado, function ($acc, $cur) use ($totalCursos, $totalCursosPasados) {
            $usuario_id = $cur['id_usuario'];
            if (!array_key_exists($usuario_id, $acc)) {
                $acc[$usuario_id] = (object)[
                    "id_usuario" => $usuario_id,
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
            $acc[$usuario_id]->promedioTotal = bcdiv($totalCursosPasados / $totalCursos * 100, '1', 2);

            $obj = [
                "tipo" => $cur["tipo"],
                "objetivo" => $cur["total_cursos"],
                "real" => $cur["cursos_pasados"],
                "progeso" => bcdiv(($cur["total_cursos"] != 0) ? ($cur["cursos_pasados"] / $cur["total_cursos"]) * 100 : 0, '1', 2),
            ];

            array_push($acc[$usuario_id]->cursos, $obj);
            return $acc;
        }, []);
        return $map;
    }


    public static function prueba2()
    {
        // DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        // $resultado = User::with(['puestos.cursos.tipo','trabajos.cursos.tipo'])
        //     ->select(
        //         'usuarios.id_usuario',
        //         DB::raw('COUNT(c.nombre) AS total_cursos'),
        //         DB::raw('COUNT(calificaciones.valor) AS cursos_pasados'),
        //         DB::raw('CONCAT(usuarios.nombre, " ", IFNULL(usuarios.segundo_nombre, ""), " ", usuarios.apellido_paterno, " ", usuarios.apellido_materno) AS empleados'),
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
        //     ->orderBy('puestos.puesto')
        //     ->orderBy('empleados')
        //     ->get();


        //     dd($resultado);
        // $resultado = $resultado->toArray();


        // $totalCursos = 0;
        // $totalCursosPasados = 0;
        // $map = array_reduce($resultado, function ($acc, $cur) use ($totalCursos, $totalCursosPasados) {
        //     $usuario_id = $cur['id_usuario'];

        //     if (!array_key_exists($usuario_id, $acc)) {
        //         $acc[$usuario_id] = (object)[
        //             "id_usuario" => $usuario_id,
        //             "empleado" => $cur['empleados'],
        //             "puesto" => $cur['puesto'],
        //             "total" => $totalCursos,
        //             "totalCursosPasados" => $totalCursosPasados,
        //             "cursos" => []
        //         ];
        //         // echo "<script>console.log(".json_encode($acc[$usuario_id]).")</script>";
        //         // echo "<script>console.log(".json_encode($cur).")</script>";
        //     }

        //     echo "<script>console.log(" . $cur['total_cursos'] . ")</script>";

        //     $totalCursos = $cur['total_cursos'] + $acc[$usuario_id]->total;
        //     $totalCursosPasados = $cur['cursos_pasados'] + $acc[$usuario_id]->totalCursosPasados;

        //     $acc[$usuario_id]->total = $totalCursos;
        //     $acc[$usuario_id]->totalCursosPasados = $totalCursosPasados;
        //     $acc[$usuario_id]->promedioTotal = bcdiv($totalCursosPasados / $totalCursos * 100, '1', 2);

        //     $obj = [
        //         "tipo" => $cur["tipo"],
        //         "objetivo" => $cur["total_cursos"],
        //         "real" => $cur["cursos_pasados"],
        //         "progeso" => bcdiv(($cur["total_cursos"] != 0) ? ($cur["cursos_pasados"] / $cur["total_cursos"]) * 100 : 0, '1', 2),
        //     ];

        //     array_push($acc[$usuario_id]->cursos, $obj);
        //     return $acc;
        // }, []);
        // return $map;











        $puestos = DB::table('planes_formacion as pf')
            ->join('puestos as p', "p.plan_formacion_id", "=", "pf.id_plan_formacion")
            ->where("area", "like", "tecnica")
            ->pluck('id_puesto');
        $puestos->toArray();



        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        // cursos de los empleados por puesto
        $resultados1 = DB::table('cursos')
            ->selectRaw('COUNT(cursos.nombre) AS total_cursos, COUNT(calificaciones.valor) AS cursos_pasados, usuarios.nombre, puestos.*')
            ->join('tipo_cursos', 'tipo_cursos.id_tipo_curso', '=', 'cursos.tipo_curso_id')
            ->join('usuarios', 'usuarios.puesto_id', '=', 'puestos.id_puesto')
            ->leftJoin('calificaciones', function ($join) {
                $join->on('cursos.id_curso', '=', 'calificaciones.curso_id')
                    ->on('usuarios.id_usuario', '=', 'calificaciones.usuario_id');
            })
            ->where(function ($query) use ($puestos) {
                $query->whereIn('puestos.id_puesto', $puestos)
                    ->whereExists(function ($subquery) {
                        $subquery->select(DB::raw(1))
                            ->from('usuarios_trabajos')
                            ->join('trabajos_sumtotal', 'trabajos_sumtotal.id_trabajo', '=', 'usuarios_trabajos.trabajo_id')
                            ->whereColumn('usuarios.id_usuario', '=', 'usuarios_trabajos.usuario_id');
                    });
            })
            ->groupBy('usuarios.id_usuario')
            ->get();


        //  total de cursos de los empleados que tiene trabajos
        $resultados2 = DB::table('cursos')
            ->selectRaw('usuarios.id_usuario, COUNT(cursos.nombre) AS total_cursos, trabajos_sumtotal.nombre as trabajo, COUNT(calificaciones.valor) AS cursos_pasados, usuarios.nombre')
            ->join('tipo_cursos', 'tipo_cursos.id_tipo_curso', '=', 'cursos.tipo_curso_id')
            ->join('trabajos_cursos', 'trabajos_cursos.curso_id', '=', 'cursos.id_curso')
            ->join('trabajos_sumtotal', 'trabajos_sumtotal.id_trabajo', '=', 'trabajos_cursos.trabajo_id')
            ->join('usuarios_trabajos', 'usuarios_trabajos.trabajo_id', '=', 'trabajos_sumtotal.id_trabajo')
            ->join('usuarios', 'usuarios.id_usuario', '=', 'usuarios_trabajos.usuario_id')
            ->leftJoin('calificaciones', function ($join) {
                $join->on('cursos.id_curso', '=', 'calificaciones.curso_id')
                    ->on('usuarios.id_usuario', '=', 'calificaciones.usuario_id');
            })
            ->groupBy('trabajo', 'usuarios.id_usuario')
            ->get();

            $resultados1 = $resultados1->groupBy('usuarios.id_usuario');
            $resultados2 = $resultados2->groupBy('usuarios.id_usuario');
            
            $totalCursos1 = $resultados1->sum('total_cursos');
            $totalCursos2 = $resultados2->sum('total_cursos');
            
            $totalCursos = $totalCursos1 + $totalCursos2;


        // dd($resultados2);
        dd($totalCursos);




        $resultado = $resultados->toArray();


        $totalCursos = 0;
        $totalCursosPasados = 0;
        $map = array_reduce($resultado, function ($acc, $cur) use ($totalCursos, $totalCursosPasados) {
            $usuario_id = $cur['id_usuario'];

            if (!array_key_exists($usuario_id, $acc)) {
                $acc[$usuario_id] = (object)[
                    "id_usuario" => $usuario_id,
                    "empleado" => $cur['empleados'],
                    "puesto" => $cur['puesto'],
                    "total" => $totalCursos,
                    "totalCursosPasados" => $totalCursosPasados,
                    "cursos" => []
                ];
                // echo "<script>console.log(".json_encode($acc[$usuario_id]).")</script>";
                // echo "<script>console.log(".json_encode($cur).")</script>";
            }

            echo "<script>console.log(" . $cur['total_cursos'] . ")</script>";

            $totalCursos = $cur['total_cursos'] + $acc[$usuario_id]->total;
            $totalCursosPasados = $cur['cursos_pasados'] + $acc[$usuario_id]->totalCursosPasados;

            $acc[$usuario_id]->total = $totalCursos;
            $acc[$usuario_id]->totalCursosPasados = $totalCursosPasados;
            $acc[$usuario_id]->promedioTotal = bcdiv($totalCursosPasados / $totalCursos * 100, '1', 2);

            $obj = [
                "tipo" => $cur["tipo"],
                "objetivo" => $cur["total_cursos"],
                "real" => $cur["cursos_pasados"],
                "progeso" => bcdiv(($cur["total_cursos"] != 0) ? ($cur["cursos_pasados"] / $cur["total_cursos"]) * 100 : 0, '1', 2),
            ];

            array_push($acc[$usuario_id]->cursos, $obj);
            return $acc;
        }, []);
        return $map;
    }
}
