<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <div>
        <p class="admin-eyebrow">Overview</p>
        <h1>Dashboard</h1>
    </div>
    <a href="<?= base_url('dashboard/menus/create') ?>" class="btn btn-admin-primary"><i class="bi bi-plus-lg"></i> Tambah Menu</a>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3"><div class="stat-card"><i class="bi bi-egg-fried"></i><span><?= esc($totalMenu) ?></span><p>Total Menu</p></div></div>
    <div class="col-md-6 col-xl-3"><div class="stat-card"><i class="bi bi-receipt"></i><span><?= esc($totalOrders) ?></span><p>Total Pesanan</p></div></div>
    <div class="col-md-6 col-xl-3"><div class="stat-card"><i class="bi bi-hourglass-split"></i><span><?= esc($pendingOrders) ?></span><p>Pesanan Pending</p></div></div>
    <div class="col-md-6 col-xl-3"><div class="stat-card"><i class="bi bi-people"></i><span><?= esc($totalCustomers) ?></span><p>Pelanggan</p></div></div>
</div>

<div class="row g-4">
    <div class="col-xl-6">
        <div class="admin-card h-100">
            <div class="card-head">
                <h4>Menu Terbaru</h4>
                <a href="<?= base_url('dashboard/menus') ?>">Lihat semua</a>
            </div>
            <?php if (! empty($menus)): ?>
                <?php foreach ($menus as $menu): ?>
                    <div class="admin-list-item">
                        <div class="thumb">
                            <?php if (! empty($menu['gambar'])): ?>
                                <img src="<?= base_url('uploads/menu/' . $menu['gambar']) ?>" alt="">
                            <?php else: ?>
                                <i class="bi bi-egg-fried"></i>
                            <?php endif; ?>
                        </div>
                        <div class="flex-fill">
                            <strong><?= esc($menu['nama']) ?></strong>
                            <small><?= esc($menu['kategori']) ?></small>
                        </div>
                        <span>Rp <?= number_format($menu['harga'], 0, ',', '.') ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="admin-empty">Belum ada menu.</div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="admin-card h-100">
            <div class="card-head">
                <h4>Pesanan Terbaru</h4>
                <a href="<?= base_url('dashboard/orders') ?>">Lihat semua</a>
            </div>
            <?php if (! empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <div class="admin-list-item align-items-start">
                        <div class="order-icon"><i class="bi bi-bag-check"></i></div>
                        <div class="flex-fill">
                            <strong><?= esc($order['order_code']) ?></strong>
                            <small><?= esc($order['customer_name']) ?> · <?= esc($order['status']) ?></small>
                            <?php if (! empty($order['items'])): ?>
                                <div class="item-mini">
                                    <?php foreach ($order['items'] as $item): ?>
                                        <?= esc($item['menu_name']) ?> x<?= esc($item['quantity']) ?><br>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <span>Rp <?= number_format($order['total_price'], 0, ',', '.') ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="admin-empty">Belum ada pesanan.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
