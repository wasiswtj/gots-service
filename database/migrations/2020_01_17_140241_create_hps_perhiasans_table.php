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
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });

        // seeding table
        DB::table('hps_perhiasans')->insert([
            ['jenis_perhiasan' => 'cincin', 'kadar' => '22', 'harga_per_gram' => 734000],
            ['jenis_perhiasan' => 'kalung', 'kadar' => '22', 'harga_per_gram' => 700000],
            ['jenis_perhiasan' => 'gelang', 'kadar' => '22', 'harga_per_gram' => 720000],
            ['jenis_perhiasan' => 'liontin', 'kadar' => '22', 'harga_per_gram' => 844000],
            ['jenis_perhiasan' => 'anting', 'kadar' => '22', 'harga_per_gram' => 744000]
        ]);
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
