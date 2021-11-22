<?php namespace Winter\Test\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Cities Back-end Controller
 */
class Cities extends Controller
{
    use \Backend\Traits\InspectableContainer;

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Winter.Test', 'test', 'cities');
    }

    public function onGetInspectorConfiguration()
    {
        return [
            'configuration' => [
                'properties' => [
                    [
                        'property' => 'linkedCities',
                        'title' => 'Surrounding cities',
                        'type' => 'set',
                    ]
                ],
                'title' => 'City information',
                'description' => 'Describe this city with more additional information.',
            ],
        ];
    }
}
