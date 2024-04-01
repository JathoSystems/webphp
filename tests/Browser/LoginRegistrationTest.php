<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;


class LoginRegistrationTest extends DuskTestCase
{
    
    /**
     * A basic browser test example.
     */

    public function testRegistrationZakelijk(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/account/register')
                    ->assertSee('Register')
                    ->type('name', 'DUSK test')
                    ->type('email', 'test1@dusk.com')
                    ->type('password', '!Ab12345')
                    ->type('password_confirmation', '!Ab12345')
                    ->select('role', 'zakelijk')
                    ->press('Register')
                    ->assertSee('Company setup');
        });
    }

    public function testRegistrationParticulier(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/account/register')
                    ->assertSee('Register')
                    ->type('name', 'DUSK test')
                    ->type('email', 'test2@dusk.com')
                    ->type('password', '!Ab12345')
                    ->type('password_confirmation', '!Ab12345')
                    ->select('role', 'particulier')
                    ->press('Register')
                    ->assertSee('Welcome');
        });
    }

    public function testRegistrationDefault(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/account/register')
                    ->assertSee('Register')
                    ->type('name', 'DUSK test')
                    ->type('email', 'test3@dusk.com')
                    ->type('password', '!Ab12345')
                    ->type('password_confirmation', '!Ab12345')
                    ->select('role', 'user')
                    ->press('Register')
                    ->assertSee('Welcome');
        });
    }
}
