<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateDocumentsTable Migration
 */
class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('pensoft_trainingcorner_documents', function (Blueprint $table) {
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

    public function down()
    {
        Schema::dropIfExists('pensoft_trainingcorner_documents');
    }
}
