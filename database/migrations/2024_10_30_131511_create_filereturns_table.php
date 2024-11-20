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
            $table->id();
            $table->foreignId('counselor_id')->constrained('users')->onDelete('cascade'); // Link to user table for the counselor
            $table->string('travel_date');
            $table->string('travel_location');
            $table->string('description')->nullable();
            $table->json('screenshots'); // Store screenshots as JSON paths
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending'); // Return status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filereturns');
    }
};
