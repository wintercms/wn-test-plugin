<?php namespace Winter\Test\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Vue Back-end Controller
 */
class Vue extends Controller
{

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Winter.Test', 'test', 'vue');
    }

    public function index() 
    {
    }
}
