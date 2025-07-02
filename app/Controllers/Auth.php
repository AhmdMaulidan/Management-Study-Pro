<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KelasModel;

class Auth extends BaseController
{
    public function register()
    {
        $userModel = new UserModel();
        $kelasModel = new KelasModel();

        $rules = [
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'nama_kelas' => 'required',
            'pin_kelas' => 'required|min_length[6]|max_length[10]|is_unique[kelas.pin_kelas]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $userData = [
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];
        $userModel->save($userData);
        $userId = $userModel->insertID();

        $kelasData = [
            'user_id' => $userId,
            'nama_kelas' => $this->request->getPost('nama_kelas'),
            'pin_kelas' => $this->request->getPost('pin_kelas')
        ];
        $kelasModel->save($kelasData);

        return redirect()->to('/#login')->with('success', 'Registrasi berhasil! Silakan masuk.');
    }

    public function login()
    {
        $userModel = new UserModel();
        $kelasModel = new KelasModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $kelas = $kelasModel->where('user_id', $user['id'])->first();

            $sessionData = [
                'userId' => $user['id'],
                'email' => $user['email'],
                'kelasId' => $kelas['id'],
                'namaKelas' => $kelas['nama_kelas'],
                'isLoggedIn' => true,
                'role' => 'user'
            ];
            session()->set($sessionData);
            return redirect()->to('/dashboard');
        }

        return redirect()->to('/#login')->with('error', 'Email atau password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}