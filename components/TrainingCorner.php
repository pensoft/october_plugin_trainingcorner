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
        return Training::orderBy('date', 'desc')->get();
    }
}
