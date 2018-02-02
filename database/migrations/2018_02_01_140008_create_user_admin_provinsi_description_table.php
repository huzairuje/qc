<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAdminProvinsiDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('admin_provinsi', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('user_id')->nullable();
          $table->bigInteger('provinsi_id')->nullable();
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
        Schema::dropIfExists('admin_provinsi');
        
    }
}
