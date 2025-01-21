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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // bigint unsigned NOT NULL AUTO_INCREMENT
            $table->string('name'); // varchar(255) NOT NULL
            $table->string('email'); // varchar(255) NOT NULL
            $table->string('password'); // varchar(255) NOT NULL
            $table->enum('role', ['student', 'counselor', 'institute'])->default('student'); // enum NOT NULL DEFAULT 'student'
            $table->integer('is_account_manager')->nullable(); // int DEFAULT NULL
            $table->string('remember_token', 100)->nullable(); // varchar(100) DEFAULT NULL
            $table->timestamps(); // created_at and updated_at timestamps
            $table->timestamp('email_verified_at')->nullable(); // nullable email verification timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
