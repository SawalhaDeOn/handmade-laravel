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
        Schema::table('system_sms_notifications', function (Blueprint $table) {
            $table->foreign(['type_id'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('system_sms_notifications', function (Blueprint $table) {
            $table->dropForeign('system_sms_notifications_type_id_foreign');
        });
    }
};
