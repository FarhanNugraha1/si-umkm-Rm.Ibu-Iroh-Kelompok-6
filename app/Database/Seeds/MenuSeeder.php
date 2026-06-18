<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $menus = [
            [
                'nama'       => 'Pindang Ikan Mas',
                'kategori'   => 'Makanan',
                'deskripsi'  => 'Pindang ikan mas segar dengan bumbu khas RM. Ibu Iroh.',
                'harga'      => 30000,
                'gambar'     => '1781455067_771e430e59de0401c563.png',
                'favorit'    => 1,
                'is_active'  => 1,
            ],
            [
                'nama'       => 'Ayam Goreng Serundeng',
                'kategori'   => 'Makanan',
                'deskripsi'  => 'Ayam goreng gurih dengan taburan serundeng renyah.',
                'harga'      => 25000,
                'gambar'     => '1781525846_070d0045fc2f578329ed.jpg',
                'favorit'    => 1,
                'is_active'  => 1,
            ],
            [
                'nama'       => 'Sop Jando',
                'kategori'   => 'Spesial',
                'deskripsi'  => 'Sop hangat berkuah gurih dengan isian khas yang melimpah.',
                'harga'      => 40000,
                'gambar'     => '1781525914_e8dd3fc922c58dfd50ff.jpg',
                'favorit'    => 1,
                'is_active'  => 1,
            ],
            [
                'nama'       => 'Pepes Ikan Mas',
                'kategori'   => 'Spesial',
                'deskripsi'  => 'Pepes ikan mas berbumbu rempah dan daun kemangi.',
                'harga'      => 35000,
                'gambar'     => '1781525978_bb4a59b834b2597db319.jpg',
                'favorit'    => 0,
                'is_active'  => 1,
            ],
            [
                'nama'       => 'Sayur Asem',
                'kategori'   => 'Makanan',
                'deskripsi'  => 'Sayur asem segar sebagai pelengkap hidangan utama.',
                'harga'      => 12000,
                'gambar'     => '1781526061_a3a471ded7b4573115b9.webp',
                'favorit'    => 0,
                'is_active'  => 1,
            ],
            [
                'nama'       => 'Es Teh Manis',
                'kategori'   => 'Minuman',
                'deskripsi'  => 'Es teh manis segar untuk menemani santapan.',
                'harga'      => 5000,
                'gambar'     => '1781526113_31486e0dd6eb2d851f82.jpg',
                'favorit'    => 0,
                'is_active'  => 1,
            ],
            [
                'nama'       => 'Es Jeruk',
                'kategori'   => 'Minuman',
                'deskripsi'  => 'Minuman jeruk segar dengan rasa manis dan asam seimbang.',
                'harga'      => 8000,
                'gambar'     => '1781526178_46767dc885186ea02207.jpg',
                'favorit'    => 0,
                'is_active'  => 1,
            ],
            [
                'nama'       => 'Paket Nasi Komplit',
                'kategori'   => 'Spesial',
                'deskripsi'  => 'Paket nasi lengkap dengan lauk pilihan dan sambal khas.',
                'harga'      => 45000,
                'gambar'     => '1781526246_f07e5d8f08236c8efec9.jpg',
                'favorit'    => 1,
                'is_active'  => 1,
            ],
        ];

        foreach ($menus as $menu) {
            $exists = $this->db->table('menus')->where('nama', $menu['nama'])->get()->getRowArray();

            $menu['created_at'] = $now;
            $menu['updated_at'] = $now;

            if (! $exists) {
                $this->db->table('menus')->insert($menu);
            }
        }
    }
}
