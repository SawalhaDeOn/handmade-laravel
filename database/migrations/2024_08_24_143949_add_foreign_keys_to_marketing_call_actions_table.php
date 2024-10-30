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
        Schema::table('marketing_call_actions', function (Blueprint $table) {
            $table->foreign(['call_action_id'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['marketing_call_id'])->references(['id'])->on('marketing_calls')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['patient_clinic_id'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['sick_fund_id'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marketing_call_actions', function (Blueprint $table) {
            $table->dropForeign('marketing_call_actions_call_action_id_foreign');
            $table->dropForeign('marketing_call_actions_marketing_call_id_foreign');
            $table->dropForeign('marketing_call_actions_patient_clinic_id_foreign');
            $table->dropForeign('marketing_call_actions_sick_fund_id_foreign');
            $table->dropForeign('marketing_call_actions_user_id_foreign');
        });
    }
};
