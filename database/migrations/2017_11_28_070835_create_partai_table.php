<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('partai', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->string('nama')->nullable();
         $table->string('alamat')->nullable();
         $table->string('no_telpon')->nullable();
         $table->string('email')->nullable();
         $table->string('list_event_id')->nullable();
         $table->string('list_dapil_id')->nullable();
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
        Schema::dropIfExists('partai');
    }
}
