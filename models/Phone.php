<?php namespace Winter\Test\Models;

use Model;

/**
 * Phone Model
 */
class Phone extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_phones';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Rules
     */
    public $rules = [
        'name' => 'required',
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'person' => ['Winter\Test\Models\Person']
    ];

    public $attachOne = [
        'picture' => ['System\Models\File']
    ];

    public function getBrandOptions()
    {
        return [
            'nokia'  => 'Nokia',
            'apple'  => 'Apple',
            'samsung' => 'Samsung',
        ];
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCustomSearch($query, $term)
    {
        $query->where('name', $term);
    }
}
