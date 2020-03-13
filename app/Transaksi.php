<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    protected $table = 'transaksi_perhiasans';

    public static function getTransaksiBerjalan($noCif) {
        $query = DB::table('transaksi_perhiasans AS tp')
            ->join('pengajuan_perhiasans as pp', 'tp.id_pengajuan_perhiasan', '=', 'pp.id')
            ->where('tp.no_cif', $noCif)
            ->where('tp.status_transaksi', '!=', 'selesai')
            ->select('tp.id', 'tp.no_transaksi', 'pp.jenis_perhiasan', 'tp.jumlah_pinjaman', 
                'tp.status_transaksi', 'tp.tanggal_gadai', 'tp.tanggal_jatuh_tempo')
            ->get();

        return $query;
    }

    public static function getSingleTransaksiBerjalan($noCif, $id) {
        $query = DB::table('transaksi_perhiasans AS tp')
            ->join('pengajuan_perhiasans as pp', 'tp.id_pengajuan_perhiasan', '=', 'pp.id')
            ->leftJoin('struks as ss', 'tp.id_struk', '=', 'ss.id')
            ->leftJoin('surat_bukti_kredits as sbk', 'tp.id_sbk', '=', 'sbk.id')
            ->where('tp.no_cif', $noCif)
            ->where('tp.id', '=', $id)
            ->where('tp.status_transaksi', '!=', 'selesai')
            ->select('tp.*', 'pp.jenis_perhiasan', 'pp.kadar', 'pp.berat_kotor', 'pp.berat_bersih', 
                'pp.keterangan_barang', 'ss.uri as uri_struk', 'sbk.uri as uri_sbk', 'pp.foto_perhiasan')
            ->get()
            ->first();

        return $query;
    }

    public static function getRiwayat($noCif) {
        $query = DB::table('transaksi_perhiasans AS tp')
            ->join('pengajuan_perhiasans as pp', 'tp.id_pengajuan_perhiasan', '=', 'pp.id')
            ->where('tp.no_cif', $noCif)
            ->where('tp.status_transaksi', '=', 'selesai')
            ->select('tp.*', 'pp.jenis_perhiasan', 'pp.kadar', 'pp.berat_kotor', 'pp.berat_bersih', 'pp.keterangan_barang')
            ->get();

        return $query;
    }

    public static function getSingleRiwayat($noCif, $id) {
        $query = DB::table('transaksi_perhiasans AS tp')
            ->join('pengajuan_perhiasans as pp', 'tp.id_pengajuan_perhiasan', '=', 'pp.id')
            ->where('tp.no_cif', $noCif)
            ->where('tp.id', '=', $id)
            ->where('tp.status_transaksi', '=', 'selesai')
            ->select('tp.*', 'pp.jenis_perhiasan', 'pp.kadar', 'pp.berat_kotor', 'pp.berat_bersih', 'pp.keterangan_barang', 'pp.foto_perhiasan')
            ->get()
            ->first();

        return $query;
    }
}