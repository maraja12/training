<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'weight' => fake()->numberBetween(0, 100),
            'storage' => fake()->numberBetween(1, 20),
            'usage' => fake()->randomElement(['legs', 'shoulders', 'back', 'abs', 'gluteus'])
        ];
    }
}
