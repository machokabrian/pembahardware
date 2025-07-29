<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('Full name of the user');
            $table->string('email')->unique()->comment('User email address');
            $table->timestamp('email_verified_at')->nullable()->comment('Email verification timestamp');

            $table->string('password')->comment('Hashed password');

            $table->string('phone')->nullable()->comment('User phone number');
            $table->string('address')->nullable()->comment('User default shipping address');
            $table->string('city')->nullable()->comment('City');
            $table->string('postal_code')->nullable()->comment('Postal code');

            $table->boolean('is_admin')->default(false)->comment('Admin flag to differentiate roles');

            $table->rememberToken(); // For "remember me" login functionality
            $table->timestamps();

            $table->softDeletes(); // Enables soft deleting users (optional, recommended)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
