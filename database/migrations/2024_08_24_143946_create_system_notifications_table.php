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
        Schema::create('system_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_id')->index('system_notifications_type_id_foreign');
            $table->boolean('status')->default(true);
            $table->boolean('active')->default(true);
            $table->string('subject', 200)->nullable();
            $table->string('message', 2000)->nullable();
            $table->string('notifiable_type');
            $table->unsignedBigInteger('notifiable_id');
            $table->string('attachment', 200)->nullable();
            $table->string('sent_to');
            $table->unsignedBigInteger('sent_by')->index('system_notifications_sent_by_foreign');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['notifiable_type', 'notifiable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_notifications');
    }
};
