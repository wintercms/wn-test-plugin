<?php namespace Winter\Test\Models;

use Model;

/**
 * Model
 */
class Page extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_pages';

    /**
     * Softly implement the TranslatableModel behavior.
     */
    public $implement = ['@Winter.Translate.Behaviors.TranslatableModel'];

    /**
     * Attributes that support translation, if available.
     */
    public $translatable = ['title'];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * Attributes to be stored as json
     */
    public $jsonable = [
        'content'
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'type' => 'required',
        'content.title' => 'required|min:3'
    ];
}
