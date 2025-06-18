<?php namespace Winter\Test\Controllers;

use Backend\Classes\Controller;

/**
 * Pages Back-end Controller
 */
class Pages extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    public $formLayout = 'fancy';

    public $requiredPermissions = ['winter.test.access_plugin'];
}
