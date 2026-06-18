<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content') ?>
<?php
    $profile = $profile ?? [];
    $waNumber = preg_replace('/\D+/', '', (string) ($profile['whatsapp'] ?? '6282126834239'));
    $waText = rawurlencode('Halo Admin RM. Ibu Iroh, saya ingin bertanya tentang menu yang tersedia.');
?>
<section class="hero-section" id="beranda">
    <div class="container py-4">
        <p class="eyebrow">Tradisi Rasa Sejak Dulu</p>
        <h1 class="hero-title font-serif">RM. Ibu Iroh</h1>
        <p class="lead hero-text">Menyajikan hidangan istimewa dengan resep keluarga. Segar, nikmat, dan penuh kenangan.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
            <a href="<?= base_url('menu') ?>" class="btn btn-orange btn-lg px-4">Lihat Menu</a>
            <a href="<?= base_url('kontak') ?>" class="btn btn-outline-light btn-lg px-4">Kontak Kami</a>
        </div>
    </div>
</section>

<section class="section" id="profil">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-md-5">
                <figure class="profile-image-wrap shadow-sm mb-0">
                    <img src="<?= base_url('images/contoh.png') ?>" alt="Interior RM. Ibu Iroh" class="profile-image">
                </figure>
            </div>
            <div class="col-md-7 ps-md-5">
                <p class="eyebrow dark">Profil</p>
                <h2 class="font-serif fw-bold fs-1 border-bottom border-2 border-warning pb-2 d-inline-block mb-4">Profil Perusahaan</h2>
                <p><?= esc($profile['sejarah'] ?? '') ?></p>
                <div class="profile-info-grid mt-4">
                    <div class="profile-info-card"><i class="bi bi-geo-alt"></i><span>Alamat</span><strong><?= esc($profile['alamat'] ?? '-') ?></strong></div>
                    <div class="profile-info-card"><i class="bi bi-clock"></i><span>Jam Operasional</span><strong><?= esc($profile['jam_operasional'] ?? '-') ?></strong></div>
                </div>
                <a href="<?= base_url('profil') ?>" class="btn btn-outline-dark mt-4">Baca Profil Lengkap</a>
            </div>
        </div>
    </div>
</section>

<section class="section bg-soft" id="menu">
    <div class="container">
        <div class="text-center mb-5">
            <p class="eyebrow dark">Menu</p>
            <h2 class="font-serif fw-bold fs-1">Menu Pilihan</h2>
            <p class="text-muted">Daftar menu diambil langsung dari database dan otomatis mengikuti kategori.</p>
        </div>

        <?php if (! empty($groupedMenus)): ?>
            <?php foreach ($groupedMenus as $category => $items): ?>
                <?php if (! empty($items)): ?>
                    <div class="menu-category-block">
                        <div class="category-heading">
                            <h3><?= esc($category) ?></h3>
                            <span><?= count($items) ?> menu</span>
                        </div>
                        <div class="row g-4">
                            <?php foreach (array_slice($items, 0, 3) as $menu): ?>
                                <div class="col-md-4">
                                    <?= view('home/partials/menu_card', ['menu' => $menu, 'profile' => $profile]) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">Belum ada menu. Login sebagai admin untuk menambahkan menu.</div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="<?= base_url('menu') ?>" class="btn btn-orange btn-lg px-5">Lihat Semua Menu</a>
        </div>
    </div>
</section>

<section class="section contact-preview" id="kontak">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <p class="eyebrow dark">Kontak</p>
                <h2 class="font-serif fw-bold fs-1">Hubungi RM. Ibu Iroh</h2>
                <p class="text-muted mb-4">Lihat lokasi kami melalui Google Maps atau langsung hubungi admin melalui WhatsApp.</p>
                <div class="contact-list">
                    <div><i class="bi bi-telephone"></i><span><?= esc($profile['telepon'] ?? '-') ?></span></div>
                    <div><i class="bi bi-geo-alt"></i><span><?= esc($profile['alamat'] ?? '-') ?></span></div>
                </div>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="https://wa.me/<?= esc($waNumber) ?>?text=<?= $waText ?>" target="_blank" class="btn btn-orange btn-lg px-4"><i class="bi bi-whatsapp me-2"></i>WhatsApp Admin</a>
                    <a href="<?= base_url('kontak') ?>" class="btn btn-outline-dark btn-lg px-4">Detail Kontak</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="map-frame shadow-sm">
                    <iframe src="<?= esc($profile['map_embed_url'] ?? '') ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
