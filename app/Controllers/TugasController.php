<?php

namespace App\Controllers;

use App\Models\TugasModel;

class TugasController extends BaseController
{
    protected $tugasModel;

    public function __construct()
    {
        $this->tugasModel = new TugasModel();
    }

    public function new()
    {
        return view('tugas/new');
    }

    public function create()
    {
        $rules = [
            'nama_tugas' => 'required',
            'kategori_kelas' => 'required',
            'deadline' => 'required|valid_date',
            'status' => 'required',
            'file' => 'max_size[file,2048]|ext_in[file,jpg,jpeg,png,pdf,docx,zip]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('file');
        $filePath = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $filePath = $newName;
        }

        $this->tugasModel->save([
            'kelas_id' => session()->get('kelasId'),
            'nama_tugas' => $this->request->getPost('nama_tugas'),
            'kategori_kelas' => $this->request->getPost('kategori_kelas'),
            'deadline' => $this->request->getPost('deadline'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),
            'file_path' => $filePath
        ]);

        return redirect()->to('/tugas/daftar')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function listUnfinished()
    {
        $perPage = $this->request->getGet('perPage') ?? 5;
        $filter = $this->request->getGet('filter_kelas');

        $query = $this->tugasModel
            ->where('kelas_id', session()->get('kelasId'))
            ->where('status !=', 'Selesai');

        if ($filter && $filter != 'Semua') {
            if ($filter == 'Gabungan') {
                $query->where('kategori_kelas', 'Gabungan');
            } else {
                $query->whereIn('kategori_kelas', [$filter, 'Gabungan']);
            }
        }

        $data['tugas'] = $query->paginate($perPage);
        $data['pager'] = $this->tugasModel->pager;
        $data['title'] = 'Daftar Tugas';
        $data['is_finished_page'] = false;
        $data['currentPerPage'] = $perPage;
        $data['currentFilter'] = $filter;

        return view('tugas/list', $data);
    }

    public function listFinished()
    {
        $perPage = $this->request->getGet('perPage') ?? 5;
        $filter = $this->request->getGet('filter_kelas');

        $query = $this->tugasModel
            ->where('kelas_id', session()->get('kelasId'))
            ->where('status', 'Selesai');

        if ($filter && $filter != 'Semua') {
            if ($filter == 'Gabungan') {
                $query->where('kategori_kelas', 'Gabungan');
            } else {
                $query->whereIn('kategori_kelas', [$filter, 'Gabungan']);
            }
        }

        $data['tugas'] = $query->paginate($perPage);
        $data['pager'] = $this->tugasModel->pager;
        $data['title'] = 'Tugas Selesai';
        $data['is_finished_page'] = true;
        $data['currentPerPage'] = $perPage;
        $data['currentFilter'] = $filter;

        return view('tugas/list', $data);
    }

    public function edit($id)
    {
        $data['tugas'] = $this->tugasModel->find($id);
        if (empty($data['tugas']) || $data['tugas']['kelas_id'] != session()->get('kelasId')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('tugas/edit', $data);
    }

    public function update($id)
    {
        $dataToUpdate = [
            'nama_tugas' => $this->request->getPost('nama_tugas'),
            'kategori_kelas' => $this->request->getPost('kategori_kelas'),
            'deadline' => $this->request->getPost('deadline'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        $this->tugasModel->update($id, $dataToUpdate);
        return redirect()->to('/tugas/daftar')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function delete($id)
    {
        $tugas = $this->tugasModel->find($id);
        if ($tugas && $tugas['kelas_id'] == session()->get('kelasId')) {
            if ($tugas['file_path'] && file_exists(WRITEPATH . 'uploads/' . $tugas['file_path'])) {
                unlink(WRITEPATH . 'uploads/' . $tugas['file_path']);
            }
            $this->tugasModel->delete($id);
            return redirect()->to('/tugas/daftar')->with('success', 'Tugas berhasil dihapus.');
        }
        return redirect()->to('/tugas/daftar')->with('error', 'Gagal menghapus tugas.');
    }

    public function serveFile($filename)
    {
        // Pastikan nama file valid untuk keamanan
        if (strpos($filename, '..') !== false || strpos($filename, '/') !== false) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $path = WRITEPATH . 'uploads/' . $filename;

        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Tampilkan file ke browser
        return $this->response->setBody(file_get_contents($path))
            ->setContentType(mime_content_type($path));
    }
}