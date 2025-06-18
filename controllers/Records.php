<?php namespace Winter\Test\Controllers;

use Backend\Classes\Controller;

/**
 * Records Backend Controller
 */
class Records extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var string The form layout to use. One of standard, sidebar, fancy
     */
    public $formLayout = 'fancy';
}
