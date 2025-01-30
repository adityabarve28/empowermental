<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('to_id')->nullable(false); // Recipient ID
            $table->string('to_name')->nullable(false); // Recipient Name
            $table->text('feedback')->nullable(false); // Feedback content
            $table->unsignedBigInteger('user_id')->nullable(false); // User submitting the feedback

            $table->timestamps(); // created_at and updated_at

            // Foreign key constraint for user_id (assuming users table exists)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
