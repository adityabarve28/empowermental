<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('appointments')) { // Check if the table exists before creating it
            Schema::create('appointments', function (Blueprint $table) {
                $table->id(); // bigint unsigned AUTO_INCREMENT
                $table->unsignedBigInteger('institute_id'); // bigint unsigned NOT NULL
                $table->unsignedBigInteger('counselor_id'); // bigint unsigned NOT NULL
                $table->dateTime('appointment_date'); // datetime NOT NULL
                $table->string('status', 255)->collation('utf8mb4_unicode_ci')->default('pending'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
                $table->integer('asked_to_reschedule')->default(0); // int NOT NULL DEFAULT '0'
                $table->timestamps(); // created_at and updated_at timestamps

                // Indexes and foreign key constraints
                $table->foreign('counselor_id')->references('id')->on('counselors')->onDelete('cascade'); // FOREIGN KEY (counselor_id) REFERENCES counselors(id) ON DELETE CASCADE
                $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade'); // FOREIGN KEY (institute_id) REFERENCES institutes(id) ON DELETE CASCADE
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('appointments')) { // Check if the table exists
            Schema::dropIfExists('appointments');
        }
    }
}
