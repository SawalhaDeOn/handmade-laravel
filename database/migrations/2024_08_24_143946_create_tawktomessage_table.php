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
        Schema::create('tawktomessage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->timestamps();
            $table->string('event')->nullable();
            $table->string('chatId')->nullable();
            $table->string('time')->nullable();
            $table->string('text')->nullable();
            $table->string('msg_type')->nullable();
            $table->string('sender_type')->nullable();
            $table->string('visit_country')->nullable();
            $table->string('visit_city')->nullable();
            $table->string('visit_email')->nullable();
            $table->string('visit_id')->nullable();
            $table->string('visit_name')->nullable();
            $table->string('message_attchs')->nullable();
            $table->string('message_time')->nullable();
            $table->text('message_msg')->nullable();
            $table->string('message_type')->nullable();
            $table->string('message_sender')->nullable();
            $table->string('att_content_file_extension')->nullable();
            $table->string('att_content_file_size')->nullable();
            $table->string('att_content_file_mimeType')->nullable();
            $table->string('content_file_name')->nullable();
            $table->string('content_file_url')->nullable();
            $table->string('content_file')->nullable();
            $table->string('content')->nullable();
            $table->string('att_type')->nullable();
            $table->string('chat_id')->nullable();
            $table->string('telephone')->nullable();
            $table->unsignedBigInteger('action_id')->nullable()->index('tawktomessage_action_id_foreign');
            $table->unsignedBigInteger('status_id')->nullable()->index('tawktomessage_status_id_foreign');
            $table->string('lead_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tawktomessage');
    }
};
