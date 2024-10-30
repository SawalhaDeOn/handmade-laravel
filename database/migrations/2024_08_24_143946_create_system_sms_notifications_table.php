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
        Schema::create('system_sms_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_id')->index('system_sms_notifications_type_id_foreign');
            $table->string('mobile', 100);
            $table->string('gateway', 100);
            $table->string('message', 100);
            $table->integer('sms_count');
            $table->string('sender_type');
            $table->unsignedBigInteger('sender_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['sender_type', 'sender_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_sms_notifications');
    }
};
