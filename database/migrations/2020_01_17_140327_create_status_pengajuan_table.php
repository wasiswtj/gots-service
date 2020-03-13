<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_pengajuan', function (Blueprint $table) {
            $table->integer('id_status');
            $table->string('status');
        });

        // seeding table
        DB::table('status_pengajuan')->insert([
            ['id_status' => 0, 'status' => 'Ditolak'],
            ['id_status' => 1, 'status' => 'Menunggu Konfirmasi'],
            ['id_status' => 2,'status' => 'Dikonfirmasi'],
            ['id_status' => 3,'status' => 'Menuju Lokasi'],
            ['id_status' => 4,'status' => 'Penaksir Tiba'],
            ['id_status' => 5,'status' => 'Disetujui'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_pengajuan');
    }
}
