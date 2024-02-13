<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftTrainingcornerTrainings extends Migration
{
    public function up()
    {
        Schema::table('pensoft_trainingcorner_trainings', function($table)
        {
            $table->integer('sort_order')->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('pensoft_trainingcorner_trainings', function($table)
        {
            $table->integer('sort_order')->default(null)->change();
        });
    }
}
