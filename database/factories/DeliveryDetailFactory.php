<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryDetail>
 */
class DeliveryDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id'=>$this->faker->numberBetween(1,40),
            'delivery_address'=>$this->faker->address,
            'delivered_at'=>$this->faker->dateTime(now()),
        ];
    }
}
