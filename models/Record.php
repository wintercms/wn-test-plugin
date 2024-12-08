<?php namespace Winter\Test\Models;

use Backend\Classes\FormField;
use Backend\Widgets\Form;
use Model;
use System\Models\File;

/**
 * Record Model
 */
class Record extends Model
{
    use \Winter\Storm\Database\Traits\Sluggable;
    use \Winter\Storm\Database\Traits\Validation;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'winter_test_records';

    /**
     * Softly implement the TranslatableModel behavior.
     */
    public $implement = ['@Winter.Translate.Behaviors.TranslatableModel'];

    /**
     * Attributes that support translation, if available.
     */
    public $translatable = [
        'name',
        'slug',
    ];

    /**
     * @var array Attributes that should generate a slug
     */
    protected $slugs = [
        'slug' => 'name',
    ];

    /**
     * @var bool Allow trashed slugs to be counted in the slug generation.
     */
    protected $allowTrashedSlugs = false;

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'name' => 'required',
        'slug' => 'required|unique',
        'status' => 'required',
        'published_at' => 'required_if:status,published',
        'featured_image' => 'required',
        'additional_data.basic_fields.email' => 'email',
        'additional_data.basic_fields.number' => 'integer|max:100|min:0',
        'additional_data.basic_fields.range' => 'integer|max:100|min:0',
    ];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [
        'content',
        'content_grid',
        'additional_data',
    ];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
        'deleted_at',
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'author' => [User::class],
    ];
    public $attachOne = [
        'featured_image' => [
            File::class,
            'public' => true,
        ],
        'pdf' => [
            File::class,
            'public' => true,
        ],
    ];
    public $attachMany = [
        'private_images' => [
            File::class,
            'public' => false,
        ],
        'private_files' => [
            File::class,
            'public' => false,
        ],
    ];

    public $hasMany = [
        'tags' => ['Winter\Test\Models\Tag', 'delete' => true],
    ];

    public $morphMany = [
        'morphed_tags' => ['Winter\Test\Models\Tag', 'name' => 'taggable', 'delete' => true],
    ];

    /**
     * Hook that runs before the model is validated
     */
    public function beforeValidate(): void
    {
        // Add validation rules for the optionable fields
        // Checkboxlist is excluded because it returns multiple values as an array
        $optionableFields = [
            'balloon-selector',
            'dropdown',
            'radio',
        ];
        foreach ($optionableFields as $field) {
            $this->rules["additional_data.basic_fields.$field"] = "in:" . implode(',', array_keys(static::staticGetOptions(null, null)));
        }

        // Add validation rules for the "status" attribute
        $this->rules['status'] = $this->rules['status'] . '|in:' . implode(',', array_keys($this->getStatusOptions($this->status, $this)));
    }

    /**
     * Static method that returns options for any optionable field type
     * (balloon-selector, checkboxlist, dropdown, radio)
     */
    public static function staticGetOptions(?Form $widget, ?FormField $field): array
    {
        return [
            'option1' => 'Option 1',
            'option2' => 'Option 2',
            'option3' => 'Option 3',
            'option4' => 'Option 4',
        ];
    }

    /**
     * Returns available options for the "status" attribute
     */
    public function getStatusOptions(string|array|null $value, self|null $formData): array
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PUBLISHED => 'Published',
        ];
    }
}
