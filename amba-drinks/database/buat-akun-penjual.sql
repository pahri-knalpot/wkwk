-- =====================================================
-- Membuat akun PENJUAL secara manual (Opsi A)
-- =====================================================
-- Akun penjual tidak bisa dibuat lewat form register.
-- Jalankan SQL ini di phpMyAdmin (tab SQL) pada database 'website'.
--
-- Akun contoh di bawah:
--   Email    : penjual@amba.com
--   Password : penjual123
--
-- Untuk membuat penjual lain dengan password berbeda, gunakan
-- skrip database/buat-penjual.php untuk menghasilkan hash baru.
-- =====================================================

USE website;

INSERT INTO users (nama, email, password, role)
VALUES ('Penjual Satu', 'penjual@amba.com', '$2y$10$cBhmeoMBkiqV0ABDxWHPouVbZ8BGtSgjWo.XQvqCtfTz4napcJA8.', 'penjual');
