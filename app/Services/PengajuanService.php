<?php
namespace App\Services;

use App\Pengajuan;
  
class PengajuanService
{
    public function getHpsPerhiasan($jenisPerhiasan, $kadar)
    {
        $query = Pengajuan::getHpsPerhiasan($jenisPerhiasan, $kadar);
        return $query;
    }

    public function insertPengajuanPerhiasan($user, $data, $hps)
    {
        $datas = [
            'no_pengajuan' => '9992020011800001',
            'no_cif' => $user['no_cif'],
            'jenis_perhiasan' => $data['jenis_perhiasan'],
            'kadar' => $data['kadar'],
            'berat_kotor' => $data['berat_kotor'],
            'berat_bersih' => $data['berat_bersih'],
            'keterangan_barang' => $data['keterangan_barang'],
            'foto_perhiasan' => $data['foto_perhiasan'],
            'perkiraan_harga' => $data['berat_bersih'] * $hps->harga_per_gram,
            'id_hps' => $hps->id,
            'id_status' => 1, // Default value
            'is_complete' => 0, // Default value
            'created_at' => date("Y-m-d H:i:s")
        ];
        
        $query = Pengajuan::insertPengajuanPerhiasan($datas);
        return $query;
    }

    public function getPengajuanPerhiasanUnconfirmed($noCif)
    {
        $query = Pengajuan::getPengajuanPerhiasan($noCif, 1, 0);
        return $query;
    }

    public function getStatusPengajuan($noCif)
    {
        $query = Pengajuan::getStatusPengajuan($noCif);
        return $query;
    }

    public function konfirmasiPengajuanPerhiasan($no_pengajuan, $id_penaksir)
    {
        $query = Pengajuan::konfirmasiPengajuanPerhiasan($no_pengajuan, $id_penaksir);
        return $query;
    }

    public function konfirmasiMenujuLokasi($no_pengajuan, $id_penaksir)
    {
        $query = Pengajuan::konfirmasiMenujuLokasi($no_pengajuan, $id_penaksir);
        return $query;
    }

    public function konfirmasiPenaksirTiba($no_pengajuan, $id_penaksir)
    {
        $query = Pengajuan::konfirmasiPenaksirTiba($no_pengajuan, $id_penaksir);
        return $query;
    }
}