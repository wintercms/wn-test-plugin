<?php namespace Winter\Test\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Users Back-end Controller
 */
class Users extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\RelationController::class,
    ];

    public $requiredPermissions = ['winter.test.access_plugin'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Winter.Test', 'test', 'users');
    }

    public function listFilterExtendScopes($filter)
    {
        // Demonstrate how to disable a scope based on the value of another scope
        if (input('scopeName') === 'disable_roles') {
            $disableRoles = input('value');
            if ($disableRoles === 'false') {
                $disableRoles = false;
            }
        } else {
            $disableRoles = $filter->getScopeValue('disable_roles');
        }

        if ($disableRoles) {
            $filter->removeScope('roles');
        }

        $filter->bindEvent('filter.update', function ($params) use ($filter) {
            $filter->prepareVars();
            return [
                '#' . $filter->getId() => $filter->makePartial('filter_scopes'),
            ];
        });
    }
}
