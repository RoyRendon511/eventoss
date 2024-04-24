<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'descripcion' => $this->faker->text(70),
            'fecha_inicio' => $this->faker->date,
            'fecha_fin' => $this->faker->date,
            'ciudad_id' => $this->faker->numberBetween(1,6),
        ];
    }
}
