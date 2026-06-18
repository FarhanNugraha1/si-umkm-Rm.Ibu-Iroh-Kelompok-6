<?= $this->extend('layouts/frontend') ?>

<?= $this->section('content') ?>
<section class="page-hero compact-page-hero">
    <div class="container">
        <p class="eyebrow">Daftar Menu</p>
        <h1 class="font-serif">Menu RM. Ibu Iroh</h1>
        <p>Menu ditampilkan berdasarkan data terbaru dari database dan dikelompokkan sesuai kategori.</p>
    </div>
</section>

<section class="section bg-soft">
    <div class="container">
        <div class="category-nav mb-4">
            <?php foreach ($groupedMenus as $category => $items): ?>
                <a href="#kategori-<?= url_title($category, '-', true) ?>" class="category-pill"><?= esc($category) ?> <span><?= count($items) ?></span></a>
            <?php endforeach; ?>
        </div>

        <?php if (! empty($groupedMenus)): ?>
            <?php foreach ($groupedMenus as $category => $items): ?>
                <div class="menu-category-block" id="kategori-<?= url_title($category, '-', true) ?>">
                    <div class="category-heading">
                        <h2 class="font-serif"><?= esc($category) ?></h2>
                        <span><?= count($items) ?> menu tersedia</span>
                    </div>

                    <?php if (! empty($items)): ?>
                        <div class="row g-4">
                            <?php foreach ($items as $menu): ?>
                                <div class="col-md-6 col-lg-4">
                                    <?= view('home/partials/menu_card', ['menu' => $menu, 'profile' => $profile]) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">Belum ada menu pada kategori ini.</div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">Belum ada data menu.</div>
        <?php endif; ?>
    </div>
</section>
<?= $this->endSection() ?>
