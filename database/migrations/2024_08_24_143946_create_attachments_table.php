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
        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attachment_type_id')->index('attachments_attachment_type_id_foreign');
            $table->string('file_hash');
            $table->string('attachable_type');
            $table->unsignedBigInteger('attachable_id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('file_name');
            $table->string('source');
            $table->unsignedBigInteger('source_id')->nullable();

            $table->index(['attachable_type', 'attachable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
