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
        Schema::table('leads', function (Blueprint $table) {
            $table->string('product_type')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('product_image')->nullable();
            $table->string('brand')->nullable();
            $table->boolean('terms')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn([
                'product_type',
                'whatsapp',
                'facebook_link',
                'instagram_link',
                'product_image',
                'brand',
                'terms'
            ]);
        });
    }
};
