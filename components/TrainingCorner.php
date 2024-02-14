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

    protected function loadTrainings()
    {
        /* get documents and video sorted by the specified order in the backend form **/
        return Training::with(['videos' => function($query) {
            $query->orderBy('sort_order', 'asc');
        }, 'documents' => function($query) {
            $query->orderBy('sort_order', 'asc');
        }])->orderBy('sort_order')->get();
    }
}
