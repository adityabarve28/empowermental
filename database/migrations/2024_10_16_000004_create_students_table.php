<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('students')) { // Check if the table exists before creating it
            Schema::create('students', function (Blueprint $table) {
                $table->id(); // bigint unsigned AUTO_INCREMENT
                $table->unsignedBigInteger('user_id'); // bigint unsigned NOT NULL
                $table->text('name')->collation('utf8mb4_unicode_ci'); // text COLLATE utf8mb4_unicode_ci NOT NULL
                $table->text('email')->collation('utf8mb4_unicode_ci'); // text COLLATE utf8mb4_unicode_ci NOT NULL
                $table->text('password')->collation('utf8mb4_unicode_ci'); // text COLLATE utf8mb4_unicode_ci NOT NULL
                $table->unsignedBigInteger('institute_id'); // bigint unsigned NOT NULL
                $table->integer('is_account_manager')->nullable(); // int DEFAULT NULL
                $table->date('dob'); // date NOT NULL
                $table->string('gender', 255)->collation('utf8mb4_unicode_ci'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
                $table->string('phone', 255)->collation('utf8mb4_unicode_ci')->nullable(); // varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
                $table->string('address', 255)->collation('utf8mb4_unicode_ci')->nullable(); // varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
                $table->unsignedInteger('year_of_study'); // int unsigned NOT NULL
                $table->timestamps(); // created_at and updated_at timestamps

                // Indexes and foreign key constraints
                $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade'); // FOREIGN KEY (institute_id) REFERENCES institutes(id) ON DELETE CASCADE
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // FOREIGN KEY (user_id) REFERENCES users(id)
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('students')) { // Check if the table exists
            Schema::dropIfExists('students');
        }
    }
}
