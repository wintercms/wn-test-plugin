<?php namespace Winter\Test\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Channels Back-end Controller
 */
class Channels extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ReorderController'
    ];

    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = ['winter.test.access_plugin'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Winter.Test', 'test', 'trees');
    }
}
