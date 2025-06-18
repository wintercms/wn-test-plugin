<?php namespace Winter\Test\Controllers;

use Backend\Classes\Controller;

/**
 * Cities Back-end Controller
 */
class Cities extends Controller
{
    use \Backend\Traits\InspectableContainer;

    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    public function onGetInspectorConfiguration()
    {
        return [
            'configuration' => [
                'properties' => [
                    [
                        'property' => 'linkedCities',
                        'title' => 'Surrounding cities',
                        'type' => 'set',
                    ],
                    [
                        'property' => 'population',
                        'title' => 'Population',
                        'description' => 'This should be entered as a number',
                        'type' => 'string',
                        'placeholder' => 'Population amount',
                    ],
                    [
                        'property' => 'density',
                        'title' => 'Density',
                        'type' => 'dropdown',
                        'default' => 'medium',
                        'options' => [
                            'low' => 'Low',
                            'medium' => 'Medium',
                            'high' => 'High',
                        ],
                    ],
                    [
                        'property' => 'blurb',
                        'title' => 'Blurb',
                        'type' => 'text',
                        'placeholder' => 'Describe this city with a small blurb',
                    ],
                    [
                        'property' => 'capital',
                        'title' => 'Capital city?',
                        'type' => 'checkbox',
                    ],
                ],
                'title' => 'City information',
                'description' => 'Describe this city with more additional information.',
            ],
        ];
    }
}
