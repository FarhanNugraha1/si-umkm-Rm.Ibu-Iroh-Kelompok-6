<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login', [
            'title' => 'Login | RM. Ibu Iroh',
        ]);
    }

    public function login_process()
    {
        if (! $this->validate([
            'username' => 'required',
            'password' => 'required',
        ])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username dan password wajib diisi.');
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel
            ->groupStart()
                ->where('username', $username)
                ->orWhere('email', $username)
            ->groupEnd()
            ->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->regenerate();
            session()->set([
                'isLoggedIn'   => true,
                'user_id'      => $user['id'],
                'username'     => $user['username'],
                'nama_lengkap' => $user['nama_lengkap'],
                'role'         => $user['role'],
            ]);

            if ($user['role'] === 'admin') {
                return redirect()->to(base_url('dashboard'))
                    ->with('success', 'Selamat datang, ' . $user['nama_lengkap'] . '!');
            }

            return redirect()->to(base_url('/'))
                ->with('success', 'Login berhasil. Selamat datang, ' . $user['nama_lengkap'] . '!');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Username/email atau password salah.');
    }

    public function register()
    {
        return view('auth/register', [
            'title' => 'Registrasi | RM. Ibu Iroh',
        ]);
    }

    public function register_process()
    {
        $rules = [
            'nama_lengkap'     => 'required|min_length[3]',
            'username'         => 'required|min_length[3]|is_unique[users.username]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', $this->validator->listErrors());
        }

        $userModel = new UserModel();
        $saved = $userModel->save([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            'email'        => $this->request->getPost('email'),
            'password'     => $this->request->getPost('password'),
            'no_telepon'   => $this->request->getPost('no_telepon'),
            'alamat'       => $this->request->getPost('alamat'),
            'role'         => 'user',
        ]);

        if ($saved) {
            return redirect()->to(base_url('login'))
                ->with('success', 'Registrasi berhasil. Silakan login.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Registrasi gagal. Silakan coba lagi.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Logout berhasil.');
    }
}
