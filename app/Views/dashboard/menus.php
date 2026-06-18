<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <div>
        <p class="admin-eyebrow">Konten</p>
        <h1>Manajemen Menu</h1>
    </div>
    <a href="<?= base_url('dashboard/menus/create') ?>" class="btn btn-admin-primary"><i class="bi bi-plus-lg"></i> Tambah Menu</a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table admin-table align-middle">
            <thead>
                <tr>
                    <th>Foto & Nama Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($menus)): ?>
                    <?php foreach ($menus as $menu): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="thumb">
                                        <?php if (! empty($menu['gambar'])): ?>
                                            <img src="<?= base_url('uploads/menu/' . $menu['gambar']) ?>" alt="<?= esc($menu['nama']) ?>">
                                        <?php else: ?>
                                            <i class="bi bi-egg-fried"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <strong><?= esc($menu['nama']) ?></strong>
                                        <small class="d-block text-muted"><?= esc($menu['deskripsi'] ?: 'Tidak ada deskripsi') ?></small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="category-badge"><?= esc($menu['kategori']) ?></span></td>
                            <td>Rp <?= number_format($menu['harga'], 0, ',', '.') ?></td>
                            <td>
                                <?php if ((int) $menu['is_active'] === 1): ?>
                                    <span class="badge text-bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge text-bg-secondary">Nonaktif</span>
                                <?php endif; ?>
                                <?php if ((int) $menu['favorit'] === 1): ?>
                                    <span class="badge text-bg-warning">Favorit</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="<?= base_url('dashboard/menus/edit/' . $menu['id']) ?>" class="btn btn-sm btn-outline-primary">Ubah</a>
                                <form action="<?= base_url('dashboard/menus/delete/' . $menu['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus menu ini?')">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data menu.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
