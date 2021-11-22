<?php namespace Winter\Test\Models;

use Model;

/**
 * Category Model
 */
class Category extends Model
{
    use \Winter\Storm\Database\Traits\Sortable;
    use \Winter\Storm\Database\Traits\SimpleTree;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_categories';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
