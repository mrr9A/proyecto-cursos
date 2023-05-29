<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_final', 'estado'];
    protected $primaryKey = "id_curso";


    public function modalidad()
    {
        return $this->hasOne(ModalidadCurso::class, "id_modalidad", 'modalidad_id');
    }
    public function tipo()
    {
        return $this->hasOne(TipoCurso::class,'id_tipo_curso', 'tipo_curso_id',);
    }
    public function usuarios()
    {
        return $this->belongsToMany(User::class, "calificaciones", 'usuario_id_usuario', 'curso_id_curso');
    }

    public function puestos()
    {
        return $this->belongsToMany(Puesto::class, "puestos_cursos", "curso_id", 'puesto_id');
    }

    
    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, "curso_id");
    }


    public static function getAllCursos()
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
            ->where('c.estado', '=', 0)
            ->get();

        return $cursos;
    }

    public static function getCursesByPuestoAndUser($puesto, $usuario)
    {
        // retorna los cursos del usuario dependiendo el puesto
        $cursos = DB::table("puestos_trabajos_cursos as ptc")->select(
            "trabajo_id",
            "id_curso",
            "codigo",
            "c.nombre as curso",
            "tc.nombre as tipo",
            "modalidad",
            "cal.valor",
        )
            ->join('cursos AS c', 'ptc.curso_id', '=', 'c.id_curso')
            ->leftjoin("modalidad_cursos as mc", "c.modalidad_id", "=", "mc.id_modalidad")
            ->leftjoin("tipo_cursos as tc", "c.tipo_curso_id", "=", "tc.id_tipo_curso")
            ->leftJoin('calificaciones AS cal', function ($join) use ($usuario) {
                $join->on('c.id_curso', '=', 'cal.curso_id')
                    ->where('cal.usuario_id', '=', $usuario);
            })
            ->where("trabajo_id", '=', $puesto)
            ->orderBy("id_tipo_curso", "asc")
            ->get();
        return $cursos;
    }

    public static function getCursesByPuesto($puesto)
    {
        // retorna los cursos del usuario dependiendo el puesto
        $cursos = DB::table("cursos as c")->select(
            "puesto_id",
            "id_curso",
            "codigo",
            "c.nombre as curso",
            "tc.nombre as tipo",
            "modalidad",
        )
            ->join("modalidad_cursos as mc", "c.modalidad_id", "=", "mc.id_modalidad")
            ->join("tipo_cursos as tc", "c.tipo_curso_id", "=", "tc.id_tipo_curso")
            ->join("puestos_trabajos_cursos as ptc", "c.id_curso", "=", "ptc.curso_id")
            ->where("pc.puesto_id", '=', $puesto)
            ->orderBy("id_tipo_curso", "asc")
            ->get();
        return $cursos;
    }

    public static function getCursosDisponibles($plan)
    {
        $cursos = DB::table('cursos')
            ->select(
                "id_curso",
                "codigo",
                "cursos.nombre as curso",
                "tipo_cursos.nombre as tipo",
                "modalidad"
            )
            ->leftjoin("modalidad_cursos", "cursos.modalidad_id", "=", "modalidad_cursos.id_modalidad")
            ->leftjoin("tipo_cursos", "cursos.tipo_curso_id", "=", "tipo_cursos.id_tipo_curso")
            ->whereNotIn("id_curso", $plan)
            ->orderBy("id_tipo_curso")
            ->get();


        return $cursos;
    }

}
