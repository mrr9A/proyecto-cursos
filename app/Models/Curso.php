<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_termino', 'estado', 'modalidad_id', 'tipo_curso_id', 'codigo', 'imagen', 'interno_planta'];
    protected $primaryKey = "id_curso";
    public $timestamps = false;

    public function categoria()
    {
        return $this->belongsToMany(Categoria::class, 'categorias_cursos', 'curso_id', 'categoria_id');
    }

    public function modalidad()
    {
        return $this->hasOne(ModalidadCurso::class, "id_modalidad", 'modalidad_id');
    }
    public function tipo()
    {
        return $this->hasOne(TipoCurso::class, 'id_tipo_curso', 'tipo_curso_id',);
    }
    public function usuarios()
    {
        return $this->belongsToMany(User::class, "calificaciones", 'usuario_id_usuario', 'curso_id_curso', 'usuario_id');
    }
    public function usuarioCurso()
    {
        return $this->belongsToMany(User::class, "usuarios_cursos", 'curso_id', 'usuario_id');
    }

    public function puestos()
    {
        return $this->belongsToMany(Puesto::class, "puestos_cursos", "curso_id", 'puesto_id');
    }


    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, "curso_id");
    }

    public function lecciones()
    {
        return $this->hasMany(Leccion::class, 'curso_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'usuarios_cursos', 'usuario_id', 'curso_id');
    }


    public static function getAllCursos($buscar = "")
    {
        $cursos = DB::table('cursos as c')
            ->select(
                "id_curso",
                "codigo",
                "c.nombre",
                "fecha_inicio",
                "fecha_termino",
                "tc.nombre as tipo",
                "modalidad"
            )
            ->leftjoin("modalidad_cursos as mc", "c.modalidad_id", "=", "mc.id_modalidad")
            ->leftjoin("tipo_cursos as tc", "c.tipo_curso_id", "=", "tc.id_tipo_curso")
            ->Where(function ($q) use ($buscar) {
                $q->Where('c.interno_planta', '=', 0)
                    ->Where('tc.nombre', 'like', $buscar . "%")
                    ->orWhere('mc.modalidad', 'like', $buscar . "%")
                    ->orWhere('c.codigo', 'like', $buscar . "%")
                    ->orWhere('c.nombre', 'like', $buscar . "%");
            })
            ->where("c.estado", '=', 1)
            ->get();

        return $cursos;
    }


    public static function getCursesByJob($buscar, $puesto)
    {
        // retorna los cursos del dependiendo el trabajo
        $cursosAsignados = DB::table("trabajos_cursos")->select(
            "trabajo_id",
            "id_curso",
            DB::raw('CONCAT(true) AS asignado'),
            "codigo",
            "c.nombre as nombre",
            "tc.nombre as tipo",
            "modalidad",
        )
            ->leftJoin("cursos as c", "c.id_curso", "=", "trabajos_cursos.curso_id")
            ->join("modalidad_cursos as mc", "c.modalidad_id", "=", "mc.id_modalidad")
            ->join("tipo_cursos as tc", "c.tipo_curso_id", "=", "tc.id_tipo_curso")
            ->where("trabajos_cursos.trabajo_id", '=', $puesto)
            ->Where(function ($q) use ($buscar) {
                $q->Where('c.interno_planta', '=', 0)
                    ->Where('tc.nombre', 'like', $buscar . "%")
                    ->orWhere('mc.modalidad', 'like', $buscar . "%")
                    ->orWhere('c.codigo', 'like', $buscar . "%")
                    ->orWhere('c.nombre', 'like', $buscar . "%");
            })
            ->where("c.estado", '=', 1)
            ->orderBy("trabajo_id", "asc")
            ->get();

        $idsCursosAsignado = $cursosAsignados->pluck('id_curso');

        $cursosDisponibles = DB::table("cursos as c")->select(
            "id_curso",
            "codigo",
            DB::raw('CONCAT(false) AS asignado'),
            "c.nombre as nombre",
            "tc.nombre as tipo",
            "modalidad",
        )
            ->join("modalidad_cursos as mc", "c.modalidad_id", "=", "mc.id_modalidad")
            ->join("tipo_cursos as tc", "c.tipo_curso_id", "=", "tc.id_tipo_curso")
            ->whereNotIn("id_curso", $idsCursosAsignado)
            ->Where(function ($q) use ($buscar) {
                $q->Where('c.interno_planta', '=', 0)
                    ->Where('tc.nombre', 'like', $buscar . "%")
                    ->orWhere('mc.modalidad', 'like', $buscar . "%")
                    ->orWhere('c.codigo', 'like', $buscar . "%")
                    ->orWhere('c.nombre', 'like', $buscar . "%");
            })
            ->where("c.estado", '=', 1)
            ->get();

        $cursos =  array_merge($cursosAsignados->toArray(), $cursosDisponibles->toArray());

        return $cursos;
    }

    public static function getCursesAsigned($trabajo)
    {
        // retorna los cursos del dependiendo el trabajo
        $cursosAsignados = DB::table("trabajos_cursos")->select(
            "trabajo_id",
            "id_curso",
            DB::raw('CONCAT(true) AS asignado'),
            "codigo",
            "c.nombre as nombre",
            "tc.nombre as tipo",
            "modalidad",
        )
            ->leftJoin("cursos as c", "c.id_curso", "=", "trabajos_cursos.curso_id")
            ->join("modalidad_cursos as mc", "c.modalidad_id", "=", "mc.id_modalidad")
            ->join("tipo_cursos as tc", "c.tipo_curso_id", "=", "tc.id_tipo_curso")
            ->where("trabajos_cursos.trabajo_id", '=', $trabajo)
            // ->Where(function ($q) use ($buscar) {
            //     $q->Where('c.interno_planta', '=', 0)
            //         ->Where('tc.nombre', 'like', $buscar . "%")
            //         ->orWhere('mc.modalidad', 'like', $buscar . "%")
            //         ->orWhere('c.codigo', 'like', $buscar . "%")
            //         ->orWhere('c.nombre', 'like', $buscar . "%");
            // })
            ->where("c.estado", '=', 1)
            ->orderBy("trabajo_id", "asc")
            ->get();

        $idsCursosAsignado = $cursosAsignados->pluck('id_curso');

        $cursosDisponibles = DB::table("cursos as c")->select(
            "id_curso",
            "codigo",
            DB::raw('CONCAT(false) AS asignado'),
            "c.nombre as nombre",
            "tc.nombre as tipo",
            "modalidad",
        )
            ->join("modalidad_cursos as mc", "c.modalidad_id", "=", "mc.id_modalidad")
            ->join("tipo_cursos as tc", "c.tipo_curso_id", "=", "tc.id_tipo_curso")
            ->whereNotIn("id_curso", $idsCursosAsignado)
            // ->Where(function ($q) use ($buscar) {
            //     $q->Where('c.interno_planta', '=', 0)
            //         ->Where('tc.nombre', 'like', $buscar . "%")
            //         ->orWhere('mc.modalidad', 'like', $buscar . "%")
            //         ->orWhere('c.codigo', 'like', $buscar . "%")
            //         ->orWhere('c.nombre', 'like', $buscar . "%");
            // })
            ->where("c.estado", '=', 1)
            ->get();

            return [
                "cursosPorTrabajo" => $cursosAsignados,
                "cursosDisponibles" => $cursosDisponibles,
            ];
    }
}
