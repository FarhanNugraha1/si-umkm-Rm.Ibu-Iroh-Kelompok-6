<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\RestaurantProfileModel;

class Home extends BaseController
{
    protected MenuModel $menuModel;
    protected RestaurantProfileModel $profileModel;

    public function __construct()
    {
        $this->menuModel    = new MenuModel();
        $this->profileModel = new RestaurantProfileModel();
    }

    public function index()
    {
        $profile = $this->getProfile();
        $menus   = $this->getActiveMenus();

        return view('home/index', [
            'title'        => 'RM. Ibu Iroh | Katalog Menu',
            'profile'      => $profile,
            'menus'        => array_slice($menus, 0, 6),
            'groupedMenus' => $this->groupMenusByCategory($menus),
        ]);
    }

    public function profile()
    {
        return view('home/profile', [
            'title'   => 'Profil | RM. Ibu Iroh',
            'profile' => $this->getProfile(),
        ]);
    }

    public function menu()
    {
        $menus = $this->getActiveMenus();

        return view('home/menu', [
            'title'        => 'Menu | RM. Ibu Iroh',
            'profile'      => $this->getProfile(),
            'menus'        => $menus,
            'groupedMenus' => $this->groupMenusByCategory($menus),
        ]);
    }

    public function contact()
    {
        return view('home/contact', [
            'title'   => 'Kontak | RM. Ibu Iroh',
            'profile' => $this->getProfile(),
        ]);
    }

    private function getActiveMenus(): array
    {
        return $this->menuModel
            ->where('is_active', 1)
            ->orderBy('kategori', 'ASC')
            ->orderBy('favorit', 'DESC')
            ->orderBy('nama', 'ASC')
            ->findAll();
    }

    private function groupMenusByCategory(array $menus): array
    {
        $categories = [
            'Makanan' => [],
            'Minuman' => [],
            'Spesial' => [],
        ];

        foreach ($menus as $menu) {
            $kategori = $menu['kategori'] ?? 'Makanan';

            if (! array_key_exists($kategori, $categories)) {
                $categories[$kategori] = [];
            }

            $categories[$kategori][] = $menu;
        }

        return $categories;
    }

    private function getProfile(): array
    {
        $profile = $this->profileModel->first();

        if ($profile) {
            return $profile;
        }

        return [
            'nama_restoran'   => 'RM. Ibu Iroh',
            'sejarah'         => 'Rumah Makan Ibu Iroh menghadirkan cita rasa masakan rumahan khas Sunda dengan bahan segar dan pelayanan ramah.',
            'alamat'          => 'Jl. Raya Gambarsari, Gambarsari, Kec. Pagaden, Kabupaten Subang, Jawa Barat 41253',
            'jam_operasional' => 'Setiap hari, 07:30 - 19:30 WIB',
            'telepon'         => '+6282126834239',
            'whatsapp'        => '6282126834239',
            'map_embed_url'   => 'https://www.google.com/maps?q=Jl.%20Raya%20Gambarsari%2C%20Gambarsari%2C%20Pagaden%2C%20Subang%2C%20Jawa%20Barat%2041253&output=embed',
            'map_link'        => 'https://www.google.com/maps/search/?api=1&query=Jl.%20Raya%20Gambarsari%2C%20Gambarsari%2C%20Pagaden%2C%20Subang%2C%20Jawa%20Barat%2041253',
        ];
    }
}
