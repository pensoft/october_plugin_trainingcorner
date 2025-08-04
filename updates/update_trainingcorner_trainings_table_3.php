<?php

namespace Pensoft\TrainingCorner\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateTrainingcornerTrainingsTable3 extends Migration
{
    public function up()
    {
        Schema::table('pensoft_trainingcorner_trainings', function (Blueprint $table) {
            if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'training_keywords')) {
                $table->json('training_keywords')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('pensoft_trainingcorner_trainings', function (Blueprint $table) {
            if (Schema::hasColumn('pensoft_trainingcorner_trainings', 'training_keywords')) {
                $table->dropColumn('training_keywords');
            }
        });
    }
}