<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounselorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counselors', function (Blueprint $table) {
            $table->id(); // bigint unsigned AUTO_INCREMENT
            $table->string('full_name', 255)->collation('utf8mb4_unicode_ci'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
            $table->string('email', 255)->collation('utf8mb4_unicode_ci')->unique(); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
            $table->string('license', 255)->collation('utf8mb4_unicode_ci')->unique(); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
            $table->string('password', 255)->collation('utf8mb4_unicode_ci'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
            $table->string('phone', 255)->collation('utf8mb4_unicode_ci'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
            $table->string('qualification', 255)->collation('utf8mb4_unicode_ci'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
            $table->integer('experience'); // int NOT NULL
            $table->string('specialization', 255)->collation('utf8mb4_unicode_ci'); // varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
            $table->text('address')->collation('utf8mb4_unicode_ci'); // text COLLATE utf8mb4_unicode_ci NOT NULL
            $table->text('profile_pic')->collation('utf8mb4_unicode_ci'); // text COLLATE utf8mb4_unicode_ci NOT NULL
            $table->text('about_me')->collation('utf8mb4_unicode_ci')->nullable(); // text COLLATE utf8mb4_unicode_ci
            $table->text('remember_token')->collation('utf8mb4_unicode_ci'); // text COLLATE utf8mb4_unicode_ci NOT NULL
            $table->timestamp('created_at')->nullable(); // timestamp NULL DEFAULT NULL
            $table->timestamp('updated_at')->nullable(); // timestamp NULL DEFAULT NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counselors');
    }
}
