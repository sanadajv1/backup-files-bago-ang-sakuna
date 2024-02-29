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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->string('category')->nullable();
            $table->string('category_id')->nullable();
            $table->string('product_description')->nullable();
            $table->string('small_price')->nullable();
            $table->string('medium_price')->nullable();
            $table->string('large_price')->nullable();
            $table->string('small_size')->nullable();
            $table->string('medium_size')->nullable();
            $table->string('large_size')->nullable();
            $table->string('processing_time')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
