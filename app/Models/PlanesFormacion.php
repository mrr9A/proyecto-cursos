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


    public function puestos(){
        return $this->hasMany(Puesto::class, "plan_formacion_id");
    }



    public static function getMatrizVentas()
    {
        $usuarios = User::with(['puestos.cursos.tipo', 'calificaciones'])
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

        // dd($usuarios);
        $result = $usuarios->map(function ($usuario) {
            $cursos = $usuario->puestos()->get()->flatMap(function ($puesto) use ($usuario) {
                return $puesto->cursos->map(function ($curso) use ($usuario) {
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
            });

            $usuario->cursos = $cursos->groupBy('tipo')->toArray();
            $usuario->puesto = $usuario->puestos->puesto;
            // Se utiliza unset($usuario->puestos) para eliminar la relación puestos 
            // del resultado final. Esto evita que los datos innecesarios se incluyan en el resultado.
            unset($usuario->puestos);
            return $usuario;
        });

        // dd($result);
        return $result;
    }


    public static function getMatrizTecnica()
    {
        $usuarios = User::with([
            'puestos',
            'trabajos.cursos.tipo',
            'calificaciones'
        ])
            ->whereHas('puestos', function ($query) {
                $query->where('puesto', '!=', 'consultor de experiencia');
            })
            ->select(
                DB::raw("CONCAT(nombre, ' ', IFNULL(segundo_nombre, ''), ' ', apellido_paterno, ' ', apellido_materno) AS empleado"),
                'usuarios.*'
            )
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

                return [
                    'trabajo' => $trabajo->nombre,
                    'cursos' => $cursos
                ];
            });

            return (object) [
                'id_usuario' => $usuario->id_usuario,
                'nombre' => $usuario->empleado,
                'puesto' => $usuario->puestos->puesto,
                'id_puesto' => $usuario->puestos->id_puesto,
                'trabajos' => $trabajos,
            ];
        });
    }
}
