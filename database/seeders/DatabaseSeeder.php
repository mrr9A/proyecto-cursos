<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\Cursosinternos\CursosController;
use App\Models\ModalidadCurso;
use App\Models\PlanesFormacion;
use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\TipoCurso;
use App\Models\Trabajo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        DB::beginTransaction();

        try {
            // Planes de formación
            $consultorExperiencia = PlanesFormacion::create([
                'area' => 'consultor de experiencia',
                'estado' => 1
            ]);

            $volksWagenPostVenta = PlanesFormacion::create([
                'tema' => 'volkswagen',
                'area' => 'post venta',
                'estado' => 1
            ]);

            $vehiculosComercialesVentas = PlanesFormacion::create([
                'tema' => 'vehículos comerciales',
                'area' => 'ventas',
                'estado' => 1
            ]);

            $ventas = PlanesFormacion::create([
                'area' => 'ventas',
                'estado' => 1
            ]);

            $tecnica = PlanesFormacion::create([
                'area' => 'tecnica',
                'estado' => 1
            ]);

            // Puestos y trabajos
            $puestos = [
                ['puesto' => 'consultor de experiencia', 'estado' => 1, 'plan_formacion_id' => $consultorExperiencia->id_plan_formacion],
                ['puesto' => 'gerente de servicio', 'estado' => 1, 'plan_formacion_id' => $volksWagenPostVenta->id_plan_formacion],
                ['puesto' => 'jefe de taller', 'estado' => 1, 'plan_formacion_id' => $volksWagenPostVenta->id_plan_formacion],
                ['puesto' => 'asesor de servicio', 'estado' => 1, 'plan_formacion_id' => $volksWagenPostVenta->id_plan_formacion],
                ['puesto' => 'asesor de carroceria y pintura', 'estado' => 1, 'plan_formacion_id' => $volksWagenPostVenta->id_plan_formacion],
                ['puesto' => 'gerente de refacciones', 'estado' => 1, 'plan_formacion_id' => $volksWagenPostVenta->id_plan_formacion],
                ['puesto' => 'almacenista y vendedor de refacciones', 'estado' => 1, 'plan_formacion_id' => $volksWagenPostVenta->id_plan_formacion],
                ['puesto' => 'administrador de garantías', 'estado' => 1, 'plan_formacion_id' => $volksWagenPostVenta->id_plan_formacion],

                ['puesto' => 'ejecutivo de ventas', 'estado' => 1, 'plan_formacion_id' => $ventas->id_plan_formacion],
                ['puesto' => 'gerente de ventas', 'estado' => 1, 'plan_formacion_id' => $ventas->id_plan_formacion],
                ['puesto' => 'ejecutivo de autos usados certificados', 'estado' => 1, 'plan_formacion_id' => $ventas->id_plan_formacion],
                ['puesto' => 'gerente de autos usados certificados', 'estado' => 1, 'plan_formacion_id' => $ventas->id_plan_formacion],
                // TECNICOS
                ['puesto' => 'Master Technician', 'estado' => 1, 'plan_formacion_id' => $tecnica->id_plan_formacion],
                ['puesto' => 'Tecnico Mecanico', 'estado' => 1, 'plan_formacion_id' => $tecnica->id_plan_formacion],
                ['puesto' => 'Ayudante Tecnico', 'estado' => 1, 'plan_formacion_id' => $tecnica->id_plan_formacion],
                ['puesto' => 'Tecnico Express', 'estado' => 1, 'plan_formacion_id' => $tecnica->id_plan_formacion],
                ['puesto' => 'Tecnico Preparador de autos nuevos', 'estado' => 1, 'plan_formacion_id' => $tecnica->id_plan_formacion],
                ['puesto' => 'controlista de calidad', 'estado' => 1, 'plan_formacion_id' => $tecnica->id_plan_formacion],
            ];

            foreach ($puestos as $puestoData) {
                $puesto = Puesto::create([
                    'puesto' => $puestoData['puesto'],
                    'estado' => $puestoData['estado'],
                    'plan_formacion_id' => $puestoData['plan_formacion_id']
                ]);

                $trabajoPrincipal = new Trabajo([
                    'nombre' => $puestoData['puesto'],
                    'estado' => 1,
                    'puesto_id' => $puesto->id_puesto
                ]);

                $puesto->trabajos()->save($trabajoPrincipal);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            // Manejar el error como desees
        }
        // Fin puesto trabajos

        // MODALIDADES
        // Inserción 1
        $online = ModalidadCurso::insertGetId([
            'modalidad' => 'online',
            'estado' => 1
        ]);

        // Inserción 2
        $aulaVirtual = ModalidadCurso::insertGetId([
            'modalidad' => 'aula virtual',
            'estado' => 1
        ]);

        // Inserción 3
        $presencial = ModalidadCurso::insertGetId([
            'modalidad' => 'presencial',
            'estado' => 1
        ]);

        // FIN DE MODALIDADEs


        // TIPO DE CURSOS
        // Inserción 1
        $iniciales = TipoCurso::insertGetId([
            'nombre' => 'iniciales',
            'duracion' => '0-3',
            'estado' => 1
        ]);

        // Inserción 2
        $fundamentos = TipoCurso::insertGetId([
            'nombre' => 'fundamentos',
            'duracion' => '3-6',
            'estado' => 1
        ]);

        // Inserción 3
        $especialidad = TipoCurso::insertGetId([
            'nombre' => 'especialidad',
            'duracion' => '6-12',
            'estado' => 1
        ]);

        // Inserción 4
        $complementarios = TipoCurso::insertGetId([
            'nombre' => 'complementarios',
            'estado' => 1
        ]);
        $expertovc = TipoCurso::insertGetId([
            'nombre' => 'experto vc',
            'estado' => 1
        ]);

        // Inserción 5
        $basico = TipoCurso::insertGetId([
            'nombre' => 'basico',
            'estado' => 1
        ]);

        // Inserción 6
        $avanzado = TipoCurso::insertGetId([
            'nombre' => 'avanzado',
            'estado' => 1
        ]);

        // Inserción 7
        $experto = TipoCurso::insertGetId([
            'nombre' => 'experto',
            'estado' => 1
        ]);

        $data = [
            'online' => $online,
            'aulaVirtual' => $aulaVirtual,
            'presencial' => $presencial,

            'iniciales' => $iniciales,
            'fundamentos' => $fundamentos,
            'especialidad' => $especialidad,
            'complementarios' => $complementarios,
            'expertovc' => $expertovc,

            'basico' => $basico,
            'avanzado' => $avanzado,
            'experto' => $experto,5
        ];


        $trabajos = [];
        foreach ($puestos as $puesto) {
            $idTrabajo = Trabajo::where('nombre', $puesto["puesto"])->pluck('id_trabajo')->first();
            $trabajos[$puesto['puesto']] = $idTrabajo;
        }
        //puestos
        $consultorExperiencia = $trabajos['consultor de experiencia'];
        $gerenteServicios = $trabajos['gerente de servicio'];
        $jefeTaller = $trabajos['jefe de taller'];
        $asesorServicio = $trabajos['asesor de servicio'];
        $asesorCarroceriaPintura = $trabajos['asesor de carroceria y pintura'];
        $gerenteRefacciones = $trabajos['gerente de refacciones'];
        $almacenistaVendedorRefacciones = $trabajos['almacenista y vendedor de refacciones'];
        $administradorGarantias = $trabajos['administrador de garantías'];
        $ejecutivoVentas = $trabajos['ejecutivo de ventas'];
        $gerenteVentas = $trabajos['gerente de ventas'];
        $ejecutivoAutosUsados = $trabajos['ejecutivo de autos usados certificados'];
        $gerenteAutosUsados = $trabajos['gerente de autos usados certificados'];
        $trabajos['Master Technician'];
        $trabajos['Tecnico Mecanico'];
        $trabajos['Ayudante Tecnico'];
        $trabajos['Tecnico Express'];
        $trabajos['Tecnico Preparador de autos nuevos'];
        $trabajos['controlista de calidad'];


        // // FIN TIPO DE CURSOS
        CursosGerenteVentasSeeder::run($data, $gerenteVentas);
        CursosEjecutivoDeVentasSeeder::run($data, $ejecutivoVentas);
        CursosConsultorExperienciasSeeder::run($data, $consultorExperiencia);
        CursosGerenteAutosUsadosCertificadosSeeder::run($data, $gerenteAutosUsados);
        CursosEjecutivoAutosUsadosCertificadosSeeder::run($data, $ejecutivoAutosUsados);


        $cursosNoCodigo = [
            // iniciales consultor de experiencia
            ["nombre" => "Autoestudios de productos volkswagen", "estado" => 1, "modalidad_id" => 1, "tipo_curso_id" => 1],
            // fundamentos consultor de experiencia
            // codigos -> v-201/v-205 /v-227
            ["nombre" => "introducción al customer journey de post venta", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 2],
            // codigos -> v-202 / v-203 / v-204
            ["nombre" => "calidad e indicadores en la post venta", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 2],
            // especialidad consultor de experiencia
            // codigos - v-206 / v-207
            ["nombre" => "marketing de post venta", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 3],
            // codigos - v-305 / v-306
            ["nombre" => "liderazgo y capital humano", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 3],



            // basicos 
            ["nombre" => "bq seguridad live broadcast", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 5],
            ["nombre" => "bq mantenimiento y experiencia con el cliente live broadcast", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 5],
            ["nombre" => "bq intervalos de servicio live broadcast", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 5],
            ["nombre" => "bq bloque 2 live broadcast", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 5],
            ["nombre" => "bq bloque 3 live broadcast", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 5],
            ["nombre" => "bq tecnico hvt", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 5],
            ["nombre" => "aq mecanica de motor", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 6],
            ["nombre" => "aq cambios manuales", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 6],
            ["nombre" => "aq tren de rodaje", "estado" => 1, "modalidad_id" => 2, "tipo_curso_id" => 6],
        ];

        // DB::table('cursos')->insertOrIgnore($cursosCodigo);
        // DB::table('cursos')->insertOrIgnore($cursosNoCodigo);

        // SUCURSALES
        // ["nombre", "ciudad", "estado"];
        Sucursal::create([
            "nombre" => "Kia",
            "ciudad" => "Oaxaca de juarez",
            "estado" => 1
        ]);
        Sucursal::create([
            "nombre" => "volkswagen",
            "ciudad" => "Oaxaca de juarez",
            "estado" => 1
        ]);
        // FIND DE LA CREACION DE SUCRUSALES

        \App\Models\User::factory(100)->create();

        // ADMIN
        User::create([
            'nombre' => "luis",
            'segundo_nombre' => 'anberto',
            'apellido_paterno' => 'mendoza',
            'apellido_materno' => 'vasquez',
            'id_sgp' => 1,
            'id_sumtotal' => 1,
            'rol' => 0,
            'email' => 'ann@gmail.com',
            'password' => Hash::make('password123'), // Cambia 'password123' por el valor deseado
            'estado' => 1,
            'puesto_id' => 1,
        ]);
    }
}
