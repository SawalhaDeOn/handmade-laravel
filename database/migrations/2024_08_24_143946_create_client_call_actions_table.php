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
        Schema::create('client_call_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('telephone', 15);
            $table->integer('call_action')->nullable();
            $table->string('action_type')->nullable();
            $table->integer('action_id')->nullable();
            $table->string('listen')->nullable();
            $table->boolean('status')->default(true);
            $table->string('notes')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_sid')->nullable();
            $table->string('type')->nullable();
            $table->string('call_option')->nullable();
            $table->string('telephone_no')->nullable();
            $table->integer('active')->default(0);
            $table->string('uniqueid', 200)->default('0');
            $table->string('call_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->double('duration', 8, 2)->nullable();
            $table->string('module')->nullable();
            $table->integer('module_id')->nullable();
            $table->string('client_name_ar')->nullable();
            $table->unsignedBigInteger('category')->nullable()->index('client_call_actions_category_foreign');
            $table->unsignedBigInteger('assign_employee')->nullable()->index('client_call_actions_assign_employee_foreign');
            $table->unsignedBigInteger('urgency')->nullable()->index('client_call_actions_urgency_foreign');
            $table->unsignedBigInteger('assign_status')->nullable()->index('client_call_actions_assign_status_foreign');
            $table->unsignedBigInteger('call_status')->nullable()->index('client_call_actions_call_status_foreign');
            $table->unsignedBigInteger('caller_type')->nullable()->index('client_call_actions_caller_type_foreign');

            $table->index(['action_type', 'action_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_call_actions');
    }
};
