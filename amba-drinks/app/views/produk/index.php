<?php
$produk = $produk ?? [];

function rupiah($angka): string
{
    return 'Rp ' . number_format((int) $angka, 0, ',', '.');
}
?>

<section class="produk-page">
    <div class="section-head wrap">
        <span class="eyebrow">Produk Kami</span>
        <h2>Minuman Segar Pilihan Kami</h2>
        <p>Dibuat dari bahan berkualitas dengan rasa yang menyegarkan setiap hari.</p>
    </div>

    <div class="produk-grid wrap">
        <?php foreach ($produk as $item): ?>
            <article class="produk-card">
                <div class="produk-thumb">
                    <img src="<?= BASE_URL ?>/gambar/<?= htmlspecialchars($item['gambar']) ?>"
                         alt="<?= htmlspecialchars($item['nama']) ?>">
                    <?php if (!empty($item['badge'])): ?>
                        <span class="produk-badge"><?= htmlspecialchars($item['badge']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="produk-body">
                    <h3><?= htmlspecialchars($item['nama']) ?></h3>
                    <p><?= htmlspecialchars($item['deskripsi']) ?></p>

                    <div class="produk-foot">
                        <span class="produk-harga"><?= rupiah($item['harga']) ?></span>
                        <button class="btn-beli" data-beli>
                            <i class="fa-solid fa-cart-plus"></i> Beli
                        </button>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>
