<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-outer: #162619;
            --bg-left-panel: #1b3823;
            --btn-brown: #A7522E;
            --btn-brown-hover: #8E4122;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-outer);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        /* Container Card Utama */
        .login-card {
            background-color: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            width: 100%;
            max-width: 940px;
            min-height: 540px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            display: flex;
        }

        /* Sisi Kiri (Hijau Gradasi) */
        .login-left {
            background: linear-gradient(145deg, #1f3d28, #15271a);
            width: 45%;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        /* Efek lingkaran glow halus di kiri bawah */
        .login-left::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.04);
            filter: blur(50px);
            border-radius: 50%;
            pointer-events: none;
        }

        .brand-title {
            font-family: 'Playfair Display', serif;
            color: #ffffff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .brand-subtitle {
            color: #C2A378; /* Warna emas redup */
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Kapsul transparan di bagian bawah kiri */
        .info-capsule {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 12px 24px;
            width: 90%;
            height: 48px; /* Menyerupai bar placeholder kosong pada gambar */
        }

        /* Sisi Kanan (Form Putih) */
        .login-right {
            width: 55%;
            padding: 60px 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .welcome-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: #111111;
            margin-bottom: 6px;
        }

        .welcome-subtitle {
            color: #8C8C8C;
            font-size: 0.9rem;
            margin-bottom: 35px;
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #4A4A4A;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .form-control {
            background-color: #FAFAFA;
            border: 1px solid #EAEAEA;
            border-radius: 10px;
            padding: 14px 18px;
            font-size: 0.95rem;
            color: #333333;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #C2A378;
            box-shadow: none;
        }

        .form-control::placeholder {
            color: #B5B5B5;
            font-size: 0.9rem;
        }

        /* Tombol Cokelat */
        .btn-submit {
            background-color: var(--btn-brown);
            color: #ffffff;
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            border-radius: 10px;
            padding: 14px;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.2s ease;
        }

        .btn-submit:hover {
            background-color: var(--btn-brown-hover);
            color: #ffffff;
        }

        /* Divider "atau" */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #D1D1D1;
            font-size: 0.75rem;
            margin: 25px 0;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #EAEAEA;
        }

        .divider:not(:empty)::before { margin-right: .75em; }
        .divider:not(:empty)::after { margin-left: .75em; }

        .back-link {
            text-align: center;
            font-size: 0.85rem;
            color: #8C8C8C;
        }

        .back-link a {
            color: var(--btn-brown);
            text-decoration: none;
            font-weight: 600;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card">
        
        <div class="login-left">
            <div>
                <div class="brand-title">RM. Ibu Iroh</div>
                <div class="brand-subtitle">Admin Panel</div>
            </div>
            
            <div class="info-capsule"></div>
        </div>

        <div class="login-right">
            <h2 class="welcome-title">Selamat Datang 👋</h2>
            <p class="welcome-subtitle">Masuk ke panel admin RM. Ibu Iroh</p>

            <form action="<?= base_url('auth/login_process') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-4">
                    <label for="username" class="form-label">USERNAME</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username admin" required autocomplete="off">
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">PASSWORD</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-submit">Masuk ke Dashboard</button>
            </form>

            <div class="divider">atau</div>

            <div class="back-link">
                Kembali ke <a href="<?= base_url('/') ?>">Halaman Website</a>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>