<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Register;
use Tests\Browser\Pages\Main;
use \Symfony\Component\Console\Output\ConsoleOutput;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $output = new ConsoleOutput();
        $register = new Register;
        $main = new Main;
        $output->writeln('Starting test');
        $this->browse(function (Browser $browser) use ($register,$main){
            $browser->visit('/')
                    ->pause(3000)
                    ->assertSee('Recycler Network')
                    ->on($main)
                    ->acceder('Register')
                    ->on($register)
                    ->registerUser();
        });
        $output->writeln('---------------------------------');
        $output->writeln('there were no errors in the test');
    }
}
