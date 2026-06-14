<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                'nama'       => 'Pindang Ikan Mas',
                'kategori'   => 'Makanan Utama',
                'deskripsi'  => 'Pindang ikan mas segar dengan bumbu khas rumah makan.',
                'harga'      => 30000,
                'gambar'     => null,
                'favorit'    => 1,
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Ayam Goreng Serundeng',
                'kategori'   => 'Makanan Utama',
                'deskripsi'  => 'Ayam goreng gurih dengan taburan serundeng renyah.',
                'harga'      => 25000,
                'gambar'     => null,
                'favorit'    => 1,
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Sop Jando',
                'kategori'   => 'Sup & Berkuah',
                'deskripsi'  => 'Sop hangat dengan kuah gurih dan isian melimpah.',
                'harga'      => 40000,
                'gambar'     => null,
                'favorit'    => 0,
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Sayur Lodeh',
                'kategori'   => 'Sayuran',
                'deskripsi'  => 'Sayur lodeh santan dengan rasa rumahan.',
                'harga'      => 15000,
                'gambar'     => null,
                'favorit'    => 0,
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Es Teh Manis',
                'kategori'   => 'Minuman',
                'deskripsi'  => 'Es teh manis segar sebagai pelengkap makan.',
                'harga'      => 5000,
                'gambar'     => null,
                'favorit'    => 0,
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($menus as $menu) {
            $exists = $this->db->table('menus')->where('nama', $menu['nama'])->get()->getRowArray();
            if (! $exists) {
                $this->db->table('menus')->insert($menu);
            }
        }
    }
}
