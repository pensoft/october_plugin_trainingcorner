<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateTrainingsTable Migration
 */
class CreateTrainingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('pensoft_trainingcorner_trainings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pensoft_trainingcorner_trainings');
    }
}
