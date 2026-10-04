<?php namespace Winter\Test\Tests\Pages;

use Laravel\Dusk\Browser;
use Winter\Dusk\Classes\BackendPage;

class People extends BackendPage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/backend/winter/test/people';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser
            ->assertTitleContains('Manage Peoples |')
            ->assertPresent('@mainMenu')
            ->assertPresent('@accountMenu')
            ->assertPresent('@sideNav')
            ->assertHasClass('@sideNav li:nth-child(1)', 'active');
    }
}
