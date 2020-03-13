<?php
namespace App\Services;

use App\Transaksi;
  
class TransaksiService
{
    public function getTransaksiBerjalan($noCif, $id)
    {
        if ($id != '') {
            $query = Transaksi::getSingleTransaksiBerjalan($noCif, $id);
            return $query;
        }

        $query = Transaksi::getTransaksiBerjalan($noCif);
        return $query;
    }

    public function getRiwayat($noCif, $id)
    {
        if ($id != '') {
            $query = Transaksi::getSingleRiwayat($noCif, $id);
            return $query;
        }

        $query = Transaksi::getRiwayat($noCif);
        return $query;
    }
}