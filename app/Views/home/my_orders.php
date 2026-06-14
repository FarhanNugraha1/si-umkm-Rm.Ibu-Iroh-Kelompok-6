<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="container">
        <div class="page-header">
            <p class="eyebrow dark">Riwayat</p>
            <h1 class="brand-font">Pesanan Saya</h1>
            <p>Lihat status pesanan yang sudah dibuat.</p>
        </div>

        <?php if (! empty($orders)): ?>
            <div class="row g-4">
                <?php foreach ($orders as $order): ?>
                    <div class="col-lg-6">
                        <div class="order-card">
                            <div class="d-flex justify-content-between gap-3 align-items-start">
                                <div>
                                    <h5 class="mb-1"><?= esc($order['order_code']) ?></h5>
                                    <small class="text-muted"><?= date('d M Y H:i', strtotime($order['created_at'])) ?></small>
                                </div>
                                <span class="status-badge status-<?= esc($order['status']) ?>"><?= esc($order['status']) ?></span>
                            </div>
                            <hr>
                            <?php foreach ($order['items'] as $item): ?>
                                <div class="d-flex justify-content-between small mb-2">
                                    <span><?= esc($item['menu_name']) ?> x<?= esc($item['quantity']) ?></span>
                                    <strong>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></strong>
                                </div>
                            <?php endforeach; ?>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>Total</span>
                                <strong>Rp <?= number_format($order['total_price'], 0, ',', '.') ?></strong>
                            </div>
                            <div class="small text-muted mt-2">
                                <?= $order['service_type'] === 'delivery' ? 'Antar ke alamat' : 'Ambil di tempat' ?> · Pembayaran <?= esc(strtoupper($order['payment_method'])) ?> · <?= esc($order['payment_status']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">Belum ada pesanan. <a href="<?= base_url('order') ?>">Buat pesanan pertama</a>.</div>
        <?php endif; ?>
    </div>
</section>
<?= $this->endSection() ?>
