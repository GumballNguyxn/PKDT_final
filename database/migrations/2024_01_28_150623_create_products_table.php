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
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('product_category_id');
            $table->string('name');
            $table->text('description');
            $table->text('details')->nullable();
            $table->unsignedInteger('quantity');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade') ;
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade') ;
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
