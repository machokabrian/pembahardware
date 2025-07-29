<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->date('invoice_date')->default(now());
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2);
            $table->string('pdf_path')->nullable(); // for generated PDF invoice
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
