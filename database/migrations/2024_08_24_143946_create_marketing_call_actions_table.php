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
        Schema::create('marketing_call_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('marketing_call_id')->index('marketing_call_actions_marketing_call_id_foreign');
            $table->unsignedBigInteger('call_action_id')->index('marketing_call_actions_call_action_id_foreign');
            $table->unsignedBigInteger('user_id')->index('marketing_call_actions_user_id_foreign');
            $table->string('status');
            $table->unsignedBigInteger('sick_fund_id')->index('marketing_call_actions_sick_fund_id_foreign');
            $table->unsignedBigInteger('patient_clinic_id')->index('marketing_call_actions_patient_clinic_id_foreign');
            $table->date('next_call');
            $table->date('validation_date');
            $table->text('notes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_call_actions');
    }
};
