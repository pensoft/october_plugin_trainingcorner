<?php namespace Pensoft\TrainingCorner\Components;

use Cms\Classes\ComponentBase;
use Pensoft\TrainingCorner\Models\Training;

class TrainingCorner extends ComponentBase
{
    public $trainings;
    public $trainingOptions;
    public $targetAudienceOptions;
    public $topicOptions;
    public $keywordsOptions;

    public function componentDetails()
    {
        return [
            'name'        => 'Training Corner Component',
            'description' => 'A component for training.'
        ];
    }

    public function onRun()
    {
        $this->trainings = $this->loadTrainings();
        $this->trainingOptions = (new Training)->getTrainingOptions();
        $this->targetAudienceOptions = (new Training)->getTargetAudienceOptions();
        $this->topicOptions = (new Training)->getTopicOptions();
        $this->keywordsOptions = (new Training)->getKeywordsOptions();
    }

    public function onSearchRecords()
    {
        $query = input('query');
        $this->trainings = $this->loadTrainings($query);
        return [
            '#trainingResults' => $this->renderPartial('training-results', ['trainings' => $this->trainings])
        ];
    }

    public function onFilterTrainings()
    {
        $query = input('query');
        $filters = [
            'session' => input('session'),
            'audience' => input('audience'), 
            'topic' => input('topic'),
            'keywords' => input('keywords')
        ];
        
        $this->trainings = $this->loadTrainings($query, $filters);
        return [
            '#trainingResults' => $this->renderPartial('training-results', ['trainings' => $this->trainings])
        ];
    }

    protected function loadTrainings($query = null, $filters = [])
    {
        $trainingsQuery = Training::with(['videos' => function($query) {
            $query->orderBy('sort_order', 'asc');
        }, 'documents' => function($query) {
            $query->orderBy('sort_order', 'asc');
        }])->orderBy('sort_order');

        // Apply search query
        if ($query) {
            $trainingsQuery->where(function($q) use ($query) {
                $q->where('name', 'ILIKE', "%$query%")
                  ->orWhere('summery', 'ILIKE', "%$query%")
                  ->orWhere('keywords', 'ILIKE', "%$query%")
                  ->orWhereJsonContains('keywords', $query)
                  ->orWhereHas('documents', function($q) use ($query) {
                      $q->where('name', 'ILIKE', "%$query%");
                  })
                  ->orWhereHas('videos', function($q) use ($query) {
                      $q->where('name', 'ILIKE', "%$query%");
                  });
            });
        }

        // Apply filters
        if (!empty($filters)) {
            // Filter by training session (ID)
            if (!empty($filters['session']) && is_numeric($filters['session']) && $filters['session'] !== 'all') {
                $trainingsQuery->where('id', $filters['session']);
            }

            // Filter by target audience
            if (!empty($filters['audience']) && $filters['audience'] !== 'Target audience' && $filters['audience'] !== 'all') {
                $trainingsQuery->whereJsonContains('target_audience', $filters['audience']);
            }

            // Filter by topic
            if (!empty($filters['topic']) && $filters['topic'] !== 'Topic' && $filters['topic'] !== 'all') {
                $trainingsQuery->whereJsonContains('topic', $filters['topic']);
            }

            // Filter by keywords (JSON array search)
            if (!empty($filters['keywords']) && $filters['keywords'] !== 'Keywords' && $filters['keywords'] !== 'all') {
                $trainingsQuery->whereJsonContains('keywords', $filters['keywords']);
            }
        }

        return $trainingsQuery->get();
    }
}

