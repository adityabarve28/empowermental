<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); // bigint unsigned AUTO_INCREMENT
            $table->unsignedBigInteger('therapist_id'); // Reference to therapist (user)
            $table->string('title'); // varchar(255) NOT NULL
            $table->string('sub_title')->nullable(); // varchar(255), optional subtitle
            $table->longText('content'); // longtext NOT NULL for the content of the blog
            $table->timestamps(); // created_at and updated_at timestamps

            // Foreign key to therapist (users table)
            $table->foreign('therapist_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        if (Schema::hasTable('blogs')) { // Check if the table exists
            Schema::dropIfExists('blogs');
        }
    }
}
