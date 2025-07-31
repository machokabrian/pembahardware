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
            $table->id(); // Primary key

            $table->string('name')->comment('Product name');
            $table->string('slug')->unique()->comment('SEO-friendly URL identifier');

            $table->text('description')->nullable()->comment('Detailed product description');

            $table->decimal('price', 10, 2)->comment('Selling price in Ksh');
            $table->decimal('cost_price', 10, 2)->nullable()->comment('Cost price for internal tracking');

            $table->unsignedBigInteger('category_id')->comment('Foreign key to categories table');
            $table->unsignedBigInteger('supplier_id')->nullable()->comment('Foreign key to suppliers table');

            $table->integer('stock_quantity')->default(0)->comment('Available stock quantity');
            $table->string('sku')->unique()->nullable()->comment('Stock Keeping Unit for inventory tracking');

            $table->string('unit')->nullable()->comment('Measurement unit (e.g., piece, kg, litre)');
            $table->decimal('weight', 8, 2)->nullable()->comment('Weight for shipping calculations');

            $table->string('thumbnail')->nullable()->comment('Main product image URL or path');

            $table->boolean('is_featured')->default(false)->comment('Featured product flag');
            $table->boolean('is_active')->default(true)->comment('Product availability status');

            $table->timestamps(); // created_at and updated_at

            // Foreign key constraints
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');

            $table->foreign('supplier_id')
                ->references('id')->on('suppliers')
                ->onDelete('set null');

            // Indexes for faster queries on frequently searched columns
            $table->index('price');
            $table->index('stock_quantity');
            $table->index('is_active');
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
