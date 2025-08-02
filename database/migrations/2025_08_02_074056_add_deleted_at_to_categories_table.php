<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations: Add deleted_at column for soft deletes.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->softDeletes(); // Adds 'deleted_at' column (nullable timestamp)
        });
    }

    /**
     * Reverse the migrations: Drop the deleted_at column.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Removes 'deleted_at' column
        });
    }
};
