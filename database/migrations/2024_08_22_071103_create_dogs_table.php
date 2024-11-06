<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDogsTable extends Migration
{
    public function up()
    {
        Schema::create('dogs', function (Blueprint $table) {
            $table->id();
            $table->string('ownername');
            $table->string('email');
            $table->string('dogname');
            $table->date('dogbirthday');
            $table->string('password');
            $table->text('dogdetail');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dogs');
    }
}

