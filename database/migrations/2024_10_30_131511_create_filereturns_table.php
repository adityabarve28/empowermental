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
        Schema::create('filereturns', function (Blueprint $table) {
            $table->id(); // bigint unsigned AUTO_INCREMENT
            $table->unsignedBigInteger('counselor_id'); // Foreign key to the users table for counselor
            $table->string('travel_date'); // varchar(255) NOT NULL
            $table->string('travel_location'); // varchar(255) NOT NULL
            $table->string('description')->nullable(); // varchar(255), optional description
            $table->json('screenshots'); // json NOT NULL for storing screenshot data
            $table->enum('status', ['pending', 'approved', 'declined', 'completed'])->default('pending'); // Enum status with default 'pending'
            $table->timestamps(); // created_at and updated_at timestamps

            // Foreign key constraint to the users table for counselor_id
            $table->foreign('counselor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('filereturns')) { // Check if the table exists
            Schema::dropIfExists('filereturns');
        }
    }
};
