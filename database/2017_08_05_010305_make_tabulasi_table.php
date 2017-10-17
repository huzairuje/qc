<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeTabulasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabulasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dokumen')->nullable();
            $table->string('provinsi_id')->nullable();
            $table->string('kota_kabupaten_id')->nullable();
            $table->string('kecamatan_id')->nullable();
            $table->string('kelurahan_id')->nullable();
            $table->json('data_suara')->nullable();
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
        Schema::dropIfExists('tabulasi');
    }
}
