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
        Schema::create('short_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_id')->index('short_messages_type_id_foreign');
            $table->string('to', 15);
            $table->text('text');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_messages');
    }
};
