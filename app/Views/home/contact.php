<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content') ?>
<?php
    $waNumber = preg_replace('/\D+/', '', (string) ($profile['whatsapp'] ?? '6282126834239'));
    $waText = rawurlencode('Halo Admin RM. Ibu Iroh, saya ingin bertanya tentang menu yang tersedia.');
?>
<section class="page-hero compact-page-hero">
    <div class="container">
        <p class="eyebrow">Kontak</p>
        <h1 class="font-serif">Hubungi Kami</h1>
        <p>Lihat lokasi RM. Ibu Iroh dan hubungi admin melalui WhatsApp.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="contact-card h-100">
                    <p class="eyebrow dark">Informasi Kontak</p>
                    <h2 class="font-serif fw-bold mb-4">RM. Ibu Iroh</h2>

                    <div class="contact-list dark-list">
                        <div><i class="bi bi-geo-alt-fill"></i><span><?= esc($profile['alamat'] ?? '-') ?></span></div>
                        <div><i class="bi bi-telephone-fill"></i><span><?= esc($profile['telepon'] ?? '-') ?></span></div>
                        <div><i class="bi bi-clock-fill"></i><span><?= esc($profile['jam_operasional'] ?? '-') ?></span></div>
                    </div>

                    <a href="https://wa.me/<?= esc($waNumber) ?>?text=<?= $waText ?>" target="_blank" rel="noopener" class="btn btn-orange btn-lg w-100 mt-4">
                        <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp Admin
                    </a>
                    <a href="<?= esc($profile['map_link'] ?? '#') ?>" target="_blank" rel="noopener" class="btn btn-outline-dark btn-lg w-100 mt-3">
                        <i class="bi bi-map me-2"></i>Buka di Google Maps
                    </a>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="map-frame contact-map-frame shadow-sm h-100">
                    <iframe src="<?= esc($profile['map_embed_url'] ?? '') ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
