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
        Schema::create('cdr_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->dateTime('date');
            $table->string('from');
            $table->string('to');
            $table->integer('duration');
            $table->string('call_status', 200)->nullable();
            $table->string('call_type', 200)->nullable();
            $table->string('record_file_name');
            $table->timestamps();
            $table->integer('history')->default(0);
            $table->string('uniqueid', 200)->nullable()->index();
            $table->string('record_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cdr_logs');
    }
};
