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

            // Foreign key constraints
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade'); // FOREIGN KEY (institute_id) REFERENCES institutes(id) ON DELETE CASCADE
            $table->foreign('plan_id')->references('id')->on('subscription_plans')->onDelete('cascade')->onUpdate('cascade'); // FOREIGN KEY (plan_id) REFERENCES subscription_plans(id) ON DELETE CASCADE ON UPDATE CASCADE
            $table->foreign('therapist_id')->references('id')->on('counselors')->nullable(); // FOREIGN KEY (therapist_id) REFERENCES counselors(id) with NULLABLE
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
