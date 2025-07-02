<?php

namespace App\Controllers;

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
            // Arahkan ke method view baru kita dengan ID kelas
            return redirect()->to('guest/view/' . $kelas['id']);
        }
        return redirect()->to('/#guest')->with('error', 'PIN Kelas tidak ditemukan.');
    }

    public function view($kelas_id)
    {
        $kelasModel = new KelasModel();
        $tugasModel = new TugasModel();

        $kelas = $kelasModel->find($kelas_id);
        if (!$kelas) {
            return redirect()->to('/')->with('error', 'Kelas tidak valid.');
        }

        // Ambil parameter dari URL untuk filter dan pagination
        $perPage = $this->request->getGet('perPage') ?? 5;
        $filter = $this->request->getGet('filter_kelas');

        // Bangun query dasar
        $query = $tugasModel->where('kelas_id', $kelas_id)->where('status !=', 'Selesai');

        // Terapkan filter jika ada
        if ($filter && $filter != 'Semua') {
            if ($filter == 'Gabungan') {
                $query->where('kategori_kelas', 'Gabungan');
            } else {
                $query->whereIn('kategori_kelas', [$filter, 'Gabungan']);
            }
        }

        // Eksekusi query dengan pagination
        $data['tugas'] = $query->paginate($perPage);

        // Siapkan data untuk dikirim ke view
        $data['pager'] = $tugasModel->pager;
        $data['title'] = 'Daftar Tugas: ' . esc($kelas['nama_kelas']);
        $data['is_finished_page'] = true; // PENTING: Ini akan menyembunyikan kolom "Aksi"
        $data['currentPerPage'] = $perPage;
        $data['currentFilter'] = $filter;

        // Gunakan view yang sama dengan user login
        return view('tugas/list', $data);
    }
}