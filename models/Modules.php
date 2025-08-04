<?php namespace Pensoft\TrainingCorner\Models;

use Model;
use October\Rain\Database\Traits\Sortable;

/**
 * Documents Model
 */
class Modules extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use Sortable;
    /**
     * @var string table associated with the model
     */
    public $table = 'pensoft_trainingcorner_modules';

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = ['module_name', 'module_text', 'module_youtube_urls', 'slideshares', 'sort_order', 'training_id', 'module_document_title'];

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
    protected $jsonable = ['module_youtube_urls', 'slideshares'];

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
    public $belongsTo = [
        'training' => 'Pensoft\TrainingCorner\Models\Training'
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [
        'module_videos' => 'System\Models\File',
        'module_documents' => 'System\Models\File',
    ];

    public function getSortOrderColumn()
    {
        return 'sort_order';
    }

    /**
     * Convert YouTube URL to embeddable format
     */
    public function getEmbeddableYouTubeUrl($url)
    {
        if (empty($url)) {
            return null;
        }

        // Handle different YouTube URL formats
        $patterns = [
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]+)/',
            '/youtube\.com\/watch\?.*v=([a-zA-Z0-9_-]+)/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return 'https://www.youtube.com/embed/' . $matches[1];
            }
        }

        // If already an embed URL, return as is
        if (strpos($url, 'youtube.com/embed/') !== false) {
            return $url;
        }

        return null;
    }

    /**
     * Get all YouTube URLs in embeddable format
     */
    public function getEmbeddableYouTubeUrls()
    {
        $urls = $this->module_youtube_urls ?: [];
        $embeddableUrls = [];

        foreach ($urls as $urlData) {
            if (isset($urlData['url'])) {
                $embeddableUrl = $this->getEmbeddableYouTubeUrl($urlData['url']);
                if ($embeddableUrl) {
                    $embeddableUrls[] = [
                        'url' => $urlData['url'],
                        'embed_url' => $embeddableUrl,
                        'title' => $urlData['title'] ?? null
                    ];
                }
            }
        }

        return $embeddableUrls;
    }

    /**
     * Check if SlideShare URL is embeddable
     */
    public function getEmbeddableSlideshareUrl($url)
    {
        if (empty($url)) {
            return null;
        }

        // If it's already an embed URL, return as is
        if (strpos($url, '/embed_code/') !== false || strpos($url, 'slideshare.net/slideshow/embed_code/') !== false) {
            return $url;
        }

        // Convert regular SlideShare URLs to embed format
        if (preg_match('/slideshare\.net\/([^\/]+)\/([^\/?\s]+)/', $url, $matches)) {
            return 'https://www.slideshare.net/slideshow/embed_code/key/' . $matches[2];
        }

        return $url;
    }

    /**
     * Get all SlideShare URLs in embeddable format
     */
    public function getEmbeddableSlideshares()
    {
        $slideshares = $this->slideshares ?: [];
        $embeddableSlideshares = [];

        foreach ($slideshares as $slideData) {
            if (isset($slideData['embed_url'])) {
                $embeddableUrl = $this->getEmbeddableSlideshareUrl($slideData['embed_url']);
                $embeddableSlideshares[] = [
                    'embed_url' => $slideData['embed_url'],
                    'embeddable_url' => $embeddableUrl,
                    'title' => $slideData['title'] ?? null
                ];
            }
        }

        return $embeddableSlideshares;
    }
}
