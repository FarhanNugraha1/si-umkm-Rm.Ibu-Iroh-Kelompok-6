<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content') ?>
<section class="hero-section" id="beranda">
    <div class="container py-4">
        <p class="eyebrow">Tradisi Rasa Sejak Dulu</p>
        <h1 class="hero-title font-serif">RM. Ibu Iroh</h1>
        <p class="lead hero-text">Menyajikan hidangan istimewa dengan resep warisan keluarga. Segar, nikmat, dan penuh kenangan.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
            <a href="#menu-andalan" class="btn btn-orange btn-lg px-4">Lihat Menu Kami</a>
            <a href="<?= base_url('order') ?>" class="btn btn-outline-light btn-lg px-4">Pesan Online</a>
        </div>
    </div>
</section>

<section class="section" id="profil">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 mb-4 mb-md-0">
                <figure class="profile-image-wrap shadow-sm mb-0">
                    <img 
                        src="<?= base_url('images/contoh.png') ?>" 
                        alt="Interior RM. Ibu Iroh" 
                        class="profile-image"
                    >
                </figure>
            </div>
            <div class="col-md-7 ps-md-5">
                <h2 class="font-serif fw-bold fs-1 border-bottom border-2 border-warning pb-2 d-inline-block mb-4">Profil Perusahaan</h2>
                <p>RM. Ibu Iroh didirikan berlandaskan pada kecintaan terhadap masakan tradisional nusantara. Berawal dari dapur kecil keluarga, kini kami hadir menyajikan berbagai racikan bumbu khas secara turun-temurun.</p>
                <p class="mb-4">Komitmen kami adalah menghadirkan makanan berkelas dengan bahan-bahan yang higienis, berkualitas, dan segar setiap harinya.</p>

                <div class="row g-3 text-center">
                    <div class="col-4"><div class="bg-white p-3 rounded shadow-sm">✨<br><strong>Higienis</strong></div></div>
                    <div class="col-4"><div class="bg-white p-3 rounded shadow-sm">🌿<br><strong>Bahan Segar</strong></div></div>
                    <div class="col-4"><div class="bg-white p-3 rounded shadow-sm">👩‍🍳<br><strong>Resep Asli</strong></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section bg-soft" id="menu-andalan">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="font-serif fw-bold fs-1">Menu Andalan</h2>
            <p class="text-muted">Sajian istimewa yang paling digemari pelanggan kami</p>
        </div>

        <div class="row g-4 justify-content-center">
            <?php if (! empty($menus)): ?>
                <?php foreach ($menus as $index => $menu): ?>
                    <div class="col-md-4">
                        <div class="card card-menu h-100 bg-white shadow-sm position-relative">
                            <?php if (! empty($menu['favorit'])): ?>
                                <span class="badge btn-orange position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm" style="z-index: 10;">⭐ Favorit</span>
                            <?php endif; ?>

                            <div class="img-container">
                                <?php if (! empty($menu['gambar'])): ?>
                                    <img src="<?= base_url('uploads/menu/' . $menu['gambar']) ?>" alt="<?= esc($menu['nama']) ?>">
                                <?php else: ?>
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted small">
                                        <span>Gambar Makanan <?= $index + 1 ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <?php if (! empty($menu['kategori'])): ?>
                                        <small class="text-uppercase fw-bold" style="color:#A0522D;"><?= esc($menu['kategori']) ?></small>
                                    <?php endif; ?>
                                    <h4 class="font-serif fw-bold mb-2 mt-1"><?= esc($menu['nama']) ?></h4>
                                    <p class="card-text text-muted small mb-4" style="min-height: 40px;"><?= esc($menu['deskripsi'] ?: 'Menu rumah makan siap dipesan.') ?></p>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-3 text-success">Rp <?= number_format($menu['harga'], 0, ',', '.') ?></h5>
                                    <a href="<?= base_url('order') ?>" class="btn btn-outline-dark w-100 py-2 rounded-3 fw-semibold">Pesan Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">Belum ada menu. Login sebagai admin untuk menambahkan menu.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="bg-medium-green text-white text-center py-5" id="kontak">
    <div class="container py-3">
        <h2 class="font-serif mb-3">Siap Mencicipi Kelezatan Hidangan Kami?</h2>
        <p class="mb-4">Buat pesanan online atau hubungi kami untuk konfirmasi pemesanan.</p>
        <a href="<?= base_url('order') ?>" class="btn btn-orange btn-lg px-5 rounded-pill shadow">Pesan Online</a>
    </div>
</section>
<?= $this->endSection() ?>
