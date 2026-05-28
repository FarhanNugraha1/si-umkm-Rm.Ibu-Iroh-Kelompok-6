<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    // Simulasi data dari database untuk "Menu Andalan"
    public function getMenuAndalan()
    {
        return [
            [
                'nama' => 'Pindang ikan mas',
                'deskripsi' => 'ikan mas pilihan yang di presto dengan bumbu rempah lalu disajikan dengan berkualitas.',
                'harga' => 'Rp 30.000',
                'favorit' => true
            ],
            [
                'nama' => 'Ayam Goreng Serundeng',
                'deskripsi' => 'Ayam serundeng yang digoreng dengan serundeng kelapa spesial racikan Ibu Iroh.',
                'harga' => 'Rp 65.000',
                'favorit' => false
            ],
            [
                'nama' => 'Sop Jando',
                'deskripsi' => 'Sop jando berisi daging sapi empuk dengan kuah kaldu yang gurih menyegarkan.',
                'harga' => 'Rp 40.000',
                'favorit' => false
            ]
        ];
    }
}