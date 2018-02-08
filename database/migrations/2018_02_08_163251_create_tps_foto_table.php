<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTpsFotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tps_foto', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('tps_id')->nullable();
          $table->bigInteger('event_id')->nullable();
          $table->text('foto')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tps_foto');
    }
}
