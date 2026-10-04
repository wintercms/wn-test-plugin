<?php namespace Winter\Test\Tests\Browser;

use Laravel\Dusk\Browser;
use Winter\Dusk\Classes\BrowserTestCase;
use Winter\Dusk\Elements\Components\ListWidget;
use Winter\Test\Tests\Pages\People;

class PeopleListTest extends BrowserTestCase
{
    /**
     * Tests the People index page.
     *
     * @return void
     */
    public function testListPage()
    {
        $this->browse(function (Browser $browser) {
            $listWidget = new ListWidget;

            // Load page
            $browser
                ->login()
                ->visit(new People)
                ->pause(800)
                ->screenshot('1-People-List-1-Initial')
                ->assertPresent($listWidget);

            // Check that we have rows
            $listWidget->assertCount($browser, 6);
        });
    }

    /**
     * Tests some List widget elements
     *
     * @return void
     */
    public function testListTableElements()
    {
        $this->browse(function (Browser $browser) {
            $listWidget = new ListWidget;

            $browser
                ->login()
                ->visit(new People);

            $browser->within($listWidget, function ($browser) {
                // Hover over a list item
                $browser
                    ->mouseover('@data > tbody > tr:first-child > td')
                    ->screenshot('1-People-List-2-Hover-List-Item');
            });

            // Hover over a default-styled button
            $browser
                ->mouseover('.control-toolbar > .toolbar-primary a.btn.btn-default.oc-icon-check')
                ->screenshot('1-People-List-3-Hover-Button');
        });
    }

    /**
     * Tests the search functionality of the List widget.
     *
     * @return void
     */
    public function testListTableSearch()
    {
        $this->browse(function (Browser $browser) {
            $listWidget = new ListWidget;

            $browser
                ->login()
                ->visit(new People);

            // Click and enter search
            $browser
                ->type('.form-control.search', 'John Doe')
                ->pause(800) // Wait for AJAX query to complete
                ->screenshot('1-People-List-4-Enter-Search-Query')
                ->assertDontSeeIn('table.table.data', 'Mary Smith');
            $listWidget->assertCount($browser, 2);

            // Clear search
            $browser
                ->click('button.clear-input-text')
                ->pause(800) // Wait for AJAX query to complete
                ->screenshot('1-People-List-5-Clear-Search-Query')
                ->assertSeeIn('table.table.data', 'Mary Smith');
            $listWidget->assertCount($browser, 6);
        });
    }

    /**
     * Tests the Setup modal window for the List widget.
     *
     * @return void
     */
    public function testListTableSetup()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->login()
                ->visit(new People);

            // Click list settings modal and change column settings
            $browser
                ->click('table.table.data th.list-setup a')
                ->waitFor('.control-popup.modal', 1)
                ->pause(500) // Wait for modal window to show
                ->screenshot('1-People-List-6-Show-List-Setup')
                ->click('.control-popup.modal .control-simplelist > ul > li:nth-child(1) > div.checkbox > label')
                ->assertNotChecked('#Lists-setupCheckbox-id')
                ->drag(
                    '.control-popup.modal .control-simplelist > ul > li:nth-child(8) > div.checkbox > label',
                    '.control-popup.modal .control-simplelist > ul > li:nth-child(2) > div.checkbox > label'
                )
                ->screenshot('1-People-List-7-Change-List-Setup');

            // Apply changes and review table
            $browser
                ->click('.control-popup.modal .modal-footer button.btn.btn-primary')
                ->pause(500)
                ->screenshot('1-People-List-8-Apply-List-Setup')
                ->assertMissing('.control-popup.modal')
                ->assertDontSeeIn('table.table.data thead', 'ID')
                ->assertSeeIn('table.table.data thead tr:first-child th:first-child a', 'BIRTH TIME');
        });
    }
}
