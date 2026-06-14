<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected MenuModel $menuModel;
    protected OrderModel $orderModel;
    protected OrderItemModel $orderItemModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->menuModel      = new MenuModel();
        $this->orderModel     = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
        $this->userModel      = new UserModel();
    }

    public function index()
    {
        $orders = $this->orderModel->getOrdersWithUser();

        foreach ($orders as &$order) {
            $order['items'] = $this->orderItemModel->where('order_id', $order['id'])->findAll();
        }

        return view('dashboard/index', [
            'title'          => 'Dashboard Admin | RM. Ibu Iroh',
            'totalMenu'      => $this->menuModel->countAllResults(),
            'totalOrders'    => $this->orderModel->countAllResults(),
            'pendingOrders'  => $this->orderModel->where('status', 'pending')->countAllResults(),
            'totalCustomers' => $this->userModel->where('role', 'user')->countAllResults(),
            'menus'          => $this->menuModel->orderBy('id', 'DESC')->findAll(5),
            'orders'         => array_slice($orders, 0, 5),
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
            'title' => 'Tambah Menu | RM. Ibu Iroh',
            'menu'  => null,
            'mode'  => 'create',
        ]);
    }

    public function storeMenu()
    {
        if (! $this->validate($this->menuRules())) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $gambar = $this->handleMenuImage();

        $this->menuModel->insert([
            'nama'      => $this->request->getPost('nama'),
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
            'title' => 'Edit Menu | RM. Ibu Iroh',
            'menu'  => $menu,
            'mode'  => 'edit',
        ]);
    }

    public function updateMenu($id)
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
            'nama'      => $this->request->getPost('nama'),
            'kategori'  => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga'     => (int) $this->request->getPost('harga'),
            'gambar'    => $gambar,
            'favorit'   => $this->request->getPost('favorit') ? 1 : 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ]);

        return redirect()->to(base_url('dashboard/menus'))->with('success', 'Menu berhasil diperbarui.');
    }

    public function deleteMenu($id)
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

    public function orders()
    {
        $orders = $this->orderModel->getOrdersWithUser();

        foreach ($orders as &$order) {
            $order['items'] = $this->orderItemModel->where('order_id', $order['id'])->findAll();
        }

        return view('dashboard/orders', [
            'title'  => 'Manajemen Pesanan | RM. Ibu Iroh',
            'orders' => $orders,
        ]);
    }

    public function updateOrderStatus($id)
    {
        $status = $this->request->getPost('status');
        $paymentStatus = $this->request->getPost('payment_status');

        if (! in_array($status, ['pending', 'processing', 'ready', 'completed', 'cancelled'], true)) {
            return redirect()->back()->with('error', 'Status pesanan tidak valid.');
        }

        if (! in_array($paymentStatus, ['unpaid', 'paid'], true)) {
            return redirect()->back()->with('error', 'Status pembayaran tidak valid.');
        }

        $this->orderModel->update((int) $id, [
            'status'         => $status,
            'payment_status' => $paymentStatus,
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function customers()
    {
        return view('dashboard/customers', [
            'title'     => 'Data Pelanggan | RM. Ibu Iroh',
            'customers' => $this->userModel->where('role', 'user')->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    private function menuRules(bool $requireImage = true): array
    {
        return [
            'nama'      => 'required|min_length[3]',
            'kategori'  => 'required',
            'harga'     => 'required|numeric|greater_than[0]',
            'deskripsi' => 'permit_empty',
            'gambar'    => 'permit_empty|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]',
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
}
