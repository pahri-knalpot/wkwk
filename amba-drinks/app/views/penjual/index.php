<?php
$produk = $produk ?? [];

function rupiah($angka): string
{
    return 'Rp ' . number_format((int) $angka, 0, ',', '.');
}

/** Tentukan src gambar: upload (produk/...) atau seed bawaan. */
function gambarSrc(string $g): string
{
    return BASE_URL . '/gambar/' . $g;
}
?>

<section class="seller">
    <div class="wrap">

        <div class="seller-head">
            <div>
                <span class="eyebrow">Dashboard Penjual</span>
                <h1>Produk Saya</h1>
                <p>Kelola produk jualanmu — tambah, edit, atau hapus.</p>
            </div>
            <a href="<?= BASE_URL ?>/penjual/tambah" class="btn btn-gold">
                <i class="fa-solid fa-plus"></i> Tambah Produk
            </a>
        </div>

        <?php if (empty($produk)): ?>
            <div class="seller-empty">
                <i class="fa-solid fa-box-open"></i>
                <h3>Belum ada produk</h3>
                <p>Mulai jualan dengan menambahkan produk pertamamu.</p>
                <a href="<?= BASE_URL ?>/penjual/tambah" class="btn btn-gold">Tambah Produk</a>
            </div>
        <?php else: ?>
            <div class="seller-table">
                <div class="seller-row seller-row-head">
                    <span>Produk</span>
                    <span>Harga</span>
                    <span class="aksi-col">Aksi</span>
                </div>

                <?php foreach ($produk as $item): ?>
                    <div class="seller-row">
                        <div class="seller-prod">
                            <img src="<?= gambarSrc($item['gambar']) ?>" alt="<?= htmlspecialchars($item['nama']) ?>">
                            <div>
                                <h4><?= htmlspecialchars($item['nama']) ?></h4>
                                <p><?= htmlspecialchars(strlen($item['deskripsi']) > 60 ? substr($item['deskripsi'], 0, 60) . '…' : $item['deskripsi']) ?></p>
                            </div>
                        </div>

                        <span class="seller-harga"><?= rupiah($item['harga']) ?></span>

                        <div class="seller-aksi">
                            <a class="btn-icon edit" href="<?= BASE_URL ?>/penjual/edit&id=<?= $item['id'] ?>"
                               title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <a class="btn-icon hapus"
                               href="<?= BASE_URL ?>/penjual/hapus&id=<?= $item['id'] ?>"
                               data-confirm="Hapus produk &quot;<?= htmlspecialchars($item['nama']) ?>&quot;?"
                               title="Hapus"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
