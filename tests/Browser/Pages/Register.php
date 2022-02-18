<?php

namespace Tests\Browser\Pages;

use Faker\Factory as FakerFactory;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;
use Faker\Generator as Faker;
use \Symfony\Component\Console\Output\ConsoleOutput;


class Register extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    private $output;
    private $faker;

    public function url()
    {
        return '/register';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {

        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
    public function registerUser(Browser $browser){
        /* $name=$faker->firstName.' '.$faker->lastName; */
        $faker = FakerFactory::create();
        $name=$faker->name;
        $name_pass = explode(" ", $name);
        $browser->type('#name',$name)
                ->type('#email',$faker->email())
                ->type('#password',$name_pass[0].'.123')
                ->type('#password_confirmation',$name_pass[0].'.123')
                ->click('div > div > div.w-full.sm\:max-w-md.mt-6.px-6.py-4.bg-white.shadow-md.overflow-hidden.sm\:rounded-lg > form > div.flex.items-center.justify-end.mt-4 > button')
                /* ->press('Register') */
                ->waitForLocation('/dashboard',10);
    }
}
