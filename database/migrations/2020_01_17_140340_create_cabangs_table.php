<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_outlet');
            $table->string('nama_outlet');
            $table->string('alamat');
            $table->string('telepon');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('nama_kelurahan');
            $table->string('nama_kecamatan');
            $table->string('nama_kabupaten');
            $table->string('nama_provinsi');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });

        // seeding table
        DB::table('cabangs')->insert(
            ['kode_outlet' => '12435', 'nama_outlet' => 'CP KALIMALANG', 'alamat' => 'PERTOKOAN SUMBER ARTA B.III NO.1-2', 'telepon' => '02186905805', 'latitude' => '-6.249', 'longitude' => '106.944', 'nama_kelurahan' => 'BINTARA JAYA', 'nama_kecamatan' => 'BEKASI BARAT', 'nama_kabupaten' => 'BEKASI', 'nama_provinsi' => 'JAWA BARAT']
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabangs');
    }
}
