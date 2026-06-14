<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <div>
        <p class="admin-eyebrow">Transaksi</p>
        <h1>Manajemen Pesanan</h1>
    </div>
</div>

<div class="row g-4">
    <?php if (! empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
            <div class="col-xl-6">
                <div class="admin-card order-admin-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <h5 class="mb-1"><?= esc($order['order_code']) ?></h5>
                            <small class="text-muted"><?= esc($order['customer_name']) ?> · <?= esc($order['customer_phone']) ?></small>
                        </div>
                        <span class="status-badge status-<?= esc($order['status']) ?>"><?= esc($order['status']) ?></span>
                    </div>
                    <hr>
                    <?php foreach ($order['items'] as $item): ?>
                        <div class="d-flex justify-content-between mb-2">
                            <span><?= esc($item['menu_name']) ?> x<?= esc($item['quantity']) ?></span>
                            <strong>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></strong>
                        </div>
                    <?php endforeach; ?>
                    <hr>
                    <div class="row small g-2 mb-3">
                        <div class="col-md-6"><strong>Layanan:</strong> <?= $order['service_type'] === 'delivery' ? 'Antar' : 'Pickup' ?></div>
                        <div class="col-md-6"><strong>Bayar:</strong> <?= esc(strtoupper($order['payment_method'])) ?> / <?= esc($order['payment_status']) ?></div>
                        <?php if (! empty($order['customer_address'])): ?>
                            <div class="col-12"><strong>Alamat:</strong> <?= esc($order['customer_address']) ?></div>
                        <?php endif; ?>
                        <?php if (! empty($order['notes'])): ?>
                            <div class="col-12"><strong>Catatan:</strong> <?= esc($order['notes']) ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Total</span>
                        <h5 class="mb-0">Rp <?= number_format($order['total_price'], 0, ',', '.') ?></h5>
                    </div>

                    <form action="<?= base_url('dashboard/orders/update-status/' . $order['id']) ?>" method="post" class="row g-2">
                        <?= csrf_field() ?>
                        <div class="col-md-5">
                            <select name="status" class="form-select">
                                <?php foreach (['pending', 'processing', 'ready', 'completed', 'cancelled'] as $status): ?>
                                    <option value="<?= $status ?>" <?= $order['status'] === $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="payment_status" class="form-select">
                                <?php foreach (['unpaid', 'paid'] as $payment): ?>
                                    <option value="<?= $payment ?>" <?= $order['payment_status'] === $payment ? 'selected' : '' ?>><?= ucfirst($payment) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-admin-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12"><div class="admin-empty">Belum ada pesanan.</div></div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
