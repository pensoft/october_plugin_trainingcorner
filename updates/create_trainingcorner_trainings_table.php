<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateTrainingsTable Migration
 */
class CreateTrainingsTable extends Migration
{
    public function up()
    {
        Schema::create('pensoft_trainingcorner_trainings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pensoft_trainingcorner_trainings');
    }
}
