<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <div>
        <p class="admin-eyebrow">Akun Admin</p>
        <h1>Profil Admin</h1>
        <p class="text-muted mb-0">Ubah data akun admin yang digunakan untuk masuk ke dashboard.</p>
    </div>
    <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card form-admin">
            <form action="<?= base_url('dashboard/profile/update') ?>" method="post">
                <?= csrf_field() ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap', $admin['nama_lengkap'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= old('username', $admin['username'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $admin['email'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="no_telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?= old('no_telepon', $admin['no_telepon'] ?? '') ?>">
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat Admin</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= old('alamat', $admin['alamat'] ?? '') ?></textarea>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak diganti">
                    </div>
                    <div class="col-md-6">
                        <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Ulangi password baru">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="reset" class="btn btn-light">Reset</button>
                    <button type="submit" class="btn btn-admin-primary">
                        <i class="bi bi-save me-1"></i> Simpan Profil Admin
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card helper-card h-100">
            <h5 class="fw-bold mb-3">Catatan</h5>
            <ol class="mb-0 ps-3">
                <li>Password hanya berubah jika kolom password baru diisi.</li>
                <li>Setelah disimpan, nama admin di sidebar ikut berubah.</li>
            </ol>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
