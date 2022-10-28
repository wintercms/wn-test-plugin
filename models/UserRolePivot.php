<?php namespace Winter\Test\Models;

use Winter\Storm\Database\Pivot;

/**
 * User-Role Pivot Model
 */
class UserRolePivot extends Pivot
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_users_roles';

    /**
     * @var array Rules
     */
    public $rules = [
        'clearance_level' => 'required|min:3',
    ];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = ['awards'];

}
