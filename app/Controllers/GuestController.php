<?php

namespace App\Controllers;

// TAMBAHKAN DUA BARIS INI
use App\Models\KelasModel;
use App\Models\TugasModel;

class Guest extends BaseController
{
    public function access()
    {
        $kelasModel = new KelasModel();
        $pin = $this->request->getPost('pin_kelas');

        $kelas = $kelasModel->where('pin_kelas', $pin)->first();

        if ($kelas) {
            return redirect()->to('guest/view/' . $kelas['id']);
        }

        return redirect()->to('/#guest')->with('error', 'PIN Kelas tidak ditemukan.');
    }

    public function view($kelas_id)
    {
        // Sekarang PHP tahu di mana menemukan KelasModel dan TugasModel
        $kelasModel = new KelasModel();
        $tugasModel = new TugasModel();

        $kelas = $kelasModel->find($kelas_id);
        if (!$kelas) {
            return redirect()->to('/')->with('error', 'Kelas tidak valid.');
        }

        $data = [
            'kelas' => $kelas,
            'tugas' => $tugasModel->where('kelas_id', $kelas_id)
                ->where('status !=', 'Selesai')
                ->findAll(),
            'title' => 'Daftar Tugas Kelas: ' . esc($kelas['nama_kelas']),
            'is_finished_page' => true // Ini akan menyembunyikan kolom Aksi
        ];

        // Menggunakan kembali view list.php, tapi akan pakai layout dashboard
        // Untuk tampilan lebih sederhana, kita bisa buat view khusus.
        // Untuk sekarang, kita coba pakai view `auth/guest_view` yang lebih simpel.
        return view('auth/guest_view', $data);
    }
}