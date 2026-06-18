<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <div>
        <p class="admin-eyebrow">Pengaturan Website</p>
        <h1>Profil Perusahaan</h1>
        <p class="text-muted mb-0">Ubah informasi yang tampil pada halaman Profil / Tentang Kami.</p>
    </div>
    <a href="<?= base_url('profil') ?>" target="_blank" class="btn btn-outline-secondary">
        <i class="bi bi-eye me-1"></i> Lihat Halaman Profil
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card form-admin">
            <form action="<?= base_url('dashboard/company-profile/update') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="nama_restoran" class="form-label">Nama Restoran</label>
                    <input type="text" class="form-control" id="nama_restoran" name="nama_restoran" value="<?= old('nama_restoran', $profile['nama_restoran'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="sejarah" class="form-label">Sejarah / Tentang Kami</label>
                    <textarea class="form-control" id="sejarah" name="sejarah" rows="7" required><?= old('sejarah', $profile['sejarah'] ?? '') ?></textarea>
                    <small class="text-muted">Teks ini muncul di halaman profil dan bagian profil pada beranda.</small>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= old('alamat', $profile['alamat'] ?? '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="jam_operasional" class="form-label">Jam Operasional</label>
                    <input type="text" class="form-control" id="jam_operasional" name="jam_operasional" value="<?= old('jam_operasional', $profile['jam_operasional'] ?? '') ?>" required>
                    <small class="text-muted">Contoh: Setiap hari, 07:30 - 19:30 WIB</small>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="reset" class="btn btn-light">Reset</button>
                    <button type="submit" class="btn btn-admin-primary">
                        <i class="bi bi-save me-1"></i> Simpan Profil Perusahaan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card helper-card h-100">
            <h5 class="fw-bold mb-3">Ditampilkan di</h5>
            <div class="catalog-info-list">
                <div>
                    <i class="bi bi-house-heart-fill"></i>
                    <div>
                        <strong>Beranda</strong>
                        <small>Bagian profil singkat rumah makan.</small>
                    </div>
                </div>
                <div>
                    <i class="bi bi-file-person-fill"></i>
                    <div>
                        <strong>Halaman Profil</strong>
                        <small>Sejarah, alamat, dan jam operasional.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
