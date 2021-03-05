<?php namespace Winter\Test\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Trees Back-end Controller
 */
class Trees extends Controller
{
    public $implement = [
        'Backend.Behaviors.ListController'
    ];

    public $listConfig = [
        'members' => 'config_members_list.yaml',
        'categories' => 'config_categories_list.yaml',
        'channels' => 'config_channels_list.yaml'
    ];

    public $requiredPermissions = ['winter.test.access_plugin'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Winter.Test', 'test', 'trees');
    }
}
