<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateTrainingCornerVideosTable2 extends Migration
{

    public function up(): void
    {
        if (Schema::hasTable('pensoft_trainingcorner_videos'))
        {
            Schema::table('pensoft_trainingcorner_videos', function(Blueprint $table)
            {
                if (!Schema::hasColumn('pensoft_trainingcorner_videos', 'youtube_url'))
                {
                    $table->string('youtube_url')->nullable();
                }
            });
        }
    }


    public function down(): void
    {
        if (Schema::hasTable('pensoft_trainingcorner_videos'))
        {
            Schema::table('pensoft_trainingcorner_videos', function(Blueprint $table)
            {
                if (Schema::hasColumn('pensoft_trainingcorner_videos', 'youtube_url'))
                {
                    $table->dropColumn('youtube_url');
                }

            });
        }
    }

}
