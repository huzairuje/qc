<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDapilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dapil', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('id_event');
          $table->string('nama')->nullable();
          $table->string('provinsi_id')->nullable();
          $table->string('list_kota_kabupaten')->nullable();
          $table->string('kecamatan_id')->nullable();
          $table->string('kelurahan_id')->nullable();
          $table->string('tps_id')->nullable();
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
        Schema::dropIfExists('dapil');
    }
}
