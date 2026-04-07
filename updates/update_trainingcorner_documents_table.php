<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateTrainingCornerDocumentsTable extends Migration
{
    public function up(): void
    {
        Schema::table('pensoft_trainingcorner_documents', function (Blueprint $table) {
            $table->text('slideshare')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_trainingcorner_documents', function (Blueprint $table) {
            $table->dropColumn('slideshare');
        });
    }
}
