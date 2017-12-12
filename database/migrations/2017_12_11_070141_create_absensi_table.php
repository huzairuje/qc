<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('absensi', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->bigInteger('user_id')->nullable();
         $table->boolean('status')->default('false');
         $table->string('alasan')->nullable();
         $table->bigInteger('user_replacement_id')->nullable();
         $table->timestamps();
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
