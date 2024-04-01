<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class companiesTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testViewCompanyOverview(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Companies')
                    ->visit('/company')
                    ->assertSee('Companies');
        });
    }

    public function testViewCompanyOverviewDetails(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'buyer@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Companies')
                    ->visit('/company')
                    ->assertSee('Companies');
        });
    }
}
