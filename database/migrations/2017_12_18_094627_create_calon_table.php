<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('calon', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->bigInteger('dapil_id');
        $table->boolean('tipe')->default(0);
        $table->bigInteger('partai_id')->nullable();
        $table->bigInteger('nomor')->nullable();
        $table->string('nama')->nullable();
        $table->boolean('has_wakil')->default(0);
        $table->string('alamat')->nullable();
        $table->string('no_telpon')->nullable();
        $table->string('email')->nullable();
        $table->string('foto')->nullable();
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
        //
    }
}
