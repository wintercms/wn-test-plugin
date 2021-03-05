<?php namespace Winter\Test\Models;

use Model;
use Winter\Test\Models\Tag;

/**
 * Post Model
 */
class Post extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_posts';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Jsonable fields
     */
    protected $jsonable = ['tags_array', 'tags_array_id'];

    /**
     * @var array Rules
     */
    public $rules = [
        'name' => 'required',
    ];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'comments' => ['Winter\Test\Models\Comment', 'scope' => 'isVisible'],
        'comments_count' => ['Winter\Test\Models\Comment', 'scope' => 'isVisible', 'count' => true]
    ];

    public $belongsTo = [
        'status' => ['Winter\Test\Models\Attribute', 'conditions' => "type = 'general.status'"],
    ];

    public $belongsToMany = [
        'tags' => [
            'Winter\Test\Models\Tag',
            'table' => 'winter_test_posts_tags',
            'key' => 'post_id',
            'otherKey' => 'tag_id'
        ]
    ];

    public $morphOne = [
        'review' => ['Winter\Test\Models\Review', 'name' => 'product'],
    ];

    public $morphToMany = [
        'galleries' => ['Winter\Test\Models\Gallery', 'name' => 'entity', 'table' => 'winter_test_gallery_entity'],
    ];

    //
    // Options
    //

    public function getTagsArrayOptions($value, $formData)
    {
        return Tag::all()->lists('name');
    }

    public function getTagsStringOptions($value, $formData)
    {
        return self::getTagsArrayOptions($value, $formData);
    }

    public function getTagsArrayIdOptions($value, $formData)
    {
        return Tag::all()->pluck('name', 'id')->toArray();
    }

    public function getTagsStringIdOptions($value, $formData)
    {
        return self::getTagsArrayIdOptions($value, $formData);
    }
}
