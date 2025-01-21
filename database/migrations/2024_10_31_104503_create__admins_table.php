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
        Schema::create('_admins', function (Blueprint $table) {
            $table->id(); // Bigint unsigned AUTO_INCREMENT PRIMARY KEY
            $table->string('name'); // Name column (varchar(255))
            $table->string('email')->unique(); // Email column (varchar(255)) with unique constraint
            $table->string('password'); // Password column (varchar(255))
            $table->string('level')->nullable(); // Level column (varchar(255)) and nullable
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_admins'); // Drop the _admins table
    }
};
