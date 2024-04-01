<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $advertiseOrAdvertId = $this->faker->randomElement(['advertentie_id', 'advertiser_id']);

        return [
            'user_id' => $this->faker->randomElement([1, 2, 3, 4, 5]), //-- Haal een random nummer op wat moet functioneren als ID van de Uer die gekoppeld is
            $advertiseOrAdvertId => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'remarks' => $this->faker->sentence(),
        ];
    }
}
