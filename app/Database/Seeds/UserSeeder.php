<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        $users = [
            [
                'nama_lengkap' => 'Administrator RM. Ibu Iroh',
                'username'     => 'admin',
                'email'        => 'admin@rmibuiroh.test',
                'password'     => 'admin123',
                'no_telepon'   => '081234567890',
                'alamat'       => 'RM. Ibu Iroh',
                'role'         => 'admin',
            ],
            [
                'nama_lengkap' => 'Pelanggan Contoh',
                'username'     => 'customer',
                'email'        => 'customer@rmibuiroh.test',
                'password'     => 'user12345',
                'no_telepon'   => '081234567891',
                'alamat'       => 'Subang',
                'role'         => 'user',
            ],
        ];

        foreach ($users as $user) {
            if (! $userModel->where('username', $user['username'])->first()) {
                $userModel->insert($user);
            }
        }
    }
}
