<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('approval', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('user_id')->nullable();
          $table->bigInteger('event_id')->nullable();
          $table->bigInteger('kelurahan_id')->nullable();
          $table->bigInteger('tps_id')->nullable();
          $table->boolean('is_approved')->default('false');
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
        Schema::dropIfExists('approval');
    }
}
