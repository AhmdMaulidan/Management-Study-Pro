<?php

namespace App\Controllers;

use App\Models\TugasModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $tugasModel = new TugasModel();
        $kelasId = session()->get('kelasId');

        // ... (kode untuk menghitung total tugas tetap sama) ...
        $totalTugas = $tugasModel->where('kelas_id', $kelasId)->whereIn('status', ['Belum Dikerjakan', 'Sedang Dikerjakan'])->countAllResults();
        $tugasSelesai = $tugasModel->where('kelas_id', $kelasId)->where('status', 'Selesai')->countAllResults();

        // Ambil tugas terdekat
        $filter = $this->request->getGet('filter_kelas');
        $query = $tugasModel->where('kelas_id', $kelasId)
            ->where('status !=', 'Selesai')
            ->orderBy('deadline', 'ASC')
            ->limit(5);

        if ($filter && $filter != 'Semua') {
            if ($filter == 'Gabungan') {
                $query->where('kategori_kelas', 'Gabungan');
            } else {
                $query->whereIn('kategori_kelas', [$filter, 'Gabungan']);
            }
        }

        $tugasTerdekat = $query->findAll();

        // --- LOGIKA BARU: HITUNG SISA HARI ---
        $today = new \DateTime();
        foreach ($tugasTerdekat as &$tugas) { // Gunakan '&' untuk modifikasi langsung
            if (!empty($tugas['deadline'])) {
                $deadlineDate = new \DateTime($tugas['deadline']);
                $interval = $today->diff($deadlineDate);

                // Cek apakah deadline sudah lewat atau belum
                if ($interval->invert) {
                    $tugas['days_left_text'] = 'Telah Lewat';
                } elseif ($interval->days == 0) {
                    $tugas['days_left_text'] = 'Hari Ini';
                } else {
                    $tugas['days_left_text'] = $interval->days . ' Hari Lagi';
                }
            } else {
                $tugas['days_left_text'] = 'Tidak ada';
            }
        }
        // ------------------------------------

        $data = [
            'totalTugas' => $totalTugas,
            'tugasSelesai' => $tugasSelesai,
            'tugasTerdekat' => $tugasTerdekat, // Sekarang sudah ada key 'days_left_text'
            'currentFilter' => $filter
        ];

        return view('dashboard/index', $data);
    }
}