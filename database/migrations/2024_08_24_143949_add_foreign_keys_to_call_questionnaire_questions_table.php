<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('call_questionnaire_questions', function (Blueprint $table) {
            $table->foreign(['call_questionnaire_id'])->references(['id'])->on('call_questionnaires')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('call_questionnaire_questions', function (Blueprint $table) {
            $table->dropForeign('call_questionnaire_questions_call_questionnaire_id_foreign');
        });
    }
};
