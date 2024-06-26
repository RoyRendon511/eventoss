<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CiudadesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'ciudades' => $this->faker->city,
        ];
    }
}
