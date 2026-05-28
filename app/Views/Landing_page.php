<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F4EFE6; /* Warna krem background sesuai gambar */
            color: #2C3E2B;
        }
        .bg-dark-green { background-color: #1A3321; } /* Hijau tua Navbar & Hero */
        .bg-medium-green { background-color: #234E32; } /* Hijau Footer */
        .text-gold { color: #D4A373; }
        .btn-orange {
            background-color: #A0522D; /* Warna cokelat/oranye tombol */
            color: white;
            border: none;
        }
        .btn-orange:hover { background-color: #8B4513; color: white; }
        .font-serif { font-family: 'Playfair Display', serif; }
        
        /* Placeholder styling untuk skeleton kustom */
        .skeleton-img {
            width: 100%;
            height: 250px;
            background-color: #E0DBD3;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8C867E;
            font-style: italic;
        }
        .card-menu {
            border-radius: 15px;
            overflow: hidden;
            border: none;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark-green py-3">
        <div class="container">
            <a class="navbar-brand font-serif fs-3 fw-bold" href="#">RM. Ibu Iroh</a>
            <button class="navbar-expand-lg navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link active" href="#">BERANDA</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">PROFIL</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">MENU ANDALAN</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">KONTAK</a></li>
                    <li class="nav-item"><a class="btn btn-orange px-4 rounded-3" href="<?= base_url('login') ?>">LOGIN</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="skeleton-container" class="placeholder-glow">
        <div class="bg-dark-green text-center text-white py-5">
            <div class="container py-5">
                <span class="placeholder col-3 bg-secondary mb-3"></span>
                <h1 class="display-3 placeholder col-6 bg-secondary d-block mx-auto mb-4"></h1>
                <p class="placeholder col-8 bg-secondary d-block mx-auto"></p>
                <div class="placeholder col-2 bg-secondary py-3 mt-3 rounded"></div>
            </div>
        </div>

        <div class="container my-5 py-4">
            <div class="row align-items-center mb-5">
                <div class="col-md-5 mb-4 mb-md-0">
                    <div class="skeleton-img placeholder rounded-3">Loading Gambar...</div>
                </div>
                <div class="col-md-7">
                    <span class="placeholder col-4 bg-secondary d-block mb-3 py-2"></span>
                    <p class="placeholder col-12 bg-secondary"></p>
                    <p class="placeholder col-10 bg-secondary"></p>
                </div>
            </div>
            <div class="text-center my-5">
                <span class="placeholder col-3 bg-secondary py-3 mb-2"></span>
                <span class="placeholder col-5 bg-secondary d-block mx-auto"></span>
            </div>
        </div>
    </div>

    <div id="main-content" class="d-none">
        
        <div class="bg-dark-green text-center text-white py-5">
            <div class="container py-5">
                <p class="text-orange font-serif fst-italic text-gold fs-4">Tradisi Rasa Sejak Dulu</p>
                <h1 class="display-3 font-serif fw-bold mb-4">RM. Ibu Iroh</h1>
                <p class="lead mx-auto" style="max-width: 700px;">Menyajikan hidangan istimewa dengan resep warisan keluarga. Segar, nikmat, dan penuh kenangan.</p>
                <a href="#" class="btn btn-orange btn-lg px-4 mt-3">Lihat Menu Kami</a>
            </div>
        </div>

        <div class="container my-5 py-5">
            <div class="row align-items-center">
                <div class="col-md-5 mb-4 mb-md-0">
                    <div class="skeleton-img rounded-3 shadow-sm" style="border: 2px dashed #A09A91;">
                        Gambar Restoran/Interior
                    </div>
                </div>
                <div class="col-md-7 ps-md-5">
                    <h2 class="font-serif fw-bold fs-1 border-bottom border-2 border-warning pb-2 d-inline-block mb-4">Profil Perusahaan</h2>
                    <p>RM. Ibu Iroh didirikan berlandaskan pada kecintaan terhadap masakan tradisional nusantara. Berawal dari dapur kecil keluarga, kini kami hadir menyajikan berbagai racikan bumbu khas secara turun-temurun.</p>
                    <p class="mb-4">Komitmen kami adalah menghadirkan makanan berkelas dengan bahan-bahan yang higienis, berkualitas, dan 100% segar setiap harinya.</p>
                    
                    <div class="row g-3 text-center">
                        <div class="col-4"><div class="bg-white p-3 rounded shadow-sm">✨<br><strong>Higienis</strong></div></div>
                        <div class="col-4"><div class="bg-white p-3 rounded shadow-sm">🌿<br><strong>Bahan Segar</strong></div></div>
                        <div class="col-4"><div class="bg-white p-3 rounded shadow-sm">👩‍🍳<br><strong>Resep Asli</strong></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-5 py-4">
            <div class="text-center mb-5">
                <h2 class="font-serif fw-bold fs-1">Menu Andalan</h2>
                <p class="text-muted">Sajian istimewa yang paling digemari pelanggan kami</p>
            </div>
            
            <div class="row g-4">
                <?php foreach($menus as $index => $menu): ?>
                <div class="col-md-4">
                    <div class="card card-menu h-100 bg-white shadow-sm position-relative">
                        <?php if($menu['favorit']): ?>
                            <span class="badge btn-orange position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill">Favorit</span>
                        <?php endif; ?>
                        
                        <div class="skeleton-img" style="border-bottom: 2px dashed #A09A91;">
                            Gambar Makanan <?= $index + 1; ?>
                        </div>
                        
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="font-serif fw-bold mb-2"><?= $menu['nama']; ?></h4>
                                <p class="card-text text-muted small mb-4"><?= $menu['deskripsi']; ?></p>
                            </div>
                            <div>
                                <h5 class="text-orange fw-bold mb-3" style="color: #8B4513;"><?= $menu['harga']; ?></h5>
                                <a href="#" class="btn btn-outline-dark w-100 py-2 rounded-3">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="bg-medium-green text-white text-center py-5">
            <div class="container py-3">
                <h2 class="font-serif mb-3">Siap Mencicipi Kelezatan Hidangan Kami?</h2>
                <p class="mb-4">Hubungi kami sekarang untuk konfirmasi pemesanan atau reservasi tempat.</p>
                <a href="#" class="btn btn-success btn-lg px-4 rounded-pill">💬 Pesan via WhatsApp</a>
            </div>
        </div>

        <footer class="bg-dark-green text-white py-5 small" style="background-color: #0F2014 !important;">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5 class="font-serif fw-bold mb-3">RM. Ibu Iroh</h5>
                        <p class="text-secondary">Cita rasa otentik dengan nuansa tradisional yang khas. Melayani pesanan untuk berbagai acara.</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="font-serif fw-bold mb-3">Tautan Cepat</h5>
                        <ul class="list-unstyled text-secondary">
                            <li>Tentang Kami</li>
                            <li>Spesialitas</li>
                            <li>Cara Memesan</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5 class="font-serif fw-bold mb-3">Kontak</h5>
                        <p class="text-secondary mb-1">Alamat: Jl. Raya Makanan No. 123, Kota Kuliner</p>
                        <p class="text-secondary mb-1">Telepon: +62 812-3456-7890</p>
                        <p class="text-secondary">Jam Buka: 09:00 - 21:00 WIB</p>
                    </div>
                </div>
                <hr class="border-secondary mt-4">
                <p class="text-center text-secondary mb-0">&copy; 2026 RM. Ibu Iroh. Hak Cipta Dilindungi.</p>
            </div>
        </footer>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Simulasi loading selama 3 detik
            setTimeout(function() {
                // Sembunyikan Skeleton
                document.getElementById('skeleton-container').classList.add('d-none');
                // Tampilkan Konten Utama
                document.getElementById('main-content').classList.remove('d-none');
            }, 3000); 
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>