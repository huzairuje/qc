<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tps', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('no_tps');
          $table->string('nama_tps');
          $table->string('calon')->nullable();
          $table->string('provinsi_id')->nullable();
          $table->string('kota_kabupaten_id')->nullable();
          $table->string('kecamatan_id')->nullable();
          $table->string('kelurahan_id')->nullable();
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
        Schema::dropIfExists('tps');
    }
}
