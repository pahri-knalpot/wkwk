<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | AMBA DRINKS</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style-auth.css">
</head>

<body>
    <div class="auth-wrap">

        <div class="auth-side">
            <a class="auth-brand" href="<?= BASE_URL ?>/">
                <img src="<?= BASE_URL ?>/gambar/logo.png" alt="Logo">
                AMBA <span>DRINKS</span>
            </a>
            <h2>Bergabung bersama kami!</h2>
            <p>Buat akun untuk mulai memesan dan menikmati keuntungan eksklusif.</p>
            <ul class="auth-points">
                <li><i class="fa-solid fa-check"></i> Gratis &amp; cepat</li>
                <li><i class="fa-solid fa-check"></i> Riwayat pesanan tersimpan</li>
                <li><i class="fa-solid fa-check"></i> Penawaran spesial member</li>
            </ul>
        </div>

        <div class="auth-form-side">
            <div class="auth-card">
                <h1>Buat Akun Baru</h1>
                <p class="auth-sub">Isi data di bawah untuk mendaftar.</p>

                <form action="<?= BASE_URL ?>/proses-register" method="POST">
                    <div class="field">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="nama" placeholder="Nama lengkap" required>
                    </div>

                    <div class="field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <div class="field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="konfirmasi" placeholder="Konfirmasi password" required>
                    </div>

                    <button type="submit" name="register" class="auth-btn">Daftar</button>
                </form>

                <p class="auth-switch">
                    Sudah punya akun?
                    <a href="<?= BASE_URL ?>/login">Masuk di sini</a>
                </p>
            </div>
        </div>

    </div>
</body>

</html>
