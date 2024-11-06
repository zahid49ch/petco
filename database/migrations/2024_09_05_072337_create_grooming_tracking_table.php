<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroomingTrackingTable extends Migration
{
    public function up()
    {
        Schema::create('grooming_tracking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id'); // Use owner_id
            $table->foreign('owner_id')->references('id')->on('dogs'); // Set foreign key constraint
            $table->string('step');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grooming_tracking');
    }
}
