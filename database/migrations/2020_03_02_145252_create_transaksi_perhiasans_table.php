<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPerhiasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_perhiasans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_transaksi');
            $table->string('no_cif');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_pengajuan_perhiasan');
            $table->double('jumlah_pinjaman', 12,2);
            $table->double('biaya_administrasi', 12,2);
            $table->double('biaya_asuransi', 12,2);
            $table->double('biaya_perjalanan', 12,2);
            $table->double('jumlah_diterima', 12,2);
            $table->enum('status_transaksi', ['pencairan dana', 'aktif', 'lunas', 'perpanjang', 'lelang', 'selesai']);
            $table->timestamp('tanggal_gadai')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('masa_gadai')->nullable();
            $table->integer('masa_perpanjang')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->double('biaya_sewa_modal', 12,2)->nullable();
            $table->integer('total_hari_sewa_modal')->nullable();
            $table->date('tanggal_pelunasan')->nullable();
            $table->date('tanggal_lelang')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('pemilik_rek')->nullable();
            $table->string('no_rek')->nullable();
            $table->unsignedBigInteger('id_sbk')->nullable();
            $table->unsignedBigInteger('id_struk')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();

            // foreign key
            $table->foreign('id_pengajuan_perhiasan')->references('id')->on('pengajuan_perhiasans');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_sbk')->references('id')->on('surat_bukti_kredits');
            $table->foreign('id_struk')->references('id')->on('struks');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_perhiasans');
    }
}
