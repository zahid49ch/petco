<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('owner_name'); // Column for the owner's name
            $table->string('email')->unique(); // Column for email, with unique constraint
            $table->string('pet_name'); // Column for pet's name
            $table->string('phone_no'); // Column for phone number
            $table->date('indate'); // Column for reservation start date
            $table->date('outdate'); // Column for reservation end date
            $table->string('pet_behavior'); // Column for pet's behavior
            $table->string('payment_status'); // Column for payment status
            $table->text('package_details'); // Column for additional package details
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
