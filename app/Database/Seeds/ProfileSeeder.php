<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama_restoran'    => 'RM. Ibu Iroh',
            'sejarah'          => 'Rumah Makan Ibu Iroh merupakan rumah makan keluarga yang menghadirkan cita rasa masakan rumahan khas Sunda. Berawal dari dapur sederhana, RM. Ibu Iroh terus menjaga kualitas rasa, kebersihan, dan pelayanan agar pelanggan merasa nyaman saat melihat informasi menu, kontak, dan lokasi rumah makan.',
            'alamat'           => 'Jl. Raya Gambarsari, Gambarsari, Kec. Pagaden, Kabupaten Subang, Jawa Barat 41253',
            'jam_operasional'  => 'Setiap hari, 07:30 - 19:30 WIB',
            'telepon'          => '+6282126834239',
            'whatsapp'         => '6282126834239',
            'map_embed_url'    => 'https://www.google.com/maps?q=Jl.%20Raya%20Gambarsari%2C%20Gambarsari%2C%20Pagaden%2C%20Subang%2C%20Jawa%20Barat%2041253&output=embed',
            'map_link'         => 'https://www.google.com/maps/search/?api=1&query=Jl.%20Raya%20Gambarsari%2C%20Gambarsari%2C%20Pagaden%2C%20Subang%2C%20Jawa%20Barat%2041253',
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];

        $exists = $this->db->table('restaurant_profiles')->where('id', 1)->get()->getRowArray();

        if ($exists) {
            $this->db->table('restaurant_profiles')->where('id', 1)->update($data);
        } else {
            $data['id'] = 1;
            $this->db->table('restaurant_profiles')->insert($data);
        }
    }
}
