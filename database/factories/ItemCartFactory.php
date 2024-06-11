<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemCart>
 */
class ItemCartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => 1,
            'user_id' => 1,
            'quantity' => fake()->numberBetween(1,5),
            'price_unit' => fake()->numberBetween(1,100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
