<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class contractsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testViewContracts(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'admin@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Contracts')
                    ->visit('/contracts')
                    ->assertSee('Uploaded contracts');
        });
    }

    public function testAddContracts(): void
    {
        $this->browse(function (Browser $browser) {

            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');

            $browser->visit('/account/login')
                    ->assertSee('Login')
                    ->type('email', 'admin@dev.com')
                    ->type('password', '!Ab12345')
                    ->press('Login')
                    ->assertSee('Contracts')
                    ->visit('/contracts')
                    ->assertSee('Uploaded contracts')
                    ->assertSee('Add contract')
                    ->clickLink(__('Add contract'))
                    ->assertSee('Add contract')
                    ->press('Save')
                    ->assertSee('Uploaded contracts');
        });
    }
}
