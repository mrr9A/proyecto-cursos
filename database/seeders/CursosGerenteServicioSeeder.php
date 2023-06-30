<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosGerenteServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function  run($data, $id): void
    {
        //
        $online = $data['online'];
        $aulaVirtual = $data['aulaVirtual'];
        $presencial = $data['presencial'];
        $iniciales = $data['iniciales'];
        $fundamentos = $data['fundamentos'];
        $especialidad = $data['especialidad'];
        $expertovc = $data['expertovc'];
        $trabajoID = $id;

        $cursosCodigo = [
            // Iniciales
            ['codigo' => 'w-01', 'nombre' => 'introducción a volkswagen', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => '0-01', 'nombre' => 'trabajo en equipo', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-06', 'nombre' => 'éxito en la comunicacion', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-07', 'nombre' => 'oferta comercial post venta', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-61', 'nombre' => 'gestión de reclamaciones', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => '0-60', 'nombre' => 'procesos de servicio vw', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => '0-61', 'nombre' => 'derechos y obligaciones en la prestación de servicios', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-83', 'nombre' => 'apos/averias', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-67', 'nombre' => 'saga/2', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-60', 'nombre' => 'tablas de mantenimiento', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => '0-03', 'nombre' => 'garantías y cortesías', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-90', 'nombre' => 'reporting de garantías', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-89', 'nombre' => 'proceso de refacciones (manual)', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-02', 'nombre' => 'long drive', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-68', 'nombre' => 'sistemas de post venta', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-12', 'nombre' => 'campañas', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-62', 'nombre' => 'diss', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-701', 'nombre' => 'detección y prospección de clientes comerciales', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-702', 'nombre' => 'elementos de una oferta para clientes comerciales', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            
            

            
            // fundamentos
            ['codigo' => 'vpb004b.0', 'nombre' => 'bienvenida vw y argumentación en tecnologia', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $fundamentos],
            ['codigo' => 'v-010', 'nombre' => 'basico post venta', 'estado' => 1, 'modalidad_id' => $presencial, 'tipo_curso_id' => $fundamentos],

            // Especialidad
            ['codigo' => 'w-63', 'nombre' => 'marketing digital post venta', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-87', 'nombre' => 'mejores práticas gestión de leads', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-09', 'nombre' => 'liderazgo y desarrollo de equipos', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => '0-63', 'nombre' => 'contabilidad en el concensionario', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            
            ['codigo' => 'w-10', 'nombre' => 'capital humano y i reclutamiento y selección', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-11', 'nombre' => 'capital humano y ii entrevista con los empleados', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'v-109', 'nombre' => 'estrategias de marketing e inventario', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'v-210', 'nombre' => 'misión 100', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-44', 'nombre' => 'herramientas de gestión', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'v-115', 'nombre' => 'uso de herramientas de gestión', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-94', 'nombre' => 'costos de la no calidad', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'v-230', 'nombre' => 'seguimiento de costos de la no calidad', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'nuevo', 'nombre' => 'herramientas de solución de problemas', 'estado' => 1, 'modalidad_id' => $presencial, 'tipo_curso_id' => $especialidad],
        

            ['codigo' => 'd-001', 'nombre' => 'generando impacto en el cliente', 'estado' => 1, 'modalidad_id' => $presencial, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'd-002', 'nombre' => 'presuasión y cierre de ventas estratégicas', 'estado' => 1, 'modalidad_id' => $presencial, 'tipo_curso_id' => $especialidad],

            // certificacion
            ['codigo' => 'd-41', 'nombre' => 'certificacion', 'estado' => 1, 'modalidad_id' => $presencial, 'tipo_curso_id' => $especialidad],            
        ];
        
        $cursosNoCodigo=[
            // iniciales
            ['codigo' => 'w-89', 'nombre' => 'proceso de refacciones (video)', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            // fundamentos
            // codigos -> v-201/v-205 /v-227
            ["nombre" => "introducción al customer journey de post venta", "estado" => 1, "modalidad_id" => $aulaVirtual, "tipo_curso_id" => $fundamentos],
            // codigos -> v-202 / v-203 / v-204
            ["nombre" => "calidad e indicadores en la post venta", "estado" => 1, "modalidad_id" => $aulaVirtual, "tipo_curso_id" => $fundamentos],
            // w-10 w-11
            ['nombre' => 'gestión de capital humano', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
        ];


        DB::table('cursos')->insertOrIgnore($cursosCodigo);
        DB::table('cursos')->insertOrIgnore($cursosNoCodigo);


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
