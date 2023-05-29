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

    public static function prueba()
    {
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $resultado = User::with(['puestos.cursos.tipo'])
            ->select(
                'usuarios.id_usuario',
                DB::raw('COUNT(DISTINCT cursos.nombre) AS total_cursos'),
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
            ->orderBy('puestos.puesto')
            ->orderBy('empleados')
            ->get();

        $resultado = $resultado->toArray();
        $map = array_reduce($resultado, function ($acc, $cur) {
            $usuario_id = $cur['id_usuario'];
            if (!array_key_exists($usuario_id, $acc)) {
                $acc[$usuario_id] = (object)[
                    "empleado" => $cur['empleados'],
                    "puesto" => $cur['puesto'],
                    "cursos" => []
                ];
            }
            $obj = [
                "tipo" => $cur["tipo"],
                "objetivo" => $cur["total_cursos"],
                "real" => $cur["cursos_pasados"],
                "progeso" => ($cur["total_cursos"] != 0) ? ($cur["cursos_pasados"] / $cur["total_cursos"]) * 100 : 0,
            ];
            array_push($acc[$usuario_id]->cursos, $obj);
            return $acc;
        }, []);
        return $map;
        // function ($accumulator, $currentValue) {
        //     // cursos = arreglo->objetos [{},{}]
        //     // vuelta uno 
        //     // $accumulator = {} -> porque el valor incial pasado a la funcion reduce es un [] que se convierte en objeto 
        //     // $currentValue = curso actual recorrido es un objeto {atributos}
        //     $tipo = $currentValue->tipo;
        //     // recuperamos el tipo al que pertenece = funamentos, inciales, especialidad
        //     if (!property_exists($accumulator, $tipo)) {
        //         // verificamos si existe en el objeto $accumulator si la propiedad $tipo no existe
        //         $accumulator->$tipo = array();
        //         // creamos la propiedad y indicamos que es un arreglo
        //     }
        //     array_push($accumulator->$tipo, $currentValue);
        //     // almacenamos en el areglo de tipo['iniciales,] el objeto acutal recorrido
        //     // en la primera vuelta el acumulador tiene los sig. valores
        //     /**
        //      * vuelta 1;
        //      * accumulator = {iniciales:[{currentValues}]}
        //      * vuelta 2;
        //      * sigue agregado objetos a la propiedad tipo['iniciales'] hasta que el $tipo cambie
        //      * del currentValue 
        //      * accumulator = {iniciales:[{currentValue}, {currentValue}]
        //      * vuelta 3 -> con tipo cambiado
        //      * accumulator = {
        //      *  iniciales:[{currentValue}{currentValue}],
        //      *  fundamentos : [{currentValue}]
        //      *  }
        //      * y asi hasta terminar
        //      * 
        //      * NOTA!! ES IMPORTANTE MENCIONAR QUE LOS CURSOS OBTENIDOS POR PUESTO DEBEN ESTAR
        //      * ORDENADOS POR TIPOS PARA AGILIZAR EL PROCESO
        //      */
        //     return $accumulator;
        // }, (object)[]);

    }
}
