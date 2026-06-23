<?php

/**
 * =====================================================
 * Konfigurasi Database (PDO)
 * =====================================================
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'website');

/**
 * Membuat koneksi PDO (singleton).
 */
function getConnection(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            die("Koneksi gagal : " . $e->getMessage());
        }
    }

    return $pdo;
}

/**
 * Base URL aplikasi (folder public).
 * Sesuaikan jika nama folder proyek berbeda.
 */
define('BASE_URL', '/amba-drinks/public');
