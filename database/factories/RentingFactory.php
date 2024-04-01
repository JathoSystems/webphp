<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Renting>
 */
class RentingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateFrom = $this->faker->dateTimeBetween('-1 month', 'now');
        $dateTo = $this->faker->dateTimeBetween($dateFrom, '+5 days');

        if ($dateTo < $dateFrom) {
            $temp = $dateFrom;
            $dateFrom = $dateTo;
            $dateTo = $temp;
        }

        return [
            'user_id' => $this->faker->randomElement([1, 2, 3, 4, 5]), //-- Haal een random nummer op wat moet functioneren als ID van de Uer die gekoppeld is
            'ad_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];
    }
}
