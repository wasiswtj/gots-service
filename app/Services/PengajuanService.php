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

    public function validasiMinimalGadai($beratBersih, $hargaPerGram)
    {
        $perkiraanHarga = ceil($beratBersih * $hargaPerGram);
        if ($perkiraanHarga > 20000000) {
            return true;
        }

        return false;
    }

    public function insertPengajuanPerhiasan($user, $data, $hps)
    {
        $datas = [
            'no_pengajuan' => $data['no_pengajuan'],
            'tanggal_pengajuan' => date('Y-m-d H:i:s'),
            'id_user' => $user['id'],
            'no_cif' => $user['no_cif'],
            'jenis_perhiasan' => $data['jenis_perhiasan'],
            'kadar' => $data['kadar'],
            'berat_kotor' => $data['berat_kotor'],
            'berat_bersih' => $data['berat_bersih'],
            'alamat' => $data['alamat'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'keterangan_barang' => $data['keterangan_barang'],
            'foto_perhiasan' => $data['foto_perhiasan'],
            'perkiraan_harga' => ceil($data['berat_bersih'] * $hps->harga_per_gram),
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

    public function getPerkiraanHargaPerhiasan($data)
    {
        $hps = $this->getHpsPerhiasan($data['jenis_perhiasan'], $data['kadar']);
        $result = [
            'perkiraan_harga' =>  ceil($data['berat_bersih'] * $hps->harga_per_gram)
        ];
        return $result;
    }

    public function getStatusPengajuan($noCif)
    {
        $query = Pengajuan::getStatusPengajuan($noCif);
        return $query;
    }

    public function getEstimasiJarak($lat1, $lon1, $lat2, $lon2)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $km = $dist * 60 * 1.1515 * 1.609344;

        return $km;
    }

    public function getEstimasiPerjalanan($estimasiJarak)
    {
        // perkiraan perjalanan 5 menit untuk 1 km
        return Ceil($estimasiJarak * 5);
    }

    public function validasiJarak($latitude, $longitude)
    {
        $cabangs = $this->getAllCabang();
        foreach ($cabangs as $cabang) {
            $jarak = $this->getEstimasiJarak($latitude, $longitude, $cabang->latitude, $cabang->longitude);
            if ($jarak <5) {
                return true;
            }
        }
        return false;
    }

    public function getAllCabang()
    {
        $cabangs = Pengajuan::getAllCabang();
        return $cabangs;
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
