<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dish>
 */
class DishFactory extends Factory
{
    public array $category = ['fast food', 'cool drinks', 'health food', 'national food', 'desserts'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => implode(' ', $this->faker->words(5)), // Объединяем слова в строку
            'descriptions' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 2, 15),
            'category' => $this->category[rand(0, 4)],
            'restaurant_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
