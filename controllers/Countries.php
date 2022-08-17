<?php namespace Winter\Test\Controllers;

use Backend;
use Request;
use Response;
use BackendMenu;
use Backend\Classes\Controller;

/**
 * Countries Back-end Controller
 */
class Countries extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

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

    public function formExtendFields($form)
    {
        // Test dynamically added fields that have AJAX handlers
        // Requires data-request-parent functionality
        if (!$form->isNested && $form->model instanceof \Winter\Test\Models\Country) {
            $isActive = false;
            if (Request::ajax()) {
                $isActive = input('Country[is_active]', false);
            } elseif ($form->model->exists) {
                $isActive = $form->model->is_active;
            }

            if ($isActive) {
                $form->addFields([
                    'dynamic_flags' => [
                        'label' => 'Active Flags (Dynamic Fileupload Field)',
                        'type' => 'fileupload',
                        'mode' => 'image',
                        'span' => 'right',
                    ],
                ]);
            }
        }
    }
}
