<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();
            $table->string('institute_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->string('registration_number')->unique();
            $table->string('address');
            $table->string('website')->nullable();
            $table->string('type');
            $table->string('principal_name');
            $table->integer('establishment_year');
            $table->integer('number_of_students');
            $table->text('affiliations')->nullable();
            $table->string('logo')->nullable();
            $table->text('mission_statement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institutes');
    }
}