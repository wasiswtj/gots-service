<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanPerhiasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_perhiasans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_pengajuan');
            $table->string('no_cif');
            $table->string('jenis_perhiasan');
            $table->string('kadar');
            $table->double('berat_kotor', 8,4);
            $table->double('berat_bersih', 8,4);
            $table->double('perkiraan_harga', 12,2);
            $table->double('harga_taksir',12,2)->nullable();
            $table->string('id_hps');
            $table->string('keterangan_barang');
            $table->string('titik_gadai')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->text('foto_perhiasan');
            $table->string('id_status');
            $table->string('id_penaksir')->nullable();
            $table->string('is_complete')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_perhiasans');
    }
}
