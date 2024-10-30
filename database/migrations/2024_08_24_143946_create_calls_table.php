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
        Schema::create('calls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('call_type', ['incoming_call', 'outgoing_call']);
            $table->unsignedBigInteger('call_action_id')->index('calls_call_action_id_foreign');
            $table->unsignedBigInteger('patient_action_id')->index('calls_patient_action_id_foreign');
            $table->unsignedBigInteger('user_id')->index('calls_user_id_foreign');
            $table->date('next_call');
            $table->text('notes');
            $table->timestamps();
            $table->softDeletes();
            $table->string('type')->nullable();
            $table->string('call_option')->nullable();
            $table->string('telephone_no')->nullable();
            $table->integer('active')->default(0);
            $table->string('status')->nullable();
            $table->string('call_id')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('patient_sid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
