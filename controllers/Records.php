<?php namespace Winter\Test\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

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

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Winter.Test', 'test', 'records');
    }

     /**
     * Called before a list record is duplicated.
     * @param \Winter\Storm\Database\Model|\Winter\Storm\Halcyon\Model
     */
    public function listBeforeReplicate($model, $original)
    {
        // Change original slug name
        $model->slug = $original->slug . '_copy';
        // Replicate attachment
        $model->featured_image =  $original->featured_image->replicate();
    }
}
