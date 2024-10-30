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
        Schema::table('clients', function (Blueprint $table) {
            $table->foreign(['assign_city_id'])->references(['id'])->on('cities')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['call_id'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['category'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['city_id'])->references(['id'])->on('cities')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['status'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['type_id'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign('clients_assign_city_id_foreign');
            $table->dropForeign('clients_call_id_foreign');
            $table->dropForeign('clients_category_foreign');
            $table->dropForeign('clients_city_id_foreign');
            $table->dropForeign('clients_status_foreign');
            $table->dropForeign('clients_type_id_foreign');
        });
    }
};
