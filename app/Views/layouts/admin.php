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
<body class="admin-body">
    <button class="admin-menu-toggle d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
        <i class="bi bi-list"></i>
    </button>

    <aside class="admin-sidebar offcanvas-lg offcanvas-start" tabindex="-1" id="adminSidebar">
        <div class="admin-brand">
            <div class="admin-avatar">RI</div>
            <div>
                <div class="fw-bold text-white">RM. Ibu Iroh</div>
                <small>Administrator</small>
            </div>
        </div>

        <div class="admin-nav-title">Utama</div>
        <nav class="admin-nav">
            <a href="<?= base_url('dashboard') ?>" class="<?= service('uri')->getSegment(1) === 'dashboard' && service('uri')->getSegment(2) === '' ? 'active' : '' ?>">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="<?= base_url('dashboard/menus') ?>" class="<?= service('uri')->getSegment(2) === 'menus' ? 'active' : '' ?>">
                <i class="bi bi-egg-fried"></i> Manajemen Menu
            </a>
            <a href="<?= base_url('dashboard/orders') ?>" class="<?= service('uri')->getSegment(2) === 'orders' ? 'active' : '' ?>">
                <i class="bi bi-receipt"></i> Pesanan
            </a>
            <a href="<?= base_url('dashboard/customers') ?>" class="<?= service('uri')->getSegment(2) === 'customers' ? 'active' : '' ?>">
                <i class="bi bi-people"></i> Pelanggan
            </a>
        </nav>

        <div class="admin-nav-title">Akun</div>
        <nav class="admin-nav">
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
