<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="login-card">
    <div class="login-left">
        <div>
            <h2>RM. Ibu Iroh</h2>
            <small>LOGIN ADMIN WEBSITE</small>
        </div>
    </div>

    <div class="login-right">
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <h3 class="auth-title">Login Admin 👋</h3>
        <p class="text-muted small">Masuk untuk mengelola katalog menu RM. Ibu Iroh.</p>

        <form action="<?= base_url('auth/login_process') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label small fw-bold">USERNAME / EMAIL</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username atau email" value="<?= old('username') ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold">PASSWORD</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn-submit">Masuk Dashboard</button>
        </form>

        <hr class="text-muted my-4">
        <div class="text-center small text-muted">
            Kembali ke <a href="<?= base_url('/') ?>" class="auth-link">Halaman Website</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
