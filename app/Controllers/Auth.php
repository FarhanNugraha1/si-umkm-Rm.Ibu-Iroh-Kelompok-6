<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login', [
            'title' => 'Login Admin | RM. Ibu Iroh',
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

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username/email atau password salah.');
        }

        if (($user['role'] ?? '') !== 'admin') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Akses login hanya untuk admin website.');
        }

        session()->regenerate();
        session()->set([
            'isLoggedIn'   => true,
            'user_id'      => $user['id'],
            'username'     => $user['username'],
            'nama_lengkap' => $user['nama_lengkap'],
            'role'         => $user['role'],
        ]);

        return redirect()->to(base_url('dashboard'))
            ->with('success', 'Selamat datang, ' . $user['nama_lengkap'] . '!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Logout berhasil.');
    }
}
