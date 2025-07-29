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
        Schema::create('coupons', function (Blueprint $table) {
             $table->id();
    $table->string('code')->unique();
    $table->enum('type', ['percentage', 'fixed']);
    $table->decimal('value', 10, 2);
    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();
    $table->boolean('active')->default(true);
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
