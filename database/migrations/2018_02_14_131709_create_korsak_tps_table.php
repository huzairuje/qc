<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKorsakTpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('korsak_tps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            // $table->bigInteger('tps_id')->nullable();
            $table->json('tps_id')->nullable();
            $table->bigInteger('kelurahan_id')->nullable();
            $table->string('alamat')->nullable();
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
        Schema::dropIfExists('korsak_tps');
    }
}
