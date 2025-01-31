<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('institutes')) { // Check if the table already exists
            Schema::create('institutes', function (Blueprint $table) {
                $table->id(); // bigint unsigned AUTO_INCREMENT
                $table->string('institute_name', 255)->collation('utf8mb4_unicode_ci'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
                $table->string('ins_email', 255)->collation('utf8mb4_unicode_ci')->unique(); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
                $table->string('ins_password', 255)->collation('utf8mb4_unicode_ci'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
                $table->string('ins_phone', 255)->collation('utf8mb4_unicode_ci'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
                $table->string('registration_number', 255)->collation('utf8mb4_unicode_ci')->unique(); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
                $table->string('ins_address', 255)->collation('utf8mb4_unicode_ci'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
                $table->string('website', 255)->collation('utf8mb4_unicode_ci')->nullable(); // varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
                $table->string('ins_type', 255)->collation('utf8mb4_unicode_ci'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
                $table->string('principal_name', 255)->collation('utf8mb4_unicode_ci'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
                $table->integer('establishment_year'); // int NOT NULL
                $table->integer('number_of_students'); // int NOT NULL
                $table->text('affiliations')->collation('utf8mb4_unicode_ci')->nullable(); // text COLLATE utf8mb4_unicode_ci
                $table->string('institute_logo', 255)->collation('utf8mb4_unicode_ci')->nullable(); // varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
                $table->text('remember_token')->collation('utf8mb4_unicode_ci'); // text COLLATE utf8mb4_unicode_ci NOT NULL
                $table->timestamps(); // created_at and updated_at timestamps
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('institutes')) { // Check if the table exists
            Schema::dropIfExists('institutes');
        }
    }
}
