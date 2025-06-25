<?php

namespace Winter\Test\Controllers;

use Backend\Classes\Controller;
use Winter\Storm\Support\Facades\Flash;

/**
 * Records Backend Controller
 */
class Records extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var string The form layout to use. One of standard, sidebar, fancy
     */
    public $formLayout = 'fancy';

    public function onBasicButton()
    {
        sleep(1);
        Flash::success("AJAX request succeeded!");
    }

    public function onRenderBasicPopup()
    {
        sleep(1);
        return $this->makePartial('basic_popup');
    }
}
