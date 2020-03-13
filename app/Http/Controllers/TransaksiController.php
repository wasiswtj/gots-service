<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use App\Services\TransaksiService;

class TransaksiController extends Controller
{
    /**
     * Instantiate a new TransaksiController instance.
     *
     * @return void
     */
    public function __construct()
    { 
        if (Auth::guard('api')->check()) {
            $this->middleware('auth:api');
            return;
        }

        $this->middleware('auth:api-penaksir');
    }

    public function getTransaksiBerjalan(Request $request, TransaksiService $transaksiService) {
        // Get data user
        $user = Auth::guard('api')->user();

        // Mendapatkan pengajuan perhiasan menunggu konfirmasi
        $dataTransaksi = $transaksiService->getTransaksiBerjalan($user['no_cif'], '');
        if (!$dataTransaksi) {
            return response()->json($this->sendResponse('99', 'error', 'Data pengajuan tidak tersedia', ''));
        }

        return response()->json($this->sendResponse('00', 'success', 'Data pengajuan berhasil diambil', $dataTransaksi));
    }

    public function getSingleTransaksiBerjalan(Request $request, TransaksiService $transaksiService, $id) {
        // Get data user
        $user = Auth::guard('api')->user();

        // Mendapatkan pengajuan perhiasan menunggu konfirmasi
        $dataTransaksi = $transaksiService->getTransaksiBerjalan($user['no_cif'], $id);
        if (!$dataTransaksi) {
            return response()->json($this->sendResponse('99', 'error', 'Data pengajuan tidak tersedia', ''));
        }

        return response()->json($this->sendResponse('00', 'success', 'Data pengajuan berhasil diambil', $dataTransaksi));
    }

    public function getRiwayat(Request $request, TransaksiService $transaksiService) {
        // Get data user
        $user = Auth::guard('api')->user();

        // Mendapatkan riwayat transaksi
        $dataRiwayat = $transaksiService->getRiwayat($user['no_cif'], '');
        if (count($dataRiwayat)==0) {
            return response()->json($this->sendResponse('99', 'error', 'Data riwayat tidak tersedia', ''));
        }

        return response()->json($this->sendResponse('00', 'success', 'Data riwayat berhasil diambil', $dataRiwayat));
    }

    public function getSingleRiwayat(Request $request, TransaksiService $transaksiService, $id) {
        // Get data user
        $user = Auth::guard('api')->user();

        // Mendapatkan riwayat transaksi
        $dataRiwayat = $transaksiService->getRiwayat($user['no_cif'], $id);
        if (!$dataRiwayat) {
            return response()->json($this->sendResponse('99', 'error', 'Data riwayat tidak tersedia', ''));
        }

        return response()->json($this->sendResponse('00', 'success', 'Data riwayat berhasil diambil', $dataRiwayat));
    }
}
