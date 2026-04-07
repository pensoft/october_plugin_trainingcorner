<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateVideosTable Migration
 */
class CreateVideosTable extends Migration
{
    public function up(): void
    {
        Schema::create('pensoft_trainingcorner_videos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('training_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->timestamps();

            $table->foreign('training_id')
                  ->references('id')
                  ->on('pensoft_trainingcorner_trainings')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pensoft_trainingcorner_videos');
    }
}
