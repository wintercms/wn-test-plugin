<?php namespace Winter\Test\Models;

use Model;

/**
 * User Model
 */
class User extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_users';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Rules
     */
    public $rules = [
        'photo' => 'required',
        'portfolio' => 'required',
        'roles' => 'required',
    ];

    /**
     * @var array Relations
     */
    public $belongsToMany = [
        'roles' => [
            'Winter\Test\Models\Role',
            'table' => 'winter_test_users_roles',
            'timestamps' => true,
            'order' => 'name'
        ],
        'roles_count' => [
            'Winter\Test\Models\Role',
            'table' => 'winter_test_users_roles',
            'count' => true
        ],
        'roles_pivot' => [
            'Winter\Test\Models\Role',
            'table' => 'winter_test_users_roles',
            'pivot' => ['clearance_level', 'is_executive'],
            'timestamps' => true
        ],
        'roles_pivot_model' => [
            'Winter\Test\Models\Role',
            'table' => 'winter_test_users_roles',
            'pivot' => ['clearance_level', 'is_executive'],
            'timestamps' => true,
            'pivotModel' => 'Winter\Test\Models\UserRolePivot',
        ],
    ];

    public $attachOne = [
        'photo' => ['System\Models\File'],
        'photo_secure' => ['System\Models\File', 'public' => false],
        'certificate' => ['System\Models\File'],
        'certificate_secure' => ['System\Models\File', 'public' => false],
        'custom_file' => 'Winter\Test\Models\CustomFile'
    ];

    public $attachMany = [
        'portfolio' => ['System\Models\File'],
        'portfolio_secure' => ['System\Models\File', 'public' => false],
        'files' => ['System\Models\File'],
        'files_secure' => ['System\Models\File', 'public' => false],
    ];

    public function scopeApplyRoleFilter($query, $filtered)
    {
        return $query->whereHas('roles', function ($q) use ($filtered) {
            $q->whereIn('id', $filtered);
        });
    }
}
