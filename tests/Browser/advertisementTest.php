<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class advertisementTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */

    public function testViewAdvertisements(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Advertisements')
                    ->visit('/advertenties')
                    ->assertSee('Advertisements');
        });
    }

    public function testViewAdvertisementsFavorites(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Advertisements')
                    ->visit('/advertenties')
                    ->assertSee('Advertisements')
                    ->assertSee('Show favorite')
                    ->clickLink(__('Show favorite advertisements'))
                    ->assertSee('Favorite adverisements');
        });
    }


    public function testViewAdvertisementsMarkFavorite(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Advertisements')
                    ->visit('/advertenties')
                    ->assertSee('Advertisements')
                    ->assertSee('Show favorite')
                    ->assertSee(__('Favorite'))
                    ->press(__('Favorite'));
                });
    }

    public function testViewAdvertisementsAddAdvertisement(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Advertisements')
                    ->visit('/advertenties')
                    ->assertSee('Advertisements')
                    ->assertSee('Add advertisement')
                    ->clickLink(__('Add advertisement'))
                    ->assertSee('Add advertisement')
                    //-- Form invoeren
                    ->select('type', 'advertentie')
                    ->type('title', 'Test artikel 1')
                    ->type('description', 'Test omschrijving artikel 1')
                    ->type('price', '20.30')
                    ->type('input[type="date"]', '2024-04-02')
                    ->press('Save');
                });
    }
}
