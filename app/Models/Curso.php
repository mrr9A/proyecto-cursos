<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Curso extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_final', 'estado', 'modalidad_id', 'tipo_curso_id', 'codigo','imagen', 'interno_planta'];
=======
    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_termino','interno_planta', 'estado', 'modalidad_id', 'tipo_curso_id', 'codigo','imagen'];
>>>>>>> f989ac1ef1b80bc5b4cc9fcbed90324c8aa40479
    protected $primaryKey = "id_curso";
    public $timestamps = false;


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
        return $this->belongsToMany(User::class, "calificaciones", 'usuario_id_usuario', 'curso_id_curso', 'usuario_id');
    }
    public function usuarioCurso()
    {
        return $this->belongsToMany(User::class, "usuarios_cursos",'curso_id','usuario_id');
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
            ->where([['c.estado', '=', 1 ], ['c.interno_planta', '=', 0]])
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
            "c.nombre as nombre",
            "tc.nombre as tipo",
            "modalidad",
        )
            ->join("modalidad_cursos as mc", "c.modalidad_id", "=", "mc.id_modalidad")
            ->join("tipo_cursos as tc", "c.tipo_curso_id", "=", "tc.id_tipo_curso")
            ->join("puestos_cursos as pc", "c.id_curso", "=", "pc.curso_id")
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

    public function lecciones()
    {
        return $this->hasMany(Leccion::class, 'curso_id');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class,'usuarios_cursos', 'usuario_id','curso_id');
    }

}
