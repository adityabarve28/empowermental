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
        Schema::create('contactus', function (Blueprint $table) {
            $table->id(); // bigint unsigned NOT NULL AUTO_INCREMENT
            $table->string('name'); // varchar(255) NOT NULL
            $table->string('email'); // varchar(255) NOT NULL
            $table->string('message'); // varchar(255) NOT NULL
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('contactus')) { // Check if the table exists
            Schema::dropIfExists('contactus');
        }
    }
};
