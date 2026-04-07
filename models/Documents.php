<?php namespace Pensoft\TrainingCorner\Models;

use Model;
use October\Rain\Database\Traits\Sortable;

/**
 * Documents Model
 */
class Documents extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use Sortable;
    /**
     * @var string table associated with the model
     */
    public $table = 'pensoft_trainingcorner_documents';

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = ['name', 'slideshare', 'sort_order', 'training_id'];

    /**
     * @var array rules for validation
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @var array jsonable attribute names that are json encoded and decoded from the database
     */
    protected $jsonable = [];

    /**
     * @var array appends attributes to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array hidden attributes removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array hasOne and other relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'cover' => \System\Models\File::class,
        'document' => \System\Models\File::class
    ];
    public $attachMany = [];

    public function getSortOrderColumn()
    {
        return 'sort_order';
    }
}
