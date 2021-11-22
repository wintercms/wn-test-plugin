<?php namespace Winter\Test\Models;

use Model;

/**
 * City Model
 */
class City extends Model
{
    use \System\Traits\PropertyContainer;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_cities';

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['country_id', 'name'];

    /**
     * @var array Relations
     */
    public $hasMany = ['locations' => Location::class];
    public $belongsTo = ['country' => Country::class];

    /**
     * Gets values for the Inspector
     *
     * @return array
     */
    public function getPropertyOptions($property)
    {
        if ($property === 'linkedCities') {
            return static::get()->pluck('name', 'id')->toArray();
        }
    }
}
