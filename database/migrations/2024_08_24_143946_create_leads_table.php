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
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->dateTime('lead_date')->nullable();
            $table->integer('active')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id')->nullable()->index('leads_user_id_foreign');
            $table->unsignedBigInteger('type_id')->nullable()->index('leads_type_id_foreign');
            $table->unsignedBigInteger('client_id')->nullable()->index('leads_client_id_foreign');
            $table->unsignedBigInteger('status')->nullable()->index('leads_status_foreign');
            $table->integer('intersted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
