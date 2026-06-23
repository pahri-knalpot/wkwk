<?php
$css = $css ?? '';
$current = trim($_GET['url'] ?? '', '/');

/** Tandai link aktif. */
function navActive(string $route, string $current): string
{
    return $route === $current ? ' aria-current="page" class="active"' : '';
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>/gambar/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMBA DRINKS</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
    <?php if ($css): ?>
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/<?= htmlspecialchars($css) ?>">
    <?php endif; ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>

    <!-- ============ NAVBAR ============ -->
    <nav class="navbar">
        <div class="nav-inner">
            <a class="brand" href="<?= BASE_URL ?>/">
                <img src="<?= BASE_URL ?>/gambar/logo.png" alt="Logo AMBA DRINKS">
                AMBA <span>DRINKS</span>
            </a>

            <ul class="nav-links">
                <?php if (($_SESSION['role'] ?? '') === 'penjual'): ?>
                    <li><a href="<?= BASE_URL ?>/penjual"<?= navActive('penjual', $current) ?>>Dashboard</a></li>
                    <li class="nav-user">
                        <span class="greet">Hai, <?= htmlspecialchars($_SESSION['nama']) ?></span>
                        <button class="nav-cta" type="button" data-open-modal="modal-logout">Logout</button>
                    </li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL ?>/"<?= navActive('', $current) ?>>Home</a></li>
                    <li><a href="<?= BASE_URL ?>/produk"<?= navActive('produk', $current) ?>>Produk</a></li>
                    <li><a href="<?= BASE_URL ?>/contact"<?= navActive('contact', $current) ?>>Kontak</a></li>
                    <?php if (isset($_SESSION['id'])): ?>
                        <li class="nav-user">
                            <span class="greet">Hai, <?= htmlspecialchars($_SESSION['nama']) ?></span>
                            <button class="nav-cta" type="button" data-open-modal="modal-logout">Logout</button>
                        </li>
                    <?php else: ?>
                        <li><a class="nav-cta" href="<?= BASE_URL ?>/login">Login</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <button class="hamburger" aria-label="Buka menu">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- ============ SIDEBAR (mobile) ============ -->
    <div class="overlay"></div>
    <aside class="sidebar">
        <i class="fa-solid fa-xmark close-icon" aria-label="Tutup menu"></i>
        <ul>
            <?php if (($_SESSION['role'] ?? '') === 'penjual'): ?>
                <li><a href="<?= BASE_URL ?>/penjual">Dashboard</a></li>
                <li><a href="#" data-open-modal="modal-logout">Logout</a></li>
            <?php else: ?>
                <li><a href="<?= BASE_URL ?>/">Home</a></li>
                <li><a href="<?= BASE_URL ?>/produk">Produk</a></li>
                <li><a href="<?= BASE_URL ?>/contact">Kontak</a></li>
                <?php if (isset($_SESSION['id'])): ?>
                    <li><a href="#" data-open-modal="modal-logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL ?>/login">Login</a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </aside>

    <main>
