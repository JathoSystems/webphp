<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bedrijf>
 */
class BedrijfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'user_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'logo_url' => "N/A",
            'color_scheme' => '#ff0000',
            'landing_page_url' => "index",
        ];
    }
}
