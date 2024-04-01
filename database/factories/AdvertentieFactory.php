<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertentie>
 */
class AdvertentieFactory extends Factory
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
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+5 days'),
            'status' => "beschikbaar",
            'QR_code' => "N/A",
            'type' =>  $this->faker->randomElement(['advertentie', 'verhuur_advertentie']),
        ];
    }
}
