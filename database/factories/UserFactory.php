<?php

namespace Database\Factories;

use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // empleado = 1, admin = 0
        $rol = $this->faker->randomElement([0, 1]);
        // $estado = $this->faker->boolean;
        $estado = 1;

        $puesto = Puesto::inRandomOrder()->first();
        $puestoId = $puesto->id_puesto;

        $attributes = [
            'nombre' => $this->faker->firstName,
            'segundo_nombre' => $this->faker->optional()->firstName,
            'apellido_paterno' => $this->faker->lastName,
            'apellido_materno' => $this->faker->optional()->lastName,
            'id_sgp' => $this->faker->unique()->randomNumber(),
            'id_sumtotal' => $this->faker->unique()->randomNumber(),
            'rol' => $rol,
            'email' => $this->faker->unique()->email,
            'password' => Hash::make('password123'), // Cambia 'password123' por el valor deseado
            'estado' => $estado,
            'fecha_alta_planta' => $this->faker->optional()->date(),
            'fecha_ingreso_puesto' => $this->faker->date(),
            'puesto_id' => $puestoId,
        ];
        // $attributes = [
        //     'nombre' => "luis",
        //     'segundo_nombre' => 'anberto',
        //     'apellido_paterno' => 'mendoza',
        //     'apellido_materno' => 'vasquez',
        //     'id_sgp' => 1,
        //     'id_sumtotal' => 1,
        //     'rol' => 0,
        //     'email' => 'ann@gmail.com',
        //     'password' => Hash::make('Password123'), // Cambia 'password123' por el valor deseado
        //     'estado' => 1,
        //     'puesto_id' => $puestoId,
        // ];

        return $attributes;
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            //$sucursales
            $sucursal = Sucursal::inRandomOrder()->first();
            $sucursalId = $sucursal->id_sucursal;

            DB::table('sucursales_usuarios')->insert(["usuario_id" => $user->id_usuario, "sucursal_id" => $sucursalId]);

            // Obtén el puesto del usuario
            $puesto = Puesto::find($user->puesto_id);

            // Crea los trabajos correspondientes al puesto
            $trabajos = $puesto->trabajos()->get();
            $trabajosData = [];
            foreach ($trabajos as $trabajo) {
                $trabajosData[] = [
                    'usuario_id' => $user->id_usuario,
                    'trabajo_id' => $trabajo->id_trabajo
                ];
            }

            // Inserta todos los trabajos en un solo insert
            DB::table('usuarios_trabajos')->insert($trabajosData);
        });
    }
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
