<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<?php
    $isEdit = $mode === 'edit';
    $action = $isEdit ? base_url('dashboard/menus/update/' . $menu['id']) : base_url('dashboard/menus/store');
    $categories = $categories ?? ['Makanan', 'Minuman', 'Spesial'];
?>
<div class="admin-page-header">
    <div>
        <p class="admin-eyebrow">Menu</p>
        <h1><?= $isEdit ? 'Ubah Menu' : 'Tambah Menu' ?></h1>
    </div>
    <a href="<?= base_url('dashboard/menus') ?>" class="btn btn-light">Kembali</a>
</div>

<div class="row g-4">
    <div class="col-xl-8">
        <form action="<?= $action ?>" method="post" enctype="multipart/form-data" class="admin-card form-admin">
            <?= csrf_field() ?>
            <div class="row g-4">
                <div class="col-md-7">
                    <label class="form-label fw-bold">Nama Menu <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" value="<?= old('nama') ?: esc($menu['nama'] ?? '') ?>" placeholder="Contoh: Pindang Ikan Mas" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                    <?php $selectedKategori = old('kategori') ?: ($menu['kategori'] ?? ''); ?>
                    <select name="kategori" class="form-select" required>
                        <option value="">Pilih kategori</option>
                        <?php foreach ($categories as $kategori): ?>
                            <option value="<?= esc($kategori) ?>" <?= $selectedKategori === $kategori ? 'selected' : '' ?>><?= esc($kategori) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Harga <span class="text-danger">*</span></label>
                    <input type="number" name="harga" min="1" class="form-control" value="<?= old('harga') ?: esc($menu['harga'] ?? '') ?>" placeholder="30000" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Foto Menu <?= $isEdit ? '' : '<span class="text-danger">*</span>' ?></label>
                    <input type="file" name="gambar" class="form-control" accept="image/jpg,image/jpeg,image/png,image/webp" <?= $isEdit ? '' : 'required' ?>>
                    <small class="text-muted"><?= $isEdit ? 'Kosongkan jika foto tidak diganti.' : 'JPG, PNG, WEBP maksimal 2MB.' ?></small>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsi singkat menu"><?= old('deskripsi') ?: esc($menu['deskripsi'] ?? '') ?></textarea>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <?php $favorit = old('favorit') !== null ? old('favorit') : ($menu['favorit'] ?? 0); ?>
                        <input class="form-check-input" type="checkbox" name="favorit" value="1" id="favorit" <?= (int) $favorit === 1 ? 'checked' : '' ?>>
                        <label class="form-check-label fw-bold" for="favorit">Tandai sebagai favorit</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <?php $active = old('is_active') !== null ? old('is_active') : ($menu['is_active'] ?? 1); ?>
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" <?= (int) $active === 1 ? 'checked' : '' ?>>
                        <label class="form-check-label fw-bold" for="is_active">Menu aktif</label>
                    </div>
                </div>
                <?php if ($isEdit && ! empty($menu['gambar'])): ?>
                    <div class="col-12">
                        <label class="form-label fw-bold">Foto Saat Ini</label><br>
                        <img src="<?= base_url('uploads/menu/' . $menu['gambar']) ?>" class="current-image" alt="<?= esc($menu['nama']) ?>">
                    </div>
                <?php endif; ?>
                <div class="col-12 d-flex justify-content-end gap-3">
                    <a href="<?= base_url('dashboard/menus') ?>" class="btn btn-light btn-lg">Batal</a>
                    <button type="submit" class="btn btn-admin-primary btn-lg">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-xl-4">
        <div class="admin-card helper-card">
            <h5 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>Alur Admin</h5>
            <ol class="small mb-0 ps-3">
                <li>Pilih aksi tambah atau ubah menu.</li>
                <li>Isi nama, harga, kategori, dan foto.</li>
                <li>Tekan tombol <strong>Simpan</strong>.</li>
                <li>Sistem memvalidasi data dan menyimpan ke database.</li>
            </ol>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
