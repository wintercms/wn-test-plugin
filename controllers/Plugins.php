<?php namespace Winter\Test\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Winter\Test\Models\Meta;

/**
 * Plugins Back-end Controller
 */
class Plugins extends Controller
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

        BackendMenu::setContext('Winter.Test', 'test', 'reviews');
    }

    public function formExtendFields($form)
    {
        $config = $this->makeConfig('$/winter/test/models/meta/fields.yaml');

        foreach ($config->fields as $field => $options) {
            $form->addTabFields([
                'meta['.$field.']' => $options + ['tab' => 'Meta']
            ]);
        }
    }

    public function formExtendModel($model)
    {
        if (!$model->meta) {
            $model->meta = new Meta;
        }

        return $model;
    }
}
