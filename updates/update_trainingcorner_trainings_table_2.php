<?php

namespace Pensoft\TrainingCorner\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateTrainingCornerTrainingsTable2 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_trainingcorner_trainings', function (Blueprint $table) {
            if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'about')) {
                $table->text('about')->nullable();
            }
            if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'content')) {
                $table->text('content')->nullable();
            }
            if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'start_date')) {
                $table->dateTime('start_date')->nullable();
            }
            if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'end_date')) {
                $table->dateTime('end_date')->nullable();
            }
            if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'duration')) {
                $table->string('duration')->nullable();
            }
            if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'target_audience')) {
                $table->json('target_audience')->nullable();
            }
            if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'topic')) {
                $table->json('topic')->nullable();
            }
            if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'keywords')) {
                $table->json('keywords')->nullable();
            }
            if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'organiser')) {
                $table->text('organiser')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('pensoft_trainingcorner_trainings', function (Blueprint $table) {
            $columns = ['about', 'content', 'start_date', 'end_date', 'duration', 'target_audience', 'topic', 'keywords', 'organiser'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('pensoft_trainingcorner_trainings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
