<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPenaksirs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_penaksirs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('no_nik')->unique()->notNullable();
            $table->string('password');
            $table->string('id_cabang');
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
        Schema::dropIfExists('user_penaksirs');
    }
}
