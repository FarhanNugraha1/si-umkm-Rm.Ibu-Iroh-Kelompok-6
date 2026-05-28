<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        $data = [
            'title' => 'Admin Panel | RM. Ibu Iroh'
        ];

        return view('auth/login', $data);
    }

    public function login_process()
    {
       
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

       
        if ($username === 'admin' && $password === 'password123') {
            return redirect()->to(base_url('/'))->with('success', 'Selamat datang Admin!');
        } else {
            return redirect()->back()->with('error', 'Username atau Password salah.');
        }
    }
}