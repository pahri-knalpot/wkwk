<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AMBA DRINKS</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style-auth.css">
</head>

<body>
    <div class="auth-wrap">

        <!-- panel kiri (brand) -->
        <div class="auth-side">
            <a class="auth-brand" href="<?= BASE_URL ?>/">
                <img src="<?= BASE_URL ?>/gambar/logo.png" alt="Logo">
                AMBA <span>DRINKS</span>
            </a>
            <h2>Selamat datang kembali!</h2>
            <p>Masuk untuk menikmati menu favoritmu dan penawaran terbaik dari kami.</p>
            <ul class="auth-points">
                <li><i class="fa-solid fa-check"></i> Minuman segar setiap hari</li>
                <li><i class="fa-solid fa-check"></i> Pemesanan cepat &amp; mudah</li>
                <li><i class="fa-solid fa-check"></i> Promo khusus member</li>
            </ul>
        </div>

        <!-- panel kanan (form) -->
        <div class="auth-form-side">
            <div class="auth-card">
                <h1>Masuk ke Akun</h1>
                <p class="auth-sub">Silakan login untuk melanjutkan.</p>

                <form action="<?= BASE_URL ?>/proses-login" method="POST">
                    <div class="field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" placeholder="Masukkan email" required>
                    </div>

                    <div class="field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Masukkan password" required>
                    </div>

                    <button type="submit" name="login" class="auth-btn">Masuk</button>
                </form>

                <p class="auth-switch">
                    Belum punya akun?
                    <a href="<?= BASE_URL ?>/register">Daftar sekarang</a>
                </p>
            </div>
        </div>

    </div>
</body>

</html>
