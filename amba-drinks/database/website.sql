-- =====================================================
-- Database: website
-- Proyek  : AMBA DRINKS (MVC, multi-role pembeli & penjual)
-- =====================================================

CREATE DATABASE IF NOT EXISTS website
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE website;

-- =====================================================
-- Tabel: users
-- role: 'pembeli' (default) atau 'penjual'
-- =====================================================
CREATE TABLE IF NOT EXISTS users (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nama     VARCHAR(100)        NOT NULL,
    email    VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255)        NOT NULL,
    role     ENUM('pembeli','penjual') NOT NULL DEFAULT 'pembeli'
);

-- =====================================================
-- Tabel: produk
-- penjual_id: NULL = produk bawaan; selain itu = milik penjual
-- =====================================================
CREATE TABLE IF NOT EXISTS produk (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nama       VARCHAR(100)   NOT NULL,
    deskripsi  TEXT           NOT NULL,
    harga      INT            NOT NULL,
    gambar     VARCHAR(150)   NOT NULL,
    rating     DECIMAL(2,1)   DEFAULT 0.0,
    jml_ulasan INT            DEFAULT 0,
    badge      VARCHAR(30)    DEFAULT NULL,
    is_toplist TINYINT(1)     DEFAULT 0,
    penjual_id INT            DEFAULT NULL,
    CONSTRAINT fk_produk_penjual
        FOREIGN KEY (penjual_id) REFERENCES users(id)
        ON DELETE CASCADE
);

-- =====================================================
-- Data contoh: produk bawaan (penjual_id = NULL)
-- =====================================================
INSERT INTO produk
    (nama, deskripsi, harga, gambar, rating, jml_ulasan, badge, is_toplist)
VALUES
    ('Matcha Cloud',     'Minuman matcha ringan dan creamy, selembut awan dan bikin nagih.', 15000, 'minuman-1.jpeg', 4.8, 100, 'Favorite',    1),
    ('Chocolate Chill',  'Cokelat dingin: segar, manis dan pas saat cuaca panas.',          20000, 'minuman-2.jpeg', 4.9, 150, 'Best Seller', 1),
    ('Boba Milk Tea',    'Minuman susu teh yang lembut dengan boba kenyal yang memuaskan.',  20000, 'minuman-3.jpeg', 4.7, 98,  'Favorite',    1),
    ('Strawberry Splash','Sensasi stroberi yang manis, dingin, dan bikin nagih.',            25000, 'minuman-4.jpeg', 4.7, 95,  'Favorite',    1),
    ('Iced Cola',        'Minuman cola dingin dengan sensasi soda yang menyegarkan.',        18000, 'minuman-5.jpeg', 4.5, 80,  NULL,          0),
    ('Ice Tea Classic',  'Teh dingin segar dan ringan dengan es batu yang bikin adem.',      15000, 'minuman-6.jpeg', 4.4, 70,  NULL,          0),
    ('Creamy Milk',      'Minuman susu dingin yang lembut dan creamy.',                      22000, 'minuman-7.jpeg', 4.6, 88,  NULL,          0),
    ('Lemon Tea Fresh',  'Teh lemon dingin dengan rasa segar yang bikin rileks.',            17000, 'minuman-8.jpeg', 4.5, 75,  NULL,          0);
