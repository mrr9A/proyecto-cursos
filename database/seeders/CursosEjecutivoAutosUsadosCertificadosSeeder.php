<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosEjecutivoAutosUsadosCertificadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run($data, $id): void
    {
        //
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
            ['codigo' => 'w-33', 'nombre' => 'procesos de ventas volkswagen', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-91', 'nombre' => 'procesos de ventas autos usados', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-021','nombre' => 'long drive', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => '0-01', 'nombre' => 'trabajo en equipo', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-34', 'nombre' => 'proceso de ventas digital(online booking)', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-31', 'nombre' => 'salesforce ventas', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],
            ['codigo' => 'w-16', 'nombre' => 'gestión de reclamaciones ventas', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $iniciales],

            // fundamentos
            ['codigo' => 'vpb004b.0', 'nombre' => 'bienvenida vw y argumentación en tecnologia', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $fundamentos],

            // Especialidad
            ['codigo' => 'w-38', 'nombre' => 'habilidades de venta', 'estado' => 1, 'modalidad_id' => 1, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'd-101', 'nombre' => 'aplic. proceso de ventas volkswagen', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'd-104', 'nombre' => 'potenciando mis habilidades de venta', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-35', 'nombre' => 'el reto del contacto digital', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-36', 'nombre' => 'negociación eficaz el éxito en las ventas', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'd-102', 'nombre' => '¿cómo hacer un contacto digital efectivo?', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'd-103', 'nombre' => '¿cómo hacer más eficiente tus negociaciones?', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'D-45', 'nombre' => 'el viaje del cliente hacia un vw', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-37', 'nombre' => 'entrega del auto y fidelización del cliente', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'w-93', 'nombre' => 'toma de auto usado', 'estado' => 1, 'modalidad_id' => $online, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'd-120', 'nombre' => 'toma de auto usado', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'd-121', 'nombre' => 'garantia de auto usado', 'estado' => 1, 'modalidad_id' => $aulaVirtual, 'tipo_curso_id' => $especialidad],

            ['codigo' => 'd-001', 'nombre' => 'generando impacto en el cliente', 'estado' => 1, 'modalidad_id' => $presencial, 'tipo_curso_id' => $especialidad],
            ['codigo' => 'd-002', 'nombre' => 'presuasión y cierre de ventas estratégicas', 'estado' => 1, 'modalidad_id' => $presencial, 'tipo_curso_id' => $especialidad],

            // certificacion
            ['codigo' => 'd-41', 'nombre' => 'certificacion', 'estado' => 1, 'modalidad_id' => $presencial, 'tipo_curso_id' => $especialidad],            
        ];

        $cursosNoCodigo=[
            // iniciales
            ["nombre" => "Autoestudios de productos volkswagen", "estado" => 1, "modalidad_id" => $online, "tipo_curso_id" => $iniciales],
            // fundamentos
            ["nombre" => "bienvenida carroceria motor", "estado" => 1, "modalidad_id" => $aulaVirtual, "tipo_curso_id" => $fundamentos],
            ["nombre" => "dirección transmisión", "estado" => 1, "modalidad_id" => $aulaVirtual, "tipo_curso_id" => $fundamentos],
            ["nombre" => "suspención tren de rodaje seguridad", "estado" => 1, "modalidad_id" => $aulaVirtual, "tipo_curso_id" => $fundamentos],
            ["nombre" => "infotainment innovaciones", "estado" => 1, "modalidad_id" => $aulaVirtual, "tipo_curso_id" => $fundamentos],
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
