<?php
$mode   = $mode ?? 'tambah';
$produk = $produk ?? null;
$isEdit = $mode === 'edit';

$action = $isEdit ? BASE_URL . '/penjual/proses-edit' : BASE_URL . '/penjual/proses-tambah';
?>

<section class="seller">
    <div class="wrap wrap-narrow">

        <a class="back-link" href="<?= BASE_URL ?>/penjual">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Produk Saya
        </a>

        <div class="form-card">
            <h1><?= $isEdit ? 'Edit Produk' : 'Tambah Produk' ?></h1>
            <p class="form-sub">
                <?= $isEdit ? 'Perbarui detail produkmu di bawah ini.' : 'Isi detail produk yang ingin kamu jual.' ?>
            </p>

            <form action="<?= $action ?>" method="POST" enctype="multipart/form-data">
                <?php if ($isEdit): ?>
                    <input type="hidden" name="id" value="<?= (int) $produk['id'] ?>">
                <?php endif; ?>

                <label class="form-label">Nama Produk</label>
                <input class="form-input" type="text" name="nama" required
                       value="<?= $isEdit ? htmlspecialchars($produk['nama']) : '' ?>"
                       placeholder="contoh: Es Kopi Susu Gula Aren">

                <label class="form-label">Deskripsi</label>
                <textarea class="form-input" name="deskripsi" rows="3" required
                          placeholder="Ceritakan keunggulan produkmu"><?= $isEdit ? htmlspecialchars($produk['deskripsi']) : '' ?></textarea>

                <label class="form-label">Harga (Rp)</label>
                <input class="form-input" type="number" name="harga" min="1" required
                       value="<?= $isEdit ? (int) $produk['harga'] : '' ?>"
                       placeholder="contoh: 18000">

                <label class="form-label">
                    Gambar Produk
                    <?php if ($isEdit): ?>
                        <span class="hint">(kosongkan jika tidak ingin mengubah)</span>
                    <?php endif; ?>
                </label>

                <?php if ($isEdit): ?>
                    <div class="current-img">
                        <img src="<?= BASE_URL ?>/gambar/<?= htmlspecialchars($produk['gambar']) ?>" alt="gambar sekarang">
                        <span>Gambar saat ini</span>
                    </div>
                <?php endif; ?>

                <div class="upload-box" id="uploadBox">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p id="uploadText">Klik untuk pilih gambar (JPG/PNG/WebP, maks 2MB)</p>
                    <input type="file" name="gambar" id="fileInput" accept="image/png,image/jpeg,image/webp"
                           <?= $isEdit ? '' : 'required' ?>>
                    <img id="preview" alt="preview" hidden>
                </div>

                <button type="submit" class="btn btn-gold btn-block">
                    <?= $isEdit ? 'Simpan Perubahan' : 'Tambah Produk' ?>
                </button>
            </form>
        </div>

    </div>
</section>
