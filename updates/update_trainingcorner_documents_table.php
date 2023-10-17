<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateTrainingCornerDocumentsTable extends Migration
{
    public function up()
    {
        Schema::table('pensoft_trainingcorner_documents', function (Blueprint $table) {
            $table->text('slideshare')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pensoft_trainingcorner_documents', function (Blueprint $table) {
            $table->dropColumn('slideshare');
        });
    }
}

