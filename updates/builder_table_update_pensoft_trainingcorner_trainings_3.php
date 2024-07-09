<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePensoftTrainingcornerTrainings3 extends Migration
{

    public function up()
    {
        if (Schema::hasTable('pensoft_trainingcorner_trainings'))
        {
            Schema::table('pensoft_trainingcorner_trainings', function($table)
            {
                if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'summery')) 
                {
                    $table->string('summery')->nullable();
                }

                if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'url')) 
                {
                    $table->string('url')->nullable();
                }

                if (!Schema::hasColumn('pensoft_trainingcorner_trainings', 'keywords')) 
                {
                    $table->text('keywords')->nullable();
                }
            });
        }
    }
    
    
    public function down()
    {
        if (Schema::hasTable('pensoft_trainingcorner_trainings')) 
        {
            Schema::table('pensoft_trainingcorner_trainings', function($table)
            {
                if (Schema::hasColumn('pensoft_trainingcorner_trainings', 'summery')) 
                {
                    $table->dropColumn('summery');
                }

                if (Schema::hasColumn('pensoft_trainingcorner_trainings', 'url')) 
                {
                    $table->dropColumn('url');
                }

                if (Schema::hasColumn('pensoft_trainingcorner_trainings', 'keywords')) 
                {
                    $table->dropColumn('keywords');
                }
                
            });
        }
    }

}