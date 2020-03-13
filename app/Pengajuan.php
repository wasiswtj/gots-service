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
            ->join ('users', 'pengajuan_perhiasans.id_user' , '=', 'users.id')
            ->join('status_pengajuan', 'pengajuan_perhiasans.id_status', '=', 'status_pengajuan.id_status')
            ->leftJoin('user_penaksirs', 'pengajuan_perhiasans.id_penaksir', '=', 'user_penaksirs.id')
            ->leftJoin('cabangs', 'user_penaksirs.id_cabang', '=', 'cabangs.id')
            ->where('pengajuan_perhiasans.no_cif', $noCif)
            ->where('is_complete', 0)
            ->select('pengajuan_perhiasans.*', 'status_pengajuan.*', 'user_penaksirs.name as nama_penaksir',
            'user_penaksirs.no_nik as no_nik_penaksir', 'user_penaksirs.no_handphone as no_handphone_penaksir',  
            'cabangs.alamat as alamat_cabang', 'cabangs.longitude as cabang_longitude', 'cabangs.latitude as cabang_latitude', 
            'cabangs.nama_outlet', 'cabangs.telepon as no_telepon_cabang', 'users.name as nama_nasabah')
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

    public static function getAllCabang() {
        $query = DB::table('cabangs')->get();

        return $query;
    }
}