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
        Schema::create('price_logs', function (Blueprint $table) {
             $table->id();
    $table->foreignId('product_id')->constrained()->onDelete('cascade');
    $table->decimal('old_price', 10, 2);
    $table->decimal('new_price', 10, 2);
    $table->timestamp('changed_at')->useCurrent();
    $table->foreignId('changed_by')->nullable()->constrained('users')->onDelete('set null');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_logs');
    }
};
