<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class bidsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testViewBidsOverview(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Bids')
                    ->visit('/bidding')
                    ->assertSee('Your bids');
        });
    }

    public function testViewBidsPersonalOverview(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Bids')
                    ->visit('/bidding')
                    ->assertSee('Your bids')
                    ->assertSee('Bids on your products')
                    ->clickLink(__('Bids on your products'))
                    ->assertSee('Bids on your products');
        });
    }

    public function testViewBidsPersonalOverviewToggle(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Bids')
                    ->visit('/bidding')
                    ->assertSee('Your bids')
                    ->assertSee('Bids on your products')
                    ->clickLink(__('Bids on your products'))
                    ->assertSee('Bids on your products')
                    ->assertSee('My personal bids')
                    ->clickLink(__('My personal bids'))
                    ->assertSee('Your bids');
        });
    }
}
