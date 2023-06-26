<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trabajo>
 */
class TrabajoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // ["nombre", "estado", "puesto_id"];
        $estado = fake()->boolean;
        return [
            'nombre' => fake()->firstName,
            'estado' => $estado,
            'puesto_id' => fake()->lastName,
        ];
    }
}
