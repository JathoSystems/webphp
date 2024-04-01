<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class rentingTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testViewRentingsOverview(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Rentings')
                    ->visit('/renting')
                    ->assertSee('Your personal rented articles');
        });
    }

    public function testViewRentingsPersonalOverview(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Rentings')
                    ->visit('/renting')
                    ->assertSee('Your personal rented articles')
                    ->assertSee('Rented advertisements')
                    ->clickLink(__('Rented advertisements'))
                    ->assertSee('Your rented articles');
        });
    }

    public function testViewRentingsPersonalOverviewToggle(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Rentings')
                    ->visit('/renting')
                    ->assertSee('Your personal rented articles')
                    ->assertSee('Rented advertisements')
                    ->clickLink(__('Rented advertisements'))
                    ->assertSee('Your rented articles')
                    ->assertSee('My personal rentals')
                    ->clickLink(__('My personal rentals'))
                    ->assertSee('Your personal rented articles');
        });
    }
}
