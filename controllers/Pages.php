<?php namespace Winter\Test\Controllers;

use BackendMenu;
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

    public $requiredPermissions = ['winter.test.access_plugin'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Winter.Test', 'test', 'pages');
    }

    public function index()
    {
        $this->asExtension('ListController')->index();

        $this->bodyClass = 'compact-container';
    }

    public function create()
    {
        $this->bodyClass = 'fancy-layout compact-container breadcrumb-flush';

        $this->asExtension('FormController')->create();
    }

    public function update($recordId)
    {
        $this->bodyClass = 'fancy-layout compact-container breadcrumb-flush';

        $this->asExtension('FormController')->update($recordId);
    }
}
