<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Make date column nullable in trainings table
 */
class UpdateTrainingCornerTrainingsTable4 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_trainingcorner_trainings', function (Blueprint $table) {
            $table->dateTime('date')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('pensoft_trainingcorner_trainings', function (Blueprint $table) {
            $table->dateTime('date')->nullable(false)->change();
        });
    }
}
