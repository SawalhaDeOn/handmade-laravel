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
        Schema::table('tawktomessage', function (Blueprint $table) {
            $table->foreign(['action_id'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['status_id'])->references(['id'])->on('constants')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tawktomessage', function (Blueprint $table) {
            $table->dropForeign('tawktomessage_action_id_foreign');
            $table->dropForeign('tawktomessage_status_id_foreign');
        });
    }
};
