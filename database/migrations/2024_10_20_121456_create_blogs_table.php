<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('therapist_id'); // reference to the counselor or therapist creating the blog
            $table->string('title');
            $table->string('sub_title')->nullable(); // subtitle is optional
            $table->text('content'); // blog content
            $table->timestamps();

            // Foreign key to link to the therapist/user table (assumes therapist_id references 'id' in 'users')
            $table->foreign('therapist_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}