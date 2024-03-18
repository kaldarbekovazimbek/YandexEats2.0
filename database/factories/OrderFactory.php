<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>$this->faker->numberBetween(1,30),
            'restaurant_id'=>$this->faker->numberBetween(1,10),
            'status'=>'delivered',
            'total_price'=>100,
            'restaurant_worker_id'=>$this->faker->numberBetween(1,30)
        ];
    }
}
