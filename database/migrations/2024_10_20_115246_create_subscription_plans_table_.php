<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id(); // bigint unsigned AUTO_INCREMENT
            $table->string('name'); // varchar(255) NOT NULL
            $table->decimal('price', 8, 2); // decimal(8,2) NOT NULL
            $table->string('duration')->default('monthly'); // varchar(255) with a default value of 'monthly'
            $table->text('features'); // text NOT NULL
            $table->integer('sessions_approved'); // int NOT NULL
            $table->decimal('discount', 8, 2)->nullable(); // decimal(8,2) for discount, can be NULL
            $table->timestamps(); // created_at and updated_at as timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if (Schema::hasTable('subscription_plans')) { // Check if the table exists
            Schema::dropIfExists('subscription_plans');
        }
    }
}
