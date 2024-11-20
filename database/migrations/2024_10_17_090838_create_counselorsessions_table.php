<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounselorSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counselor_sessions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('counselor_id')->constrained('counselors')->onDelete('cascade'); // Foreign key to counselors table
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // Foreign key to students table
            $table->foreignId('institute_id')->constrained('institutes')->onDelete('cascade'); // Foreign key to institutes table
            $table->timestamp('session_date'); // Date and time of the session
            $table->text('session_notes')->nullable(); // Notes about the session
            $table->string('session_type'); // e.g., one-on-one, group
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counselor_sessions');
    }
}
