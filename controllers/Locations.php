<?php namespace Winter\Test\Controllers;

use Backend\Classes\Controller;

/**
 * Locations Back-end Controller
 */
class Locations extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];
}
