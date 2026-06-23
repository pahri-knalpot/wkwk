<?php
$topList = $topList ?? [];
?>

<!-- ============ HERO ============ -->
<section class="hero">
    <div class="hero-inner wrap">
        <div class="hero-text">
            <span class="hero-badge">★ Minuman segar rasa istimewa</span>
            <h1>Segarnya setiap tegukan,<br><span>Nikmatnya tak terlupakan</span></h1>
            <p>
                AMBA DRINKS menghadirkan racikan minuman terbaik — segar, creamy,
                dan dibuat dari bahan berkualitas untuk menemani harimu.
            </p>
            <div class="hero-actions">
                <a href="<?= BASE_URL ?>/produk" class="btn btn-gold">Lihat Menu</a>
                <a href="<?= BASE_URL ?>/contact" class="btn btn-outline">Hubungi Kami</a>
            </div>

            <div class="hero-stats">
                <div><strong>8+</strong><span>Varian Minuman</span></div>
                <div><strong>4.8</strong><span>Rating Pelanggan</span></div>
                <div><strong>100%</strong><span>Bahan Segar</span></div>
            </div>
        </div>

        <div class="hero-image">
            <img src="<?= BASE_URL ?>/gambar/bg-owner.jpeg" alt="AMBA DRINKS">
        </div>
    </div>
</section>

<!-- ============ KEUNGGULAN ============ -->
<section class="features wrap">
    <div class="feature-card">
        <i class="fa-solid fa-leaf"></i>
        <h3>Bahan Segar</h3>
        <p>Dibuat harian dari bahan pilihan berkualitas tinggi.</p>
    </div>
    <div class="feature-card">
        <i class="fa-solid fa-bolt"></i>
        <h3>Cepat Disajikan</h3>
        <p>Pesanan diproses cepat tanpa mengurangi kualitas rasa.</p>
    </div>
    <div class="feature-card">
        <i class="fa-solid fa-heart"></i>
        <h3>Rasa Favorit</h3>
        <p>Racikan creamy yang bikin nagih di setiap tegukan.</p>
    </div>
</section>

<!-- ============ TOP LIST ============ -->
<section class="toplist">
    <div class="section-head">
        <span class="eyebrow">Top List</span>
        <h2>Menu Andalan Kami</h2>
        <p>Pilihan paling favorit yang selalu dicari pelanggan setia AMBA DRINKS.</p>
    </div>

    <div class="toplist-slider wrap">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php foreach ($topList as $item): ?>
                    <div class="swiper-slide">
                        <article class="drink-card">
                            <div class="drink-thumb">
                                <img src="<?= BASE_URL ?>/gambar/<?= htmlspecialchars($item['gambar']) ?>"
                                     alt="<?= htmlspecialchars($item['nama']) ?>">
                                <?php if (!empty($item['badge'])): ?>
                                    <span class="drink-badge"><?= htmlspecialchars($item['badge']) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="drink-body">
                                <div class="drink-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <?= htmlspecialchars($item['rating']) ?>
                                    <span>(<?= htmlspecialchars($item['jml_ulasan']) ?>)</span>
                                </div>
                                <h3><?= htmlspecialchars($item['nama']) ?></h3>
                                <p><?= htmlspecialchars($item['deskripsi']) ?></p>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="swiper-pagination"></div>
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>

<!-- ============ CTA ============ -->
<section class="cta wrap">
    <div class="cta-box">
        <h2>Siap mencoba kesegarannya?</h2>
        <p>Pesan minuman favoritmu sekarang dan rasakan bedanya.</p>
        <a href="<?= BASE_URL ?>/produk" class="btn btn-gold">Pesan Sekarang</a>
    </div>
</section>
