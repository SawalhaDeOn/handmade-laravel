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
        Schema::create('call_questionnaire_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('call_questionnaire_id')->index('call_questionnaire_questions_call_questionnaire_id_foreign');
            $table->string('text');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_questionnaire_questions');
    }
};
