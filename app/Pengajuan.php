<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengajuan extends Model
{
    protected $table = 'pengajuan_perhiasans';

    public static function insertPengajuanPerhiasan($data) {
        $query = DB::table('pengajuan_perhiasans')->insert($data);
        return $query;
    }

    public static function getHpsPerhiasan($jenisPerhiasan, $kadar) {
        $hps = DB::table('hps_perhiasans')
            ->where('jenis_perhiasan', 'like', $jenisPerhiasan)
            ->where('kadar', 'like', $kadar)
            ->latest('id')
            ->first();
        
        return $hps;
    }

    public static function getPengajuanPerhiasan($noCif, $idStatus, $isComplete) {
        $query = DB::table('pengajuan_perhiasans')
            ->where('no_cif', $noCif)
            ->where('id_status', $idStatus)
            ->where('is_complete', $isComplete)
            ->get()
            ->first();

        return $query;
    }

    public static function getStatusPengajuan($noCif) {
        $query = DB::table('pengajuan_perhiasans')
            ->join('status_pengajuan', 'pengajuan_perhiasans.id_status', '=', 'status_pengajuan.id_status')
            ->where('no_cif', $noCif)
            ->where('is_complete', 0)
            ->get()
            ->first();

        return $query;
    }

    public static function konfirmasiPengajuanPerhiasan($no_pengajuan, $id_penaksir) {
        $query = DB::table('pengajuan_perhiasans')
            ->where('no_pengajuan', $no_pengajuan)
            ->update([
                'id_penaksir' => $id_penaksir,
                'id_status' => 2
            ]);

        return $query;
    }

    public static function konfirmasiMenujuLokasi($no_pengajuan, $id_penaksir) {
        $query = DB::table('pengajuan_perhiasans')
            ->where('no_pengajuan', $no_pengajuan)
            ->update([
                'id_penaksir' => $id_penaksir,
                'id_status' => 3
            ]);

        return $query;
    }

    public static function konfirmasiPenaksirTiba($no_pengajuan, $id_penaksir) {
        $query = DB::table('pengajuan_perhiasans')
            ->where('no_pengajuan', $no_pengajuan)
            ->update([
                'id_penaksir' => $id_penaksir,
                'id_status' => 4
            ]);

        return $query;
    }

    public static function updateStatusPengajuanPerhiasan($no_pengajuan, $status) {
        $query = DB::table('pengajuan_perhiasans')
            ->where('no_pengajuan', $no_pengajuan)
            ->get()
            ->first();

        return $query;
    }
}