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
        Schema::table('leads', function (Blueprint $table) {
            $table->foreign(['client_id'])->references(['id'])->on('clients')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['status'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['type_id'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign('leads_client_id_foreign');
            $table->dropForeign('leads_status_foreign');
            $table->dropForeign('leads_type_id_foreign');
            $table->dropForeign('leads_user_id_foreign');
        });
    }
};
