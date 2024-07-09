<?php namespace Pensoft\TrainingCorner\Components;

use Cms\Classes\ComponentBase;
use Pensoft\TrainingCorner\Models\Training;

class TrainingCorner extends ComponentBase
{
    public $trainings;

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
    }

    public function onSearchRecords()
    {
        $query = input('query');
        $this->trainings = $this->loadTrainings($query);
        return [
            '#trainingResults' => $this->renderPartial('TrainingCorner::_trainings', ['trainings' => $this->trainings])
        ];
    }

    protected function loadTrainings($query = null)
    {
        {
            $trainingsQuery = Training::with(['videos' => function($query) {
                $query->orderBy('sort_order', 'asc');
            }, 'documents' => function($query) {
                $query->orderBy('sort_order', 'asc');
            }])->orderBy('sort_order');
    
            if ($query) {
                $trainingsQuery->where(function($q) use ($query) {
                    $q->where('name', 'ILIKE', "%$query%")
                      ->orWhere('summery', 'ILIKE', "%$query%")
                      ->orWhere('keywords', 'ILIKE', "%$query%")
                      ->orWhereHas('documents', function($q) use ($query) {
                          $q->where('name', 'ILIKE', "%$query%");
                      })
                      ->orWhereHas('videos', function($q) use ($query) {
                          $q->where('name', 'ILIKE', "%$query%");
                      });
                });
            }
    
            return $trainingsQuery->get();
        }
    }
}
