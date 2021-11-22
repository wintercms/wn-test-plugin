<?php namespace Winter\Test\Models;

use Model;

/**
 * Attribute Model
 */
class Attribute extends Model
{
    use \Winter\Storm\Database\Traits\Sortable;

    const GENERAL_STATUS = 'general.status';
    const GENERAL_TYPE = 'general.type';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_attributes';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];
}
