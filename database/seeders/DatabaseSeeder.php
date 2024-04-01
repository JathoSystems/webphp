<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Advertentie;
use App\Models\Bidding;
use App\Models\Renting;
use App\Models\Review;
use App\Models\Bedrijf;
use App\Models\Contract;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Add roles
        \App\Models\Role::factory()->create([
            'name' => 'particulier',
            'description' => 'Particuliere adverteerder',
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'zakelijk',
            'description' => 'Zakelijke verkoper',
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'admin',
            'description' => 'Administrator',
        ]);

        //-- Random users
        User::factory(5)->create();

        //-- Advertentie
        Advertentie::factory(5)->create();

        //-- Bidding
        Bidding::factory(5)->create();

        //-- Renting
        Renting::factory(5)->create();

        //-- Review
        Review::factory(15)->create();

        //-- Bedrijven
        Bedrijf::factory(3)->create();

        //-- Contracten
        Contract::factory(5)->create();

         //-- Valid user
         \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@dev.com',
            'password' => Hash::make("!Ab12345"),
        ]);
    }
}
