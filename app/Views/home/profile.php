<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content') ?>
<section class="page-hero compact-page-hero">
    <div class="container">
        <p class="eyebrow">Tentang Kami</p>
        <h1 class="font-serif">Profil RM. Ibu Iroh</h1>
        <p>Informasi sejarah, alamat, dan jam operasional rumah makan.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <figure class="profile-image-wrap shadow-sm mb-0">
                    <img src="<?= base_url('images/contoh.png') ?>" alt="Interior RM. Ibu Iroh" class="profile-image profile-image-tall">
                </figure>
            </div>
            <div class="col-lg-7">
                <p class="eyebrow dark">Sejarah</p>
                <h2 class="font-serif fw-bold fs-1 mb-3"><?= esc($profile['nama_restoran'] ?? 'RM. Ibu Iroh') ?></h2>
                <p class="section-text fs-5"><?= esc($profile['sejarah'] ?? '-') ?></p>

                <div class="profile-detail-list mt-4">
                    <div class="profile-detail-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <div>
                            <span>Alamat</span>
                            <strong><?= esc($profile['alamat'] ?? '-') ?></strong>
                        </div>
                    </div>
                    <div class="profile-detail-item">
                        <i class="bi bi-clock-fill"></i>
                        <div>
                            <span>Jam Operasional</span>
                            <strong><?= esc($profile['jam_operasional'] ?? '-') ?></strong>
                        </div>
                    </div>
                    <div class="profile-detail-item">
                        <i class="bi bi-telephone-fill"></i>
                        <div>
                            <span>Telepon</span>
                            <strong><?= esc($profile['telepon'] ?? '-') ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
