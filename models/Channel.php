<?php namespace Winter\Test\Models;

use Model;

/**
 * Channel Model
 */
class Channel extends Model
{
    use \Winter\Storm\Database\Traits\NestedTree;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_channels';

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
    public $belongsTo = [
        'user' => 'Winter\Test\Models\User'
    ];
    public $belongsToMany = [
        'related' => [
            'Winter\Test\Models\Channel',
            'table' => 'winter_test_related_channels',
            'key' => 'related_id'
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getCustomTitleAttribute()
    {
        return $this->title.' (#'.$this->id.')';
    }
}
