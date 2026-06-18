<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        $admin = [
            'nama_lengkap' => 'Administrator RM. Ibu Iroh',
            'username'     => 'admin',
            'email'        => 'admin@rmibuiroh.test',
            'password'     => 'admin123',
            'no_telepon'   => '081234567890',
            'alamat'       => 'RM. Ibu Iroh',
            'role'         => 'admin',
        ];

        if (! $userModel->where('username', $admin['username'])->first()) {
            $userModel->insert($admin);
        }
    }
}
