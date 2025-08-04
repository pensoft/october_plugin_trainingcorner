<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateTrainingCornerModulesTable extends Migration
{
    public function up()
    {
        Schema::table('pensoft_trainingcorner_modules', function (Blueprint $table) {
            $table->text('module_document_title')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pensoft_trainingcorner_modules', function (Blueprint $table) {
            $table->dropColumn('module_document_title');
        });
    }
}

