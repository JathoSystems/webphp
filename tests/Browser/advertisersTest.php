<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class advertisersTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testViewAdvertisersOverview(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Advertisements')
                    ->visit('/advertisers')
                    ->assertSee('Private / Business');
        });
    }

    public function testViewAdvertisersDetails(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Advertisements')
                    ->visit('/advertisers')
                    ->assertSee('Private / Business')
                    ->assertSee('View')
                    ->click('.buttons button[type="submit"]')
                    ->assertSee('Place review');
        });
    }
}
