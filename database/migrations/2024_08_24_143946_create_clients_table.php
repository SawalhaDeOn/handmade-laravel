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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mobile')->nullable();
            $table->string('name')->nullable();
            $table->string('client_id')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('active')->nullable();
            $table->string('telephone', 100)->nullable();
            $table->unsignedBigInteger('category')->nullable()->index('clients_category_foreign');
            $table->unsignedBigInteger('city_id')->nullable()->index('clients_city_id_foreign');
            $table->unsignedBigInteger('assign_city_id')->nullable()->index('clients_assign_city_id_foreign');
            $table->unsignedBigInteger('status')->nullable()->index('clients_status_foreign');
            $table->unsignedBigInteger('call_id')->nullable()->index('clients_call_id_foreign');
            $table->unsignedBigInteger('type_id')->nullable()->index('clients_type_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
