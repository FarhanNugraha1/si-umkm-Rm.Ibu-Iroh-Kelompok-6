<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class Home extends BaseController
{
    protected MenuModel $menuModel;
    protected OrderModel $orderModel;
    protected OrderItemModel $orderItemModel;

    public function __construct()
    {
        $this->menuModel      = new MenuModel();
        $this->orderModel     = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
    }

    public function index()
    {
        $data = [
            'title' => 'RM. Ibu Iroh | Pemesanan & Profil',
            'menus' => $this->menuModel
                ->where('is_active', 1)
                ->orderBy('favorit', 'DESC')
                ->orderBy('id', 'DESC')
                ->findAll(),
        ];

        return view('home/index', $data);
    }

    public function order()
    {
        $userModel = new UserModel();
        $user      = $userModel->find((int) session()->get('user_id'));

        $data = [
            'title' => 'Pemesanan | RM. Ibu Iroh',
            'user'  => $user,
            'menus' => $this->menuModel
                ->where('is_active', 1)
                ->orderBy('kategori', 'ASC')
                ->orderBy('nama', 'ASC')
                ->findAll(),
        ];

        return view('home/order', $data);
    }

    public function saveOrder()
    {
        $rules = [
            'menu_id'        => 'required|integer',
            'quantity'       => 'required|integer|greater_than[0]',
            'service_type'   => 'required|in_list[pickup,delivery]',
            'payment_method' => 'required|in_list[cash,transfer,qris]',
            'customer_phone' => 'required|min_length[10]',
        ];

        if ($this->request->getPost('service_type') === 'delivery') {
            $rules['customer_address'] = 'required|min_length[5]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', $this->validator->listErrors());
        }

        $menu = $this->menuModel
            ->where('is_active', 1)
            ->find((int) $this->request->getPost('menu_id'));

        if (! $menu) {
            return redirect()->back()->with('error', 'Menu tidak ditemukan atau sedang tidak aktif.');
        }

        $quantity   = (int) $this->request->getPost('quantity');
        $subtotal   = (int) $menu['harga'] * $quantity;
        $orderCode  = 'ORD-' . date('Ymd-His') . '-' . session()->get('user_id');

        $db = db_connect();
        $db->transStart();

        $this->orderModel->insert([
            'user_id'          => (int) session()->get('user_id'),
            'order_code'       => $orderCode,
            'customer_name'    => session()->get('nama_lengkap') ?: session()->get('username'),
            'customer_phone'   => $this->request->getPost('customer_phone'),
            'customer_address' => $this->request->getPost('customer_address'),
            'service_type'     => $this->request->getPost('service_type'),
            'payment_method'   => $this->request->getPost('payment_method'),
            'payment_status'   => 'unpaid',
            'total_price'      => $subtotal,
            'status'           => 'pending',
            'notes'            => $this->request->getPost('notes'),
        ]);

        $orderId = (int) $this->orderModel->getInsertID();

        $this->orderItemModel->insert([
            'order_id'  => $orderId,
            'menu_id'   => (int) $menu['id'],
            'menu_name' => $menu['nama'],
            'price'     => (int) $menu['harga'],
            'quantity'  => $quantity,
            'subtotal'  => $subtotal,
        ]);

        $db->transComplete();

        if (! $db->transStatus()) {
            return redirect()->back()->withInput()->with('error', 'Pesanan gagal dibuat. Silakan coba lagi.');
        }

        return redirect()->to(base_url('my-orders'))
            ->with('success', 'Pesanan berhasil dibuat dengan kode ' . $orderCode . '.');
    }

    public function myOrders()
    {
        $orders = $this->orderModel->getOrdersWithUser((int) session()->get('user_id'));

        foreach ($orders as &$order) {
            $order['items'] = $this->orderItemModel->where('order_id', $order['id'])->findAll();
        }

        $data = [
            'title'  => 'Pesanan Saya | RM. Ibu Iroh',
            'orders' => $orders,
        ];

        return view('home/my_orders', $data);
    }
}
