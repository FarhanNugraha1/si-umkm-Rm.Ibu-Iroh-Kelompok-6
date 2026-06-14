<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'RM. Ibu Iroh') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="100">
    <nav class="navbar navbar-expand-lg navbar-dark site-navbar sticky-top shadow">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">RM. Ibu Iroh</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-lg-center gap-lg-3">
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('/') ?>#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>#profil">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>#menu-andalan">Menu Andalan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>#kontak">Kontak</a></li>

                    <?php if (session()->get('isLoggedIn')): ?>
                        <?php if (session()->get('role') === 'admin'): ?>
                            <li class="nav-item"><a class="btn btn-orange px-4 rounded-3" href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('my-orders') ?>">Pesanan Saya</a></li>
                            <li class="nav-item"><a class="btn btn-orange px-4 rounded-3" href="<?= base_url('order') ?>">Pesan</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('logout') ?>">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="btn btn-orange px-4 rounded-3" href="<?= base_url('login') ?>">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('register') ?>">Daftar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?php
            $success = session()->getFlashdata('success');
            $error   = session()->getFlashdata('error');
        ?>
        <?php if ($success || $error): ?>
            <div class="container flash-area">
                <?php if ($success): ?>
                    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                        <?= $success ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        <?= $error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </main>

    <footer class="site-footer small">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5 class="font-serif fw-bold mb-3">RM. Ibu Iroh</h5>
                    <p class="text-white-50">Cita rasa otentik dengan nuansa tradisional yang khas. Melayani pesanan harian dan keluarga.</p>
                </div>
                <div class="col-md-4">
                    <h5 class="font-serif fw-bold mb-3">Tautan Cepat</h5>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-1"><a href="<?= base_url('/') ?>#profil">Tentang Kami</a></li>
                        <li class="mb-1"><a href="<?= base_url('/') ?>#menu-andalan">Menu Andalan</a></li>
                        <li><a href="<?= base_url('order') ?>">Pemesanan</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="font-serif fw-bold mb-3">Kontak</h5>
                    <p class="text-white-50 mb-1">Alamat: Subang, Jawa Barat</p>
                    <p class="text-white-50 mb-1">Telepon: +62 812-3456-7890</p>
                    <p class="text-white-50">Jam Buka: 09:00 - 21:00 WIB</p>
                </div>
            </div>
            <hr class="border-secondary mt-4">
            <p class="text-center text-white-50 mb-0">&copy; <?= date('Y') ?> RM. Ibu Iroh. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>
