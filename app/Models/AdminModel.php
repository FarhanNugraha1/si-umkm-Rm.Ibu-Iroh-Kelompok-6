<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admins'; // nama tabel di database kamu nanti
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['username', 'password', 'nama_lengkap'];

    // Fungsi untuk mencari data admin berdasarkan username saat login
    public function getAdminByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}