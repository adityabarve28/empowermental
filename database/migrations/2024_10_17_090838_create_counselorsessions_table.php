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
            $table->id(); // bigint unsigned AUTO_INCREMENT
            $table->unsignedBigInteger('counselor_id'); // Foreign key to counselors table
            $table->unsignedBigInteger('institute_id'); // Foreign key to institutes table
            $table->timestamp('session_date'); // timestamp NOT NULL
            $table->text('session_notes')->nullable(); // text for session notes, can be null
            $table->string('session_type'); // varchar(255) for session type (e.g., one-on-one, group)
            $table->timestamps(); // created_at, updated_at as timestamps

            // Foreign key constraints
            $table->foreign('counselor_id')->references('id')->on('counselors')->onDelete('cascade'); // FOREIGN KEY (counselor_id) REFERENCES counselors(id) ON DELETE CASCADE
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade'); // FOREIGN KEY (institute_id) REFERENCES institutes(id) ON DELETE CASCADE
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
