<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name'); // Add the owner's name
            $table->string('pet_name'); // Add the pet's name
            $table->date('booking_date'); // Add the booking date
            $table->decimal('amount', 8, 2); // Add the amount, allowing up to 8 digits with 2 decimal places
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');
            $table->string('type'); // hostel, daycare, grooming
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
