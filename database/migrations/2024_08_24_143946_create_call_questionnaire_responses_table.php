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
        Schema::create('call_questionnaire_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('call_id')->index('call_questionnaire_responses_call_id_foreign');
            $table->unsignedBigInteger('call_questionnaire_id')->index('call_questionnaire_responses_call_questionnaire_id_foreign');
            $table->unsignedBigInteger('cq_question_id')->index('call_questionnaire_responses_cq_question_id_foreign');
            $table->text('answer');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_questionnaire_responses');
    }
};
