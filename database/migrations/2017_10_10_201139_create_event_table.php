<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('event', function (Blueprint $table) {
           $table->increments('id');
           $table->string('nama')->nullable();
           $table->string('jenis')->nullable();
           $table->string('tingkat')->nullable();
           $table->bigInteger('lokasi');
           $table->integer('tahun');
           $table->date('expired')->nullable();
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
        Schema::dropIfExists('event');
    }
}
