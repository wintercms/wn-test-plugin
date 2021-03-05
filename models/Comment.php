<?php namespace Winter\Test\Models;

use Model;

/**
 * Comment Model
 */
class Comment extends Model
{

    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_comments';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Jsonable fields
     */
    protected $jsonable = ['breakdown', 'mood', 'quotes'];

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
        'user' => ['Winter\Test\Models\User'],
        'post' => ['Winter\Test\Models\Post']
    ];

    public $attachOne = [
        'photo' => ['System\Models\File']
    ];

    public function scopeIsVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function getFeelingOptions()
    {
        return [
            'sad'      => 'Sad',
            'happy'    => 'Happy',
            'trolling' => "Just trollin' y'all",
        ];
    }
}
