<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard Admin') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/admin.css') ?>" rel="stylesheet">
</head>
<?php
    $uri = service('uri');
    $segment1 = $uri->getSegment(1);
    $segment2 = $uri->getSegment(2);
    $adminName = session()->get('nama_lengkap') ?: 'Administrator';
?>
<body class="admin-body">
    <button class="admin-menu-toggle d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
        <i class="bi bi-list"></i>
    </button>

    <aside class="admin-sidebar offcanvas-lg offcanvas-start" tabindex="-1" id="adminSidebar">
        <div class="admin-brand">
            <div class="admin-avatar">RI</div>
            <div>
                <div class="fw-bold text-white">RM. Ibu Iroh</div>
                <small><?= esc($adminName) ?></small>
            </div>
        </div>

        <div class="admin-nav-title">Utama</div>
        <nav class="admin-nav">
            <a href="<?= base_url('dashboard') ?>" class="<?= $segment1 === 'dashboard' && $segment2 === '' ? 'active' : '' ?>">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="<?= base_url('dashboard/menus') ?>" class="<?= $segment2 === 'menus' ? 'active' : '' ?>">
                <i class="bi bi-egg-fried"></i> Manajemen Menu
            </a>
        </nav>

        <div class="admin-nav-title">Pengaturan Website</div>
        <nav class="admin-nav">
            <a href="<?= base_url('dashboard/company-profile') ?>" class="<?= $segment2 === 'company-profile' ? 'active' : '' ?>">
                <i class="bi bi-building-fill-gear"></i> Profil Perusahaan
            </a>
            <a href="<?= base_url('dashboard/contact-settings') ?>" class="<?= $segment2 === 'contact-settings' ? 'active' : '' ?>">
                <i class="bi bi-geo-alt-fill"></i> Kontak & Maps
            </a>
        </nav>

        <div class="admin-nav-title">Akun</div>
        <nav class="admin-nav">
            <a href="<?= base_url('dashboard/profile') ?>" class="<?= $segment2 === 'profile' ? 'active' : '' ?>">
                <i class="bi bi-person-circle"></i> Profil Admin
            </a>
            <a href="<?= base_url('/') ?>"><i class="bi bi-house"></i> Lihat Website</a>
            <a href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </nav>
    </aside>

    <main class="admin-main">
        <?= $this->include('layouts/flash') ?>
        <?= $this->renderSection('content') ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>
