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
        Schema::table('client_call_actions', function (Blueprint $table) {
            $table->foreign(['assign_employee'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['assign_status'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['caller_type'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['call_status'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['category'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['urgency'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_call_actions', function (Blueprint $table) {
            $table->dropForeign('client_call_actions_assign_employee_foreign');
            $table->dropForeign('client_call_actions_assign_status_foreign');
            $table->dropForeign('client_call_actions_caller_type_foreign');
            $table->dropForeign('client_call_actions_call_status_foreign');
            $table->dropForeign('client_call_actions_category_foreign');
            $table->dropForeign('client_call_actions_urgency_foreign');
        });
    }
};
