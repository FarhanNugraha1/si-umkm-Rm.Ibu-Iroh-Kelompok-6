<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content') ?>
<section class="section order-section">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-10">
                <div class="page-header">
                    <p class="eyebrow dark">Pemesanan</p>
                    <h1 class="brand-font">Buat Pesanan Baru</h1>
                    <p>Pilih satu menu dulu untuk versi sederhana ini. Struktur database sudah disiapkan dengan `order_items`, jadi nanti bisa dikembangkan jadi cart banyak item.</p>
                </div>
            </div>

            <div class="col-lg-10">
                <form action="<?= base_url('order/store') ?>" method="post" class="form-card">
                    <?= csrf_field() ?>
                    <div class="row g-4">
                        <div class="col-md-7">
                            <label class="form-label fw-bold">Pilih Menu</label>
                            <select class="form-select form-select-lg" name="menu_id" id="menuSelect" required>
                                <option value="">Pilih menu</option>
                                <?php foreach ($menus as $menu): ?>
                                    <option value="<?= $menu['id'] ?>" data-price="<?= $menu['harga'] ?>" <?= old('menu_id') == $menu['id'] ? 'selected' : '' ?>>
                                        <?= esc($menu['nama']) ?> - Rp <?= number_format($menu['harga'], 0, ',', '.') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-bold">Jumlah</label>
                            <input type="number" name="quantity" id="quantityInput" min="1" value="<?= old('quantity') ?: 1 ?>" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Metode Pesanan</label>
                            <select name="service_type" id="serviceType" class="form-select" required>
                                <option value="pickup" <?= old('service_type') === 'pickup' ? 'selected' : '' ?>>Ambil di tempat</option>
                                <option value="delivery" <?= old('service_type') === 'delivery' ? 'selected' : '' ?>>Antar ke alamat</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Metode Pembayaran</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="cash" <?= old('payment_method') === 'cash' ? 'selected' : '' ?>>Cash</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nomor Telepon</label>
                            <input type="text" name="customer_phone" class="form-control" value="<?= old('customer_phone') ?: esc($user['no_telepon'] ?? '') ?>" placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Estimasi Total</label>
                            <div class="total-preview" id="totalPreview">Rp 0</div>
                        </div>

                        <div class="col-12" id="addressWrapper">
                            <label class="form-label fw-bold">Alamat Pengiriman</label>
                            <textarea name="customer_address" class="form-control" rows="3" placeholder="Isi jika memilih antar ke alamat"><?= old('customer_address') ?: esc($user['alamat'] ?? '') ?></textarea>
                            <small class="text-muted">Untuk versi tugas, validasi radius 1 km bisa dikembangkan memakai koordinat/maps.</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Catatan</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Contoh: sambal dipisah, jangan terlalu pedas"><?= old('notes') ?></textarea>
                        </div>

                        <div class="col-12 d-flex flex-wrap gap-3 justify-content-end">
                            <a href="<?= base_url('/') ?>" class="btn btn-light btn-lg">Batal</a>
                            <button type="submit" class="btn btn-warm btn-lg">Kirim Pesanan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
