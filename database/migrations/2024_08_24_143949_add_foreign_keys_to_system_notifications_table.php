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
        Schema::table('system_notifications', function (Blueprint $table) {
            $table->foreign(['sent_by'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['type_id'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('system_notifications', function (Blueprint $table) {
            $table->dropForeign('system_notifications_sent_by_foreign');
            $table->dropForeign('system_notifications_type_id_foreign');
        });
    }
};
