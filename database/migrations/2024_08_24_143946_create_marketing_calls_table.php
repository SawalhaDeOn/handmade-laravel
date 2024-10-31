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
        Schema::create('marketing_calls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('marketing_calls_user_id_foreign');
            $table->date('next_call_date');
            $table->unsignedBigInteger('call_action_id')->nullable()->index('marketing_calls_call_action_id_foreign');
            $table->enum('status', ['Waiting', 'Completed'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_calls');
    }
};
