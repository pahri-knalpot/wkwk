-- =====================================================
-- MIGRASI: tambah fitur multi-role (pembeli & penjual)
-- Jalankan ini jika database `website` SUDAH ADA dan
-- kamu tidak mau menghapus data lama.
-- =====================================================

USE website;

-- 1) Tambah kolom role di tabel users (default: pembeli)
ALTER TABLE users
    ADD COLUMN role ENUM('pembeli', 'penjual') NOT NULL DEFAULT 'pembeli' AFTER password;

-- 2) Tambah kolom penjual_id di tabel produk
--    NULL = produk bawaan/seed (bukan milik penjual tertentu)
ALTER TABLE produk
    ADD COLUMN penjual_id INT DEFAULT NULL AFTER is_toplist;

-- 3) (Opsional) relasi ke users. Boleh dilewati jika tidak perlu.
ALTER TABLE produk
    ADD CONSTRAINT fk_produk_penjual
    FOREIGN KEY (penjual_id) REFERENCES users(id)
    ON DELETE CASCADE;
