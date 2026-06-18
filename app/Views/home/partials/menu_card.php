<?php
    $profile = $profile ?? [];
    $waNumber = preg_replace('/\D+/', '', (string) ($profile['whatsapp'] ?? '6282126834239'));
    $menuName = $menu['nama'] ?? 'menu RM. Ibu Iroh';
    $waText = rawurlencode('Halo Admin RM. Ibu Iroh, saya ingin bertanya tentang menu ' . $menuName . '.');
?>
<div class="card card-menu h-100 bg-white shadow-sm position-relative">
    <?php if (! empty($menu['favorit'])): ?>
        <span class="badge btn-orange position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm" style="z-index: 10;">⭐ Favorit</span>
    <?php endif; ?>

    <div class="img-container">
        <?php if (! empty($menu['gambar'])): ?>
            <img src="<?= base_url('uploads/menu/' . $menu['gambar']) ?>" alt="<?= esc($menu['nama']) ?>">
        <?php else: ?>
            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted small">
                <span>Foto menu belum tersedia</span>
            </div>
        <?php endif; ?>
    </div>

    <div class="card-body p-4 d-flex flex-column justify-content-between">
        <div>
            <small class="text-uppercase fw-bold menu-category-label"><?= esc($menu['kategori'] ?? '-') ?></small>
            <h4 class="font-serif fw-bold mb-2 mt-1"><?= esc($menu['nama']) ?></h4>
            <p class="card-text text-muted small mb-4"><?= esc($menu['deskripsi'] ?: 'Menu rumah makan tersedia di katalog.') ?></p>
        </div>
        <div>
            <h5 class="fw-bold mb-3 text-success">Rp <?= number_format($menu['harga'], 0, ',', '.') ?></h5>
            <a href="https://wa.me/<?= esc($waNumber) ?>?text=<?= $waText ?>" target="_blank" rel="noopener" class="btn btn-outline-dark w-100 py-2 rounded-3 fw-semibold">
                <i class="bi bi-whatsapp me-1"></i> Tanya via WhatsApp
            </a>
        </div>
    </div>
</div>
