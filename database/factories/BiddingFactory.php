<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bidding>
 */
class BiddingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement([1, 2, 3, 4, 5]), //-- Haal een random nummer op wat moet functioneren als ID van de Uer die gekoppeld is
            'ad_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
