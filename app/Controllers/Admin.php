<?php

namespace App\Controllers;

use App\Models\MenuModel; // Pastikan Anda memiliki MenuModel untuk tabel menu

class Admin extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }

    // Method untuk menampilkan Form Tambah Menu
    public function tambah_menu()
    {
        return view('admin/tambah_menu');
    }

    // Method untuk memproses penyimpanan data menu baru
    public function simpan_menu()
    {
        // Validasi input form
        if (!$this->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->back()->withInput();
        }

        // Ambil file gambar
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = '';

        // Jika ada gambar yang diunggah, proses pemindahannya
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move(ROOTPATH . 'public/uploads/menu', $namaGambar);
        }

        // Simpan data ke database melalui model
        $this->menuModel->save([
            'nama'     => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'harga'    => $this->request->getPost('harga'),
            'gambar'   => $namaGambar
        ]);

        // Redirect kembali ke dashboard setelah berhasil disimpan
        return redirect()->to(base_url('dashboard'))->with('success', 'Menu berhasil ditambahkan!');
    }
}