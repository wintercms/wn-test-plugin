<?php

namespace Winter\Test;

use Backend;
use System\Classes\PluginBase;

/**
 * Test Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Winter Tester',
            'description' => 'Used for testing the Relation Controller behavior and others.',
            'author'      => 'Winter CMS',
            'icon'        => 'icon-child',
            'homepage'    => 'https://github.com/wintercms/wn-test-plugin',
        ];
    }

    public function registerPermissions()
    {
        return [
            'winter.test.access_plugin' => [
                'label' => 'Allow access to the plugin',
                'tab' => 'Winter Tester',
            ]
        ];
    }

    public function registerNavigation()
    {
        return [
            'test' => [
                'label'    => 'Playground',
                'url'      => Backend::url('winter/test/people'),
                'icon'     => 'icon-child',
                'order'    => 200,
                'permissions' => ['winter.test.access_plugin'],

                'sideMenu' => [
                    'people'    => [
                        'label' => 'People',
                        'icon'  => 'icon-database',
                        'url'   => Backend::url('winter/test/people'),
                    ],
                    'posts'     => [
                        'label' => 'Posts',
                        'icon'  => 'icon-database',
                        'url'   => Backend::url('winter/test/posts'),
                    ],
                    'users'     => [
                        'label' => 'Users',
                        'icon'  => 'icon-database',
                        'url'   => Backend::url('winter/test/users'),
                    ],
                    'countries' => [
                        'label' => 'Countries',
                        'icon'  => 'icon-database',
                        'url'   => Backend::url('winter/test/countries'),
                    ],
                    'reviews'   => [
                        'label' => 'Reviews',
                        'icon'  => 'icon-database',
                        'url'   => Backend::url('winter/test/reviews'),
                    ],
                    'galleries' => [
                        'label' => 'Galleries',
                        'icon'  => 'icon-database',
                        'url'   => Backend::url('winter/test/galleries'),
                    ],
                    'trees'     => [
                        'label' => 'Trees',
                        'icon'  => 'icon-database',
                        'url'   => Backend::url('winter/test/trees'),
                    ],
                    'pages'     => [
                        'label' => 'Pages',
                        'icon'  => 'icon-database',
                        'url'   => Backend::url('winter/test/pages'),
                    ],
                    'cities' => [
                        'label' => 'Cities',
                        'icon'  => 'icon-database',
                        'url'   => Backend::url('winter/test/cities'),
                    ],
                    'locations' => [
                        'label' => 'Locations',
                        'icon'  => 'icon-database',
                        'url'   => Backend::url('winter/test/locations'),
                    ],
                ],
            ],
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'Winter\Test\FormWidgets\TimeChecker' => [
                'code' => 'timecheckertest',
            ],
        ];
    }

    public function boot()
    {
        if (\App::runningInBackend()) {
            $pluginManager = \System\Classes\PluginManager::instance();
            if ($pluginManager->hasPlugin('Winter.Pages')) {
                \Event::listen('backend.form.extendFields', function ($widget) {
                    if (get_class($widget->model) !== 'Winter\Pages\Classes\Page') {
                        return;
                    }

                    if ($widget->isNested || $widget->model->url !== '/') {
                        return;
                    }

                    $widget->addFields([
                        'viewBag[test_repeater]' => [
                            'prompt' => 'Add Data',
                            'type'   => 'repeater',
                            'groups' => [
                                'textarea' => [
                                    'name'        => 'Textarea',
                                    'description' => 'Basic text field',
                                    'icon'        => 'icon-file-text-o',
                                    'fields'      => [
                                        'text_area' => [
                                            'label' => 'Text Content',
                                            'type'  => 'textarea',
                                            'size'  => 'large',
                                        ],
                                    ],
                                ],
                                'quote'    => [
                                    'name'        => 'Quote',
                                    'description' => 'Quote item',
                                    'icon'        => 'icon-quote-right',
                                    'fields'      => [
                                        'quote_position' => [
                                            'span'    => 'auto',
                                            'label'   => 'Quote Position',
                                            'type'    => 'radio',
                                            'options' => [
                                                'left'   => 'Left',
                                                'center' => 'Center',
                                                'right'  => 'Right',
                                            ],
                                        ],
                                        'quote_content'  => [
                                            'span'  => 'auto',
                                            'label' => 'Details',
                                            'type'  => 'textarea',
                                        ],
                                    ],
                                ],
                                'image'    => [
                                    'name'        => 'Image',
                                    'description' => 'Pick something from the media library',
                                    'icon'        => 'icon-photo',
                                    'fields'      => [
                                        'img_upload'   => [
                                            'span'        => 'auto',
                                            'label'       => 'Image',
                                            'type'        => 'mediafinder',
                                            'mode'        => 'image',
                                            'imageHeight' => 260,
                                            'imageWidth'  => 260,
                                        ],
                                        'img_position' => [
                                            'span'    => 'auto',
                                            'label'   => 'Image Position',
                                            'type'    => 'radio',
                                            'options' => [
                                                'left'   => 'Left',
                                                'center' => 'Center',
                                                'right'  => 'Right',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'span'   => 'full',
                            'tab'    => 'Test',
                        ],
                    ], 'primary');
                    $widget->model->rules += [
                        'test_repeater' => 'required',
                    ];
                });
            }
        }
    }
}
