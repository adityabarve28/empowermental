<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->id(); // bigint unsigned AUTO_INCREMENT
            $table->string('title'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
            $table->text('description')->collation('utf8mb4_unicode_ci'); // text COLLATE utf8mb4_unicode_ci NOT NULL
            $table->date('date'); // date NOT NULL
            $table->unsignedBigInteger('institute_id')->nullable(); // bigint unsigned DEFAULT NULL
            $table->unsignedBigInteger('counselor_id')->nullable(); // bigint unsigned DEFAULT NULL
            $table->timestamps(); // created_at, updated_at as timestamps

            // Foreign key constraints
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade'); // FOREIGN KEY (institute_id) REFERENCES institutes(id) ON DELETE CASCADE
            $table->foreign('counselor_id')->references('id')->on('counselors')->onDelete('cascade'); // FOREIGN KEY (counselor_id) REFERENCES counselors(id) ON DELETE CASCADE
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if (Schema::hasTable('workshops')) { // Check if the table exists
            Schema::dropIfExists('workshops');
        }
    }
}
