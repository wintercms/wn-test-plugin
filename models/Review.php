<?php namespace Winter\Test\Models;

use Model;

/**
 * Review Model
 */
class Review extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_reviews';

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
    public $morphTo = [
        'product' => []
    ];

    public $attachOne = [
        'photo' => ['System\Models\File']
    ];
}
