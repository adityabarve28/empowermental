<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id(); // bigint unsigned AUTO_INCREMENT
            $table->unsignedBigInteger('student_id')->nullable(); // bigint unsigned DEFAULT NULL
            $table->unsignedBigInteger('counselor_id')->nullable(); // bigint unsigned DEFAULT NULL
            $table->unsignedBigInteger('institute_id')->nullable(); // bigint unsigned DEFAULT NULL
            $table->text('report_details')->collation('utf8mb4_unicode_ci'); // text COLLATE utf8mb4_unicode_ci NOT NULL
            $table->timestamp('created_at')->nullable(); // timestamp NULL DEFAULT NULL
            $table->timestamp('updated_at')->nullable(); // timestamp NULL DEFAULT NULL

            // Foreign key constraints
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade'); // FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
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
        Schema::dropIfExists('reports');
    }
}
