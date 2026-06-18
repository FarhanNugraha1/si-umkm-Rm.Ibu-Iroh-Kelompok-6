<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <div>
        <p class="admin-eyebrow">Pengaturan Website</p>
        <h1>Kontak & Maps</h1>
        <p class="text-muted mb-0">Ubah nomor telepon, WhatsApp admin, dan Google Maps pada halaman kontak.</p>
    </div>
    <a href="<?= base_url('kontak') ?>" target="_blank" class="btn btn-outline-secondary">
        <i class="bi bi-eye me-1"></i> Lihat Halaman Kontak
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card form-admin">
            <form action="<?= base_url('dashboard/contact-settings/update') ?>" method="post">
                <?= csrf_field() ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" value="<?= old('telepon', $profile['telepon'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="whatsapp" class="form-label">Nomor WhatsApp Admin</label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= old('whatsapp', $profile['whatsapp'] ?? '') ?>" required>
                        <small class="text-muted">Gunakan format angka, contoh: 6282126834239</small>
                    </div>
                </div>

                <div class="mt-3">
                    <label for="map_embed_url" class="form-label">Google Maps Embed URL</label>
                    <textarea class="form-control" id="map_embed_url" name="map_embed_url" rows="4" placeholder="https://www.google.com/maps?...&output=embed"><?= old('map_embed_url', $profile['map_embed_url'] ?? '') ?></textarea>
                    <small class="text-muted">URL ini dipakai untuk peta interaktif di halaman kontak. Pastikan link mengandung <code>output=embed</code>.</small>
                </div>

                <div class="mt-3">
                    <label for="map_link" class="form-label">Google Maps Link Biasa</label>
                    <textarea class="form-control" id="map_link" name="map_link" rows="3" placeholder="https://www.google.com/maps/search/?api=1&query=..."><?= old('map_link', $profile['map_link'] ?? '') ?></textarea>
                    <small class="text-muted">URL ini dipakai pada tombol “Buka di Google Maps”.</small>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="reset" class="btn btn-light">Reset</button>
                    <button type="submit" class="btn btn-admin-primary">
                        <i class="bi bi-save me-1"></i> Simpan Kontak
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card helper-card h-100">
            <h5 class="fw-bold mb-3">Cara Ambil Embed Maps</h5>
            <ol class="mb-4 ps-3">
                <li>Buka lokasi di Google Maps.</li>
                <li>Klik Bagikan.</li>
                <li>Pilih Sematkan peta.</li>
                <li>Ambil URL di dalam atribut <code>src="..."</code>.</li>
            </ol>
            <div class="alert alert-warning mb-0 small">
                Kalau link embed kosong, halaman kontak tetap tampil, tapi iframe peta bisa kosong.
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
