<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateModulesTable Migration
 */
class CreateModulesTable extends Migration
{
    public function up(): void
    {
        Schema::create('pensoft_trainingcorner_modules', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('training_id')->unsigned()->nullable();
            $table->string('module_name')->nullable();
            $table->text('module_text')->nullable();
            $table->json('module_youtube_urls')->nullable();
            $table->json('slideshares')->nullable();
            $table->integer('sort_order')->nullable();
            $table->timestamps();

            $table->foreign('training_id')
                  ->references('id')
                  ->on('pensoft_trainingcorner_trainings')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pensoft_trainingcorner_modules');
    }
}
