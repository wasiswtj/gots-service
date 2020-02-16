<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHpsPerhiasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hps_perhiasans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis_perhiasan');
            $table->string('kadar');
            $table->double('harga_per_gram', 12, 2);
            $table->date('created_at');
            $table->date('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hps_perhiasans');
    }
}
