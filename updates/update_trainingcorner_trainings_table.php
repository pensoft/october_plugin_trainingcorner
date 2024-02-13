<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateTrainingCornerTrainingsTable extends Migration
{
    public function up()
    {
        Schema::table('pensoft_trainingcorner_trainings', function (Blueprint $table) {
            $table->integer('sort_order')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pensoft_trainingcorner_trainings', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
}