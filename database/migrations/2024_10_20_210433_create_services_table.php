<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_he')->nullable();
            $table->string('notes')->nullable();
            $table->string('notes_en')->nullable();
            $table->string('notes_he')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('active')->nullable();
            $table->softDeletes();


        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
