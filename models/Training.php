<?php

namespace Pensoft\TrainingCorner\Models;

use Model;
use October\Rain\Database\Traits\Sortable;

/**
 * Training Model
 */
class Training extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use Sortable;

    /**
     * @var string table associated with the model
     */
    public $table = 'pensoft_trainingcorner_trainings';

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = [];

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
    protected $jsonable = ['documents', 'videos', 'target_audience', 'topic', 'keywords', 'training_keywords'];

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
        'updated_at',
        'start_date',
        'end_date'
    ];

    /**
     * @var array hasOne and other relations
     */
    public $hasOne = [];
    public $hasMany = [
        'videos' => [
            'Pensoft\TrainingCorner\Models\Videos',
            'order' => 'sort_order asc'
        ],
        'documents' => [
            'Pensoft\TrainingCorner\Models\Documents',
            'order' => 'sort_order asc'
        ],
        'modules' => [
            'Pensoft\TrainingCorner\Models\Modules',
            'order' => 'sort_order asc'
        ]
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'cover_image' => 'System\Models\File'
    ];
    public $attachMany = [
        'carousel_images' => 'System\Models\File'
    ];

    /**
     * Get Training options for dropdown
     */
    public function getTrainingOptions()
    {
        return Training::all()->pluck('name', 'id')->toArray();
    }

    /**
     * Get Target Audience options for dropdown
     */
    public function getTargetAudienceOptions()
    {
        return [
            'un_cbd_negotiators' => 'UN CBD Negotiators',
            'chm_national_focal_points' => 'CHM National Focal Points',
            'scientists_experts_practitioners' => 'Scientists, Experts and Practitioners',
            'un_cbd_secretariat' => 'UN CBD Secretariat',
            'national_focal_points_secretariats' => 'National Focal Points and Other Relevant Secretariats',
        ];
    }

    /**
     * Get Topic options for dropdown
     */
    public function getTopicOptions()
    {
        return [
            'forest_biodiversity' => 'Forest Biodiversity',
            'marine_coastal_biodiversity' => 'Marine and Coastal Biodiversity',
            'capacity_building' => 'Capacity Building',
            'climate_change_biodiversity' => 'Climate Change and Biodiversity',
            'communication_education_awareness' => 'Communication, Education and Public Awareness',
            'global_strategy_plant_conservation' => 'Global Strategy for Plant Conservation',
            'global_taxonomy_initiative' => 'Global Taxonomy Initiative',
            'health_biodiversity' => 'Health and Biodiversity',
            'identification_monitoring_assessments' => 'Identification, Monitoring, Indicators and Assessments',
            'invasive_alien_species' => 'Invasive Alien Species',
            'new_emerging_issues' => 'New and Emerging Issues',
            'sustainable_use_biodiversity' => 'Sustainable Use of Biodiversity',
            'sustainable_wildlife_management' => 'Sustainable Wildlife Management',
            'technical_scientific_cooperation' => 'Technical and Scientific Cooperation',
            'traditional_knowledge_article_8j' => 'Traditional Knowledge, Innovations and Practices - Article 8(j)'
        ];
    }

    /**
     * Get Keywords options for dropdown
     */
    public function getKeywordsOptions()
    {
        return [
            'cop15' => 'COP15',
            'cop16' => 'COP16',
            'sbstta_25' => 'SBSTTA 25',
            'sbstta_26' => 'SBSTTA 26',
            'central_eastern_europe' => 'Central and Eastern Europe',
            'northern_europe' => 'Northern Europe',
            'european_union' => 'European Union',
            'global' => 'Global',
            'un_cbd_history' => 'UN CBD History',
            'un_cbd_governance' => 'UN CBD Governance',
            'negotiation_processes' => 'Negotiation Processes',
            'expert_engagement' => 'Expert Engagement',
            'km_gbf' => 'KM GBF',
            'chm' => 'CHM',
            'indigenous_peoples_local_communities' => 'Indigenous Peoples and Local Communities'
        ];
    }

    /**
     * Mutator for target_audience to handle empty values
     */
    public function setTargetAudienceAttribute($value)
    {
        $this->attributes['target_audience'] = empty($value) ? null : $value;
    }

    /**
     * Mutator for topic to handle empty values
     */
    public function setTopicAttribute($value)
    {
        $this->attributes['topic'] = empty($value) ? null : $value;
    }

    /**
     * Mutator for keywords to handle empty values
     */
    public function setKeywordsAttribute($value)
    {
        $this->attributes['keywords'] = empty($value) ? null : $value;
    }

    /**
     * Mutator for training_keywords to handle empty values
     */
    public function setTrainingKeywordsAttribute($value)
    {
        $this->attributes['training_keywords'] = empty($value) ? null : $value;
    }
}
