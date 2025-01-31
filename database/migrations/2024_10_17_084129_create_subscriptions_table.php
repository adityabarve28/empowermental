<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id(); // bigint unsigned AUTO_INCREMENT
            $table->unsignedBigInteger('institute_id'); // bigint unsigned NOT NULL
            $table->unsignedBigInteger('plan_id'); // bigint unsigned NOT NULL
            $table->date('start_date')->nullable(); // date DEFAULT NULL
            $table->date('end_date')->nullable(); // date DEFAULT NULL
            $table->decimal('amount', 8, 2); // decimal(8,2) NOT NULL
            $table->integer('status')->nullable(); // int DEFAULT NULL
            $table->timestamps(); // created_at, updated_at as timestamps
            $table->unsignedBigInteger('therapist_id')->nullable(); // bigint unsigned DEFAULT NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if (Schema::hasTable('subscriptions')) { // Check if the table exists
            Schema::dropIfExists('subscriptions');
        }
    }
}
