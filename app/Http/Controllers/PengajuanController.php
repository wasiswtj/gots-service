<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use App\Services\PengajuanService;

class PengajuanController extends Controller
{
    /**
     * Instantiate a new PengajuanController instance.
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

    public function pengajuanPerhiasan(Request $request, PengajuanService $pengajuanService)
    {
        $validator = Validator::make($request->all(), [
            'jenis_perhiasan' => 'required',
            'kadar' => 'required',
            'berat_kotor' => 'required',
            'berat_bersih' => 'required',
            'keterangan_barang' => 'required',
            'foto_perhiasan' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($this->sendResponse('99', 'error', $validator->errors(), ''), 422);
        }
        
        // Get user Data
        $user = Auth::guard('api')->user();

        // Get post data
        $data = $request->all();

        // Mendapatkan harga HPS
        $hps = $pengajuanService->getHpsPerhiasan($data['jenis_perhiasan'], $data['kadar']);
        if (!$hps) {
            return response()->json($this->sendResponse('99', 'error', 'Gagal mengambil data hps.', ''));
        }

        // Menginsert row tabel pengajuan perhiasan, mengisi perkiraan harga sesuai hps
        $query = $pengajuanService->insertPengajuanPerhiasan($user, $data, $hps);
        if (!$query) {
            return response()->json($this->sendResponse('99', 'error', 'Terjadi kesalahan. Mohon coba lagi.', ''));
        }

        return response()->json($this->sendResponse('00', 'success', 'Pengajuan berhasil.', ''));
    }

    public function getPengajuanPerhiasanUnconfirmed(Request $request, PengajuanService $pengajuanService) {
        // Get data user
        $user = Auth::guard('api')->user();

        // Mendapatkan pengajuan perhiasan menunggu konfirmasi
        $dataPengajuan = $pengajuanService->getPengajuanPerhiasanUnconfirmed($user['no_cif']);
        if (!$dataPengajuan) {
            return response()->json($this->sendResponse('99', 'error', 'Data pengajuan tidak tersedia', ''));
        }

        return response()->json($this->sendResponse('00', 'success', 'Data pengajuan berhasil diambil', $dataPengajuan));
    }

    public function getStatusPengajuan(Request $request, PengajuanService $pengajuanService) {
        // Get data user
        $user = Auth::guard('api')->user();

        // Mendapatkan pengajuan perhiasan menunggu konfirmasi
        $dataPengajuan = $pengajuanService->getStatusPengajuan($user['no_cif']);
        if (!$dataPengajuan) {
            return response()->json($this->sendResponse('99', 'error', 'Data pengajuan tidak tersedia', ''));
        }

        return response()->json($this->sendResponse('00', 'success', 'Data pengajuan berhasil diambil', $dataPengajuan));
    }

    public function konfirmasiPengajuan(Request $request, PengajuanService $pengajuanService) {
        $validator = Validator::make($request->all(), [
            'no_pengajuan' => 'required|numeric',
            'kode_pengajuan' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($this->sendResponse('99', 'error', $validator->errors(), ''));
        }
        
        // Get data penaksir
        $penaksir = Auth::guard('api-penaksir')->user();

        // Get post data
        $data = $request->all();
        
        $kodePengajuan = $data['kode_pengajuan'];
        if($kodePengajuan == 1) {
            $konfirmasiPengajuan = $pengajuanService->konfirmasiPengajuanPerhiasan($data['no_pengajuan'], $penaksir['id']);
        }

        return response()->json($this->sendResponse('00', 'success', 'Konfirmasi pengajuan perhiasan berhasil', ''));
    }

    public function konfirmasiMenujuLokasi(Request $request, PengajuanService $pengajuanService) {
        $validator = Validator::make($request->all(), [
            'no_pengajuan' => 'required|numeric',
            'kode_pengajuan' => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return response()->json($this->sendResponse('99', 'error', $validator->errors(), ''));
        }
        
        // Get data penaksir
        $penaksir = Auth::guard('api-penaksir')->user();

        // Get post data
        $data = $request->all();
        
        $kodePengajuan = $data['kode_pengajuan'];
        if($kodePengajuan == 1) {
            $konfirmasiPengajuan = $pengajuanService->konfirmasiMenujuLokasi($data['no_pengajuan'], $penaksir['id']);
        }

        return response()->json($this->sendResponse('00', 'success', 'Konfirmasi menuju lokasi  berhasil', ''));
    }

    public function konfirmasiPenaksirTiba(Request $request, PengajuanService $pengajuanService) {
        $validator = Validator::make($request->all(), [
            'no_pengajuan' => 'required|numeric',
            'kode_pengajuan' => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return response()->json($this->sendResponse('99', 'error', $validator->errors(), ''));
        }
        
        // Get data penaksir
        $penaksir = Auth::guard('api-penaksir')->user();

        // Get post data
        $data = $request->all();
        
        $kodePengajuan = $data['kode_pengajuan'];
        if($kodePengajuan == 1) {
            $konfirmasiPengajuan = $pengajuanService->konfirmasiPenaksirTiba($data['no_pengajuan'], $penaksir['id']);
        }

        return response()->json($this->sendResponse('00', 'success', 'Konfirmasi penaksir tiba berhasil', ''));
    }
}
