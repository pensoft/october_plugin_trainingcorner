<?php namespace Pensoft\TrainingCorner\Models;

use Model;
use October\Rain\Database\Traits\Sortable;

/**
 * Videos Model
 */
class Videos extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use Sortable;

    /**
     * @var string table associated with the model
     */
    public $table = 'pensoft_trainingcorner_videos';

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = ['name', 'video', 'youtube_url', 'sort_order', 'training_id'];

    /**
     * @var array rules for validation
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

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
     * @var array dates attributes that should be mutated to dates
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

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
        'video' => 'System\Models\File'
    ];
    public $attachMany = [];

    public function getSortOrderColumn()
    {
        return 'sort_order';
    }

    public function beforeSave()
    {
        $url = $this->youtube_url;

        // check if the URL is a YouTube link
        if (preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\//', $url)) {
            // check if the URL is already an embed link
            if (!preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\/embed\/(.+)$/', $url)) {
                // modify the URL to include the embed code
                $embed_url = $this->convertEmbed($url);
                $this->youtube_url = $embed_url;
            }
        }
    }
    
    private function convertEmbed($url) {
        // check if the URL is a YouTube link
        if (preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\//', $url)) {
            // check if the URL is already an embed link
            if (!preg_match('/^(https?:\/\/)?((www\.)?youtube\.com|youtu\.be)\/embed\/(.+)$/', $url)) {
                // modify the URL to include the embed code
                $id = '';
                if (strpos($url, 'youtu.be/') !== false) {
                    // extract video id from youtu.be short link
                    $id = substr(strstr($url, 'youtu.be/'), 9);
                } else {
                    // extract video id from youtube.com link
                    $query_string = parse_url($url, PHP_URL_QUERY);
                    parse_str($query_string, $query_params);
                    $id = $query_params['v'] ?? '';
                }
                $embed_url = 'https://www.youtube.com/embed/' . $id;
                return $embed_url;
            }
        }
        return $url;
    }

}
