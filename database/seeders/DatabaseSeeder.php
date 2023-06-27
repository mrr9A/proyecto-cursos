<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ModalidadCurso;
use App\Models\PlanesFormacion;
use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\TipoCurso;
use App\Models\Trabajo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                ['puesto' => 'tecnico preparador de autos nuevos', 'estado' => 1, 'plan_formacion_id' => $tecnica->id_plan_formacion],
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

        // SUCURSALES
        // ["nombre", "ciudad", "estado"];
        Sucursal::create([
            "nombre" => "Kia",
            "ciudad" => "Oaxaca de juarez",
            "estado" => 1
        ]);
        Sucursal::create([
            "nombre" => "Kia",
            "ciudad" => "Oaxaca de juarez",
            "estado" => 1
        ]);
        // FIND DE LA CREACION DE SUCRUSALES

        \App\Models\User::factory(1000)->create();


        // MODALIDADES
        // Inserción 1
        ModalidadCurso::create([
            'modalidad' => 'online',
            'estado' => 1
        ]);

        // Inserción 2
        ModalidadCurso::create([
            'modalidad' => 'aula virtual',
            'estado' => 1
        ]);

        // Inserción 3
        ModalidadCurso::create([
            'modalidad' => 'presencial',
            'estado' => 1
        ]);

        // FIN DE MODALIDADEs


        // TIPO DE CURSOS
        // Inserción 1
        TipoCurso::create([
            'nombre' => 'iniciales',
            'duracion' => '0-3',
            'estado' => 1
        ]);

        // Inserción 2
        TipoCurso::create([
            'nombre' => 'fundamentos',
            'duracion' => '3-6',
            'estado' => 1
        ]);

        // Inserción 3
        TipoCurso::create([
            'nombre' => 'especialidad',
            'duracion' => '6-12',
            'estado' => 1
        ]);

        // Inserción 4
        TipoCurso::create([
            'nombre' => 'complementarios',
            'estado' => 1
        ]);

        // Inserción 5
        TipoCurso::create([
            'nombre' => 'basico',
            'estado' => 1
        ]);

        // Inserción 6
        TipoCurso::create([
            'nombre' => 'avanzado',
            'estado' => 1
        ]);

        // Inserción 7
        TipoCurso::create([
            'nombre' => 'experto',
            'estado' => 1
        ]);

        // FIN TIPO DE CURSOS


    }
}
