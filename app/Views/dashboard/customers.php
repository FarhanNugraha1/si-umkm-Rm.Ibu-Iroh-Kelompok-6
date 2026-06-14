<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <div>
        <p class="admin-eyebrow">Pengguna</p>
        <h1>Data Pelanggan</h1>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table admin-table align-middle">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($customers)): ?>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><strong><?= esc($customer['nama_lengkap']) ?></strong></td>
                            <td><?= esc($customer['username']) ?></td>
                            <td><?= esc($customer['email']) ?></td>
                            <td><?= esc($customer['no_telepon'] ?: '-') ?></td>
                            <td><?= esc($customer['alamat'] ?: '-') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pelanggan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
