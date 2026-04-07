<?php namespace Pensoft\TrainingCorner\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateTrainingCornerDocumentsTable2 extends Migration {
    public function up(): void
    {
        Schema::table('pensoft_trainingcorner_documents', function (Blueprint $table) {
            $table->integer('sort_order')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pensoft_trainingcorner_documents', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
}
