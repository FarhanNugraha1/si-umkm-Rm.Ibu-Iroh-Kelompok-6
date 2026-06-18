<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\RestaurantProfileModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Dashboard extends BaseController
{
    protected MenuModel $menuModel;
    protected RestaurantProfileModel $profileModel;
    protected UserModel $userModel;

    private array $menuCategories = ['Makanan', 'Minuman', 'Spesial'];

    public function __construct()
    {
        $this->menuModel    = new MenuModel();
        $this->profileModel = new RestaurantProfileModel();
        $this->userModel    = new UserModel();
    }

    public function index()
    {
        return view('dashboard/index', [
            'title'       => 'Dashboard Admin | RM. Ibu Iroh',
            'totalMenu'   => $this->menuModel->countAll(),
            'foodMenu'    => $this->countMenuByCategory('Makanan'),
            'drinkMenu'   => $this->countMenuByCategory('Minuman'),
            'specialMenu' => $this->countMenuByCategory('Spesial'),
            'menus'       => $this->menuModel->orderBy('id', 'DESC')->findAll(6),
            'profile'     => $this->getProfile(),
        ]);
    }

    public function menus()
    {
        return view('dashboard/menus', [
            'title' => 'Manajemen Menu | RM. Ibu Iroh',
            'menus' => $this->menuModel->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function createMenu()
    {
        return view('dashboard/menu_form', [
            'title'      => 'Tambah Menu | RM. Ibu Iroh',
            'menu'       => null,
            'mode'       => 'create',
            'categories' => $this->menuCategories,
        ]);
    }

    public function storeMenu(): RedirectResponse
    {
        if (! $this->validate($this->menuRules(true))) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $gambar = $this->handleMenuImage();

        if (! $gambar) {
            return redirect()->back()->withInput()->with('error', 'Foto menu wajib diunggah.');
        }

        $this->menuModel->insert([
            'nama'      => trim((string) $this->request->getPost('nama')),
            'kategori'  => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga'     => (int) $this->request->getPost('harga'),
            'gambar'    => $gambar,
            'favorit'   => $this->request->getPost('favorit') ? 1 : 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ]);

        return redirect()->to(base_url('dashboard/menus'))->with('success', 'Menu berhasil ditambahkan.');
    }

    public function editMenu($id)
    {
        $menu = $this->menuModel->find((int) $id);

        if (! $menu) {
            return redirect()->to(base_url('dashboard/menus'))->with('error', 'Menu tidak ditemukan.');
        }

        return view('dashboard/menu_form', [
            'title'      => 'Edit Menu | RM. Ibu Iroh',
            'menu'       => $menu,
            'mode'       => 'edit',
            'categories' => $this->menuCategories,
        ]);
    }

    public function updateMenu($id): RedirectResponse
    {
        $menu = $this->menuModel->find((int) $id);

        if (! $menu) {
            return redirect()->to(base_url('dashboard/menus'))->with('error', 'Menu tidak ditemukan.');
        }

        if (! $this->validate($this->menuRules(false))) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $gambar = $this->handleMenuImage($menu['gambar'] ?? null);

        $this->menuModel->update((int) $id, [
            'nama'      => trim((string) $this->request->getPost('nama')),
            'kategori'  => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga'     => (int) $this->request->getPost('harga'),
            'gambar'    => $gambar,
            'favorit'   => $this->request->getPost('favorit') ? 1 : 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ]);

        return redirect()->to(base_url('dashboard/menus'))->with('success', 'Menu berhasil diperbarui.');
    }

    public function deleteMenu($id): RedirectResponse
    {
        $menu = $this->menuModel->find((int) $id);

        if ($menu && ! empty($menu['gambar'])) {
            $path = FCPATH . 'uploads/menu/' . $menu['gambar'];
            if (is_file($path)) {
                unlink($path);
            }
        }

        $this->menuModel->delete((int) $id);

        return redirect()->to(base_url('dashboard/menus'))->with('success', 'Menu berhasil dihapus.');
    }

    public function adminProfile()
    {
        $admin = $this->getCurrentAdmin();

        if (! $admin) {
            return redirect()->to(base_url('logout'))->with('error', 'Sesi admin tidak valid. Silakan login ulang.');
        }

        return view('dashboard/admin_profile', [
            'title' => 'Profil Admin | RM. Ibu Iroh',
            'admin' => $admin,
        ]);
    }

    public function updateAdminProfile(): RedirectResponse
    {
        $admin = $this->getCurrentAdmin();

        if (! $admin) {
            return redirect()->to(base_url('logout'))->with('error', 'Sesi admin tidak valid. Silakan login ulang.');
        }

        $adminId = (int) $admin['id'];
        $rules = [
            'nama_lengkap' => 'required|min_length[3]',
            'username'     => "required|min_length[3]|is_unique[users.username,id,{$adminId}]",
            'email'        => "required|valid_email|is_unique[users.email,id,{$adminId}]",
            'no_telepon'   => 'permit_empty|max_length[20]',
            'alamat'       => 'permit_empty',
            'password'     => 'permit_empty|min_length[8]',
            'confirm_password' => 'permit_empty|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $data = [
            'nama_lengkap' => trim((string) $this->request->getPost('nama_lengkap')),
            'username'     => trim((string) $this->request->getPost('username')),
            'email'        => trim((string) $this->request->getPost('email')),
            'no_telepon'   => trim((string) $this->request->getPost('no_telepon')),
            'alamat'       => trim((string) $this->request->getPost('alamat')),
        ];

        $password = (string) $this->request->getPost('password');
        if ($password !== '') {
            $data['password'] = $password;
        }

        $this->userModel->update($adminId, $data);

        session()->set([
            'user_id'      => $adminId,
            'username'     => $data['username'],
            'nama_lengkap' => $data['nama_lengkap'],
            'role'         => $admin['role'] ?? 'admin',
        ]);

        return redirect()->to(base_url('dashboard/profile'))->with('success', 'Profil admin berhasil diperbarui.');
    }

    public function companyProfile()
    {
        return view('dashboard/company_profile', [
            'title'   => 'Profil Perusahaan | RM. Ibu Iroh',
            'profile' => $this->getProfile(),
        ]);
    }

    public function updateCompanyProfile(): RedirectResponse
    {
        $rules = [
            'nama_restoran'   => 'required|min_length[3]',
            'sejarah'         => 'required|min_length[20]',
            'alamat'          => 'required|min_length[10]',
            'jam_operasional' => 'required|min_length[3]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $this->saveProfile([
            'nama_restoran'   => trim((string) $this->request->getPost('nama_restoran')),
            'sejarah'         => trim((string) $this->request->getPost('sejarah')),
            'alamat'          => trim((string) $this->request->getPost('alamat')),
            'jam_operasional' => trim((string) $this->request->getPost('jam_operasional')),
        ]);

        return redirect()->to(base_url('dashboard/company-profile'))->with('success', 'Informasi profil perusahaan berhasil diperbarui.');
    }

    public function contactSettings()
    {
        return view('dashboard/contact_settings', [
            'title'   => 'Pengaturan Kontak | RM. Ibu Iroh',
            'profile' => $this->getProfile(),
        ]);
    }

    public function updateContactSettings(): RedirectResponse
    {
        $rules = [
            'telepon'       => 'required|max_length[30]',
            'whatsapp'      => 'required|max_length[30]',
            'map_embed_url' => 'permit_empty',
            'map_link'      => 'permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $this->saveProfile([
            'telepon'       => trim((string) $this->request->getPost('telepon')),
            'whatsapp'      => preg_replace('/\D+/', '', (string) $this->request->getPost('whatsapp')),
            'map_embed_url' => trim((string) $this->request->getPost('map_embed_url')),
            'map_link'      => trim((string) $this->request->getPost('map_link')),
        ]);

        return redirect()->to(base_url('dashboard/contact-settings'))->with('success', 'Informasi kontak berhasil diperbarui.');
    }

    private function menuRules(bool $requireImage): array
    {
        return [
            'nama'      => 'required|min_length[3]',
            'kategori'  => 'required|in_list[Makanan,Minuman,Spesial]',
            'harga'     => 'required|numeric|greater_than[0]',
            'deskripsi' => 'permit_empty',
            'gambar'    => ($requireImage ? 'uploaded[gambar]|' : 'permit_empty|') . 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]',
        ];
    }

    private function handleMenuImage(?string $oldImage = null): ?string
    {
        $file = $this->request->getFile('gambar');

        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return $oldImage;
        }

        $uploadPath = FCPATH . 'uploads/menu';

        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $newName = $file->getRandomName();
        $file->move($uploadPath, $newName);

        if ($oldImage) {
            $oldPath = $uploadPath . '/' . $oldImage;
            if (is_file($oldPath)) {
                unlink($oldPath);
            }
        }

        return $newName;
    }

    private function countMenuByCategory(string $category): int
    {
        return (new MenuModel())->where('kategori', $category)->countAllResults();
    }

    private function getCurrentAdmin(): ?array
    {
        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            $username = session()->get('username') ?: 'admin';
            return $this->userModel->where('username', $username)->where('role', 'admin')->first();
        }

        return $this->userModel->where('role', 'admin')->find($userId);
    }

    private function getProfile(): array
    {
        $profile = $this->profileModel->first();

        return $profile ?: $this->defaultProfile();
    }

    private function saveProfile(array $data): void
    {
        $profile = $this->profileModel->first();
        $payload = array_merge($this->defaultProfile(), $profile ?: [], $data);

        if ($profile) {
            $this->profileModel->update((int) $profile['id'], $payload);
            return;
        }

        $this->profileModel->insert($payload);
    }

    private function defaultProfile(): array
    {
        return [
            'nama_restoran'   => 'RM. Ibu Iroh',
            'sejarah'         => 'Rumah Makan Ibu Iroh merupakan rumah makan keluarga yang menghadirkan cita rasa masakan rumahan khas Sunda. Berawal dari dapur sederhana, RM. Ibu Iroh terus menjaga kualitas rasa, kebersihan, dan pelayanan agar pelanggan merasa nyaman saat melihat informasi menu, kontak, dan lokasi rumah makan.',
            'alamat'          => 'Jl. Raya Gambarsari, Gambarsari, Kec. Pagaden, Kabupaten Subang, Jawa Barat 41253',
            'jam_operasional' => 'Setiap hari, 07:30 - 19:30 WIB',
            'telepon'         => '+6282126834239',
            'whatsapp'        => '6282126834239',
            'map_embed_url'   => 'https://www.google.com/maps?q=Jl.%20Raya%20Gambarsari%2C%20Gambarsari%2C%20Pagaden%2C%20Subang%2C%20Jawa%20Barat%2041253&output=embed',
            'map_link'        => 'https://www.google.com/maps/search/?api=1&query=Jl.%20Raya%20Gambarsari%2C%20Gambarsari%2C%20Pagaden%2C%20Subang%2C%20Jawa%20Barat%2041253',
        ];
    }
}
