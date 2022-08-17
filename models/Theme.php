<?php namespace Winter\Test\Models;

use Model;

/**
 * Theme Model
 */
class Theme extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_themes';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $morphMany = [
        'reviews' => ['Winter\Test\Models\Review', 'name' => 'product'],
    ];

    public $morphOne = [
        'meta' => ['Winter\Test\Models\Meta', 'name' => 'taggable'],
    ];
}
