<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <div>
        <p class="admin-eyebrow">Overview Katalog</p>
        <h1>Dashboard</h1>
        <p class="text-muted mb-0">Website ini hanya menampilkan katalog menu, profil, kontak, dan lokasi rumah makan.</p>
    </div>
    <a href="<?= base_url('dashboard/menus/create') ?>" class="btn btn-admin-primary"><i class="bi bi-plus-lg"></i> Tambah Menu</a>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3"><div class="stat-card"><i class="bi bi-egg-fried"></i><span><?= esc($totalMenu) ?></span><p>Total Menu</p></div></div>
    <div class="col-md-6 col-xl-3"><div class="stat-card"><i class="bi bi-basket2"></i><span><?= esc($foodMenu) ?></span><p>Makanan</p></div></div>
    <div class="col-md-6 col-xl-3"><div class="stat-card"><i class="bi bi-cup-straw"></i><span><?= esc($drinkMenu) ?></span><p>Minuman</p></div></div>
    <div class="col-md-6 col-xl-3"><div class="stat-card"><i class="bi bi-stars"></i><span><?= esc($specialMenu) ?></span><p>Spesial</p></div></div>
</div>

<div class="row g-4">
    <div class="col-xl-7">
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
                                <img src="<?= base_url('uploads/menu/' . $menu['gambar']) ?>" alt="<?= esc($menu['nama']) ?>">
                            <?php else: ?>
                                <i class="bi bi-egg-fried"></i>
                            <?php endif; ?>
                        </div>
                        <div class="flex-fill">
                            <strong><?= esc($menu['nama']) ?></strong>
                            <small><?= esc($menu['kategori']) ?> · <?= ! empty($menu['is_active']) ? 'Aktif' : 'Tidak aktif' ?></small>
                        </div>
                        <span>Rp <?= number_format($menu['harga'], 0, ',', '.') ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="admin-empty">Belum ada menu. Klik tombol tambah menu untuk mengisi katalog.</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-xl-5">
        <div class="admin-card h-100">
            <div class="card-head">
                <h4>Informasi Website</h4>
                <a href="<?= base_url('/') ?>" target="_blank">Lihat website</a>
            </div>
            <div class="catalog-info-list">
                <div>
                    <i class="bi bi-info-circle"></i>
                    <div>
                        <strong>Jenis Website</strong>
                        <small>Katalog menu, profil, kontak, dan lokasi. Tidak ada pemesanan melalui website.</small>
                    </div>
                </div>
                <div>
                    <i class="bi bi-clock"></i>
                    <div>
                        <strong>Jam Operasional</strong>
                        <small><?= esc($profile['jam_operasional'] ?? '-') ?></small>
                    </div>
                </div>
                <div>
                    <i class="bi bi-telephone"></i>
                    <div>
                        <strong>Kontak</strong>
                        <small><?= esc($profile['telepon'] ?? '-') ?></small>
                    </div>
                </div>
                <div>
                    <i class="bi bi-whatsapp"></i>
                    <div>
                        <strong>WhatsApp</strong>
                        <small><?= esc($profile['whatsapp'] ?? '-') ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
