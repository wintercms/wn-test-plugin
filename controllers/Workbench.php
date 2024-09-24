<?php

namespace Winter\Test\Controllers;

use Backend\Behaviors\WorkbenchController;
use Backend\Classes\Controller;

class Workbench extends Controller
{
    public $implement = [
        WorkbenchController::class,
    ];
}
