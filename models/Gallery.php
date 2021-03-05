<?php

namespace Winter\Test\Models;

use Model;
use Winter\Storm\Database\Traits\Validation;

class Gallery extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_galleries';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'title',
    ];

    public $rules = [
        'title' => 'required|between:3,255',
    ];

    /**
     * @var array Relations
     */
    public $morphedByMany = [
        'posts' => [
            'Winter\Test\Models\Post',
            'name' => 'entity',
            'table' => 'winter_test_gallery_entity'
        ],
    ];

    public $attachMany = [
        'images' => 'System\Models\File',
    ];
}
