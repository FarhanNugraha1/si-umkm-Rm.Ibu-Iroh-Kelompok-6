<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="register-card">
    <div class="register-left">
        <div>
            <h2>RM. Ibu Iroh</h2>
            <small>BUAT AKUN BARU</small>
            <hr class="bg-light my-4" style="width: 100%; opacity: 0.3;">
            <p style="font-size: 14px; opacity: 0.9;">Bergabunglah dengan kami untuk menikmati kemudahan pemesanan dan promo spesial!</p>
        </div>
    </div>

    <div class="register-right">
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <h3 class="auth-title">Daftar Akun Baru ✨</h3>
        <p class="text-muted small">Isi formulir di bawah untuk membuat akun</p>

        <form action="<?= base_url('auth/register_process') ?>" method="POST" id="registerForm">
            <?= csrf_field() ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">NAMA LENGKAP</label>
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" value="<?= old('nama_lengkap') ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">USERNAME</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="<?= old('username') ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">EMAIL</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email aktif" value="<?= old('email') ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">NOMOR TELEPON</label>
                    <input type="tel" name="no_telepon" class="form-control" placeholder="Masukkan nomor telepon" value="<?= old('no_telepon') ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">ALAMAT</label>
                <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan alamat lengkap"><?= old('alamat') ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">PASSWORD</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                    <div class="password-requirements">
                        <small>Password harus mengandung:</small>
                        <ul>
                            <li id="char-length" class="requirement-unmet">Minimal 8 karakter</li>
                            <li id="char-number" class="requirement-unmet">Minimal 1 angka</li>
                            <li id="char-upper" class="requirement-unmet">Minimal 1 huruf besar</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small fw-bold">KONFIRMASI PASSWORD</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Ulangi password" required>
                    <div class="password-requirements">
                        <small id="password-match" class="requirement-unmet">Password belum cocok</small>
                    </div>
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="terms" required>
                <label class="form-check-label small" for="terms">
                    Saya menyetujui <a href="#" class="auth-link">Syarat & Ketentuan</a> dan <a href="#" class="auth-link">Kebijakan Privasi</a>
                </label>
            </div>

            <button type="submit" class="btn-submit">Daftar Sekarang</button>
        </form>

        <div class="divider">
            <span>sudah punya akun?</span>
        </div>

        <a href="<?= base_url('login') ?>" class="btn-login text-center">Masuk ke Akun</a>

        <hr class="text-muted my-4">
        <div class="text-center small text-muted">
            Kembali ke <a href="<?= base_url('/') ?>" class="auth-link">Halaman Website</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
