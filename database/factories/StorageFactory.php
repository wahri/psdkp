<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StorageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ruang' => $this->faker->buildingNumber(),
            'locker' => $this->faker->buildingNumber(),
            'rak' => $this->faker->buildingNumber(),
            'box' => $this->faker->buildingNumber()
        ];
    }
}
