<?php namespace Winter\Test\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Events Back-end Controller.
 *
 * Demonstrates the Backend\Behaviors\CalendarController behavior (calendar action) alongside
 * the usual List/Form controllers for CRUD, including server-side recurrence expansion wired
 * up in Winter\Test\Plugin::boot().
 */
class Events extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\CalendarController::class,
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $calendarConfig = 'config_calendar.yaml';

    public $requiredPermissions = ['winter.test.access_plugin'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Winter.Test', 'test', 'events');
    }
}
