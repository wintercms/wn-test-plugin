<?php namespace Winter\Test\Controllers;

use Backend;
use Response;
use BackendMenu;
use Backend\Classes\Controller;

/**
 * Countries Back-end Controller
 */
class Countries extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['winter.test.access_plugin'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Winter.Test', 'test', 'countries');

        $this->addJs('/modules/system/assets/js/framework.extras.js');
        $this->addJs('/modules/system/assets/css/framework.extras.css');
    }

    public function onRedirectCurrentHashed()
    {
        return redirect()->to(url()->current() . '#test');
    }

    public function onRedirectDownload()
    {
        sleep(3);
        return Backend::redirect('winter/test/countries/download');
    }

    public function onRedirect()
    {
        return Backend::redirect('winter/test/countries/preview/1');
    }

    public function preview()
    {
        sleep(3);
        return $this->asExtension('FormController')->preview(...func_get_args());
    }

    public function download()
    {
        sleep(3);
        return Response::download(base_path('modules/backend/assets/images/logo.svg'), 'logo.svg', [
            'Content-Type' => 'image/svg',
        ]);
    }
}
