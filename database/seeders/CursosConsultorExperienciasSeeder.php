<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosConsultorExperienciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run($data, $id): void
    {

        $online = $data['online'];
        $aulaVirtual = $data['aulaVirtual'];
        $presencial = $data['presencial'];
        $iniciales = $data['iniciales'];
        $fundamentos = $data['fundamentos'];
        $especialidad = $data['especialidad'];
        $trabajoID = $id;
        //
        $cursosCodigo = [
            // Iniciales consultor de experiencia
            ['codigo' => 'w-01', 'nombre' => 'introducción a volkswagen', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-33', 'nombre' => 'procesos de ventas volkswagen', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-021', 'nombre' => 'long drive', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => '0-01', 'nombre' => 'trabajo en equipo', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-34', 'nombre' => 'proceso de ventas digital(online booking)', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-12', 'nombre' => 'campañas', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-31', 'nombre' => 'salesforce ventas', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-61', 'nombre' => 'gestión de reclamaciones post venta', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-07', 'nombre' => 'oferta comercial post venta', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => '0-61', 'nombre' => 'derechos y obligaciones en la prestacion de servicios', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-89', 'nombre' => 'procesos de refacciones', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => '0-60', 'nombre' => 'procesos de servicio', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            // fundamentos consultor de experiencia
            ['codigo' => 'vpb004b.0', 'nombre' => 'bienvenida vw y argumentación en tecnologia', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $fundamentos],
            ['codigo' => 'w-41', 'nombre' => 'asegurar un contacto digital exitoso', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => 2],
            ['codigo' => 'w-42', 'nombre' => 'negociación gerentes', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $fundamentos],
            ['codigo' => 'w-37', 'nombre' => 'entrega del auto y fidelización del cliente', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $fundamentos],
            ['codigo' => 'v-010', 'nombre' => 'básico post venta', 'estado' => 1, 'modalidad_id' => $presencial, 'tipo_curso_id' => $fundamentos],
            // Especialidad consultor de experiencia
            ['codigo' => 'w-63', 'nombre' => 'marketing digital post venta', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-87', 'nombre' => 'mejores práticas gestión de leads', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'v-116', 'nombre' => 'salesforce ventas', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-09', 'nombre' => 'liderazgo y desarrollo de equipos', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-10', 'nombre' => 'capital humano y i reclutamiento y selección', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-11', 'nombre' => 'capital humano y ii entrevista con los empleados', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'v-109', 'nombre' => 'estrategias de marketing e inventario', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'v-210', 'nombre' => 'misión 100', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-44', 'nombre' => 'herramientas de gestión', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'v-115', 'nombre' => 'uso de herramientas de gestión', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-94', 'nombre' => 'costos de la no calidad', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'v-230', 'nombre' => 'seguimiento de costos de la no calidad', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'nuevo', 'nombre' => 'herramientas de solución de problemas', 'estado' => 1, 'modalidad_id' => $presencial, 'tipo_curso_id' => $especialidad],
        ];

        $cursosNoCodigo = [
            // iniciales consultor de experiencia
            ["nombre" => "Autoestudios de productos volkswagen", "estado" => 1, "modalidad_id" => $online, "tipo_curso_id" => $iniciales],
            // fundamentos consultor de experiencia
            // codigos -> v-201/v-205 /v-227
            ["nombre" => "introducción al customer journey de post venta", "estado" => 1, "modalidad_id" => $aulaVirtual, "tipo_curso_id" => $fundamentos],
            // codigos -> v-202 / v-203 / v-204
            ["nombre" => "calidad e indicadores en la post venta", "estado" => 1, "modalidad_id" => $aulaVirtual, "tipo_curso_id" => $fundamentos],
            // especialidad consultor de experiencia
            // codigos - v-206 / v-207
            ["nombre" => "marketing de post venta", "estado" => 1, "modalidad_id" => $aulaVirtual, "tipo_curso_id" => $especialidad],
            // codigos - v-305 / v-306
            ["nombre" => "liderazgo y capital humano", "estado" => 1, "modalidad_id" => $aulaVirtual, "tipo_curso_id" => $especialidad],
        ];


        DB::table('cursos')->insertOrIgnore($cursosCodigo);
        DB::table('cursos')->insertOrIgnore($cursosNoCodigo);

        $cursoSinCodigoIDs = DB::table('cursos')->whereIn('nombre', array_column($cursosNoCodigo, 'nombre'))->pluck('id_curso');
        $cursoConCodigoIDs = DB::table('cursos')->whereIn('codigo', array_column($cursosCodigo, 'codigo'))->pluck('id_curso');
        $cursosTrabajos = [];

        foreach ($cursoSinCodigoIDs as $cursoID) {
            $consulta = [
                'curso_id' => $cursoID,
                'trabajo_id' => $trabajoID,
            ];
            array_push($cursosTrabajos, $consulta);
        }
        foreach ($cursoConCodigoIDs as $cursoID) {
            $consulta = [
                'curso_id' => $cursoID,
                'trabajo_id' => $trabajoID,
            ];
            array_push($cursosTrabajos, $consulta);
        }

        DB::table('trabajos_cursos')->insertOrIgnore($cursosTrabajos);
    }
}
