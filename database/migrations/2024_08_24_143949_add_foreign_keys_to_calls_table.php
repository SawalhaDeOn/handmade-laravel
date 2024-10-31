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
        Schema::table('calls', function (Blueprint $table) {
            $table->foreign(['call_action_id'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['patient_action_id'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->dropForeign('calls_call_action_id_foreign');
            $table->dropForeign('calls_patient_action_id_foreign');
            $table->dropForeign('calls_user_id_foreign');
        });
    }
};
