<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEventTable extends Migration
{
    public function up()
    {
         Schema::create('user_event', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('event_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_event');
    }
}
