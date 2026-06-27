<?php

/**
 * =====================================================
 * Helper: Membuat Akun Penjual (Opsi A)
 * =====================================================
 * Akun penjual TIDAK bisa dibuat lewat form register publik.
 * Gunakan skrip ini untuk menghasilkan SQL INSERT yang siap
 * ditempel ke phpMyAdmin.
 *
 * CARA PAKAI:
 *   1. Edit variabel $nama, $email, $password di bawah.
 *   2. Jalankan lewat browser atau terminal:
 *        - Browser : letakkan file ini sementara di public/, buka
 *                    http://localhost/amba-drinks/public/buat-penjual.php
 *        - Terminal: php database/buat-penjual.php
 *   3. Salin output SQL-nya, jalankan di phpMyAdmin (tab SQL).
 *   4. HAPUS file ini setelah selesai (jangan biarkan di server).
 */

$nama     = "Penjual Satu";
$email    = "penjual@amba.com";
$password = "penjual123";   // ganti dengan password yang kamu mau

$hash = password_hash($password, PASSWORD_DEFAULT);

$sql = sprintf(
    "INSERT INTO users (nama, email, password, role)\n" .
    "VALUES ('%s', '%s', '%s', 'penjual');",
    addslashes($nama),
    addslashes($email),
    $hash
);

// tampilan rapi baik di terminal maupun browser
if (PHP_SAPI === 'cli') {
    echo "\n-- Jalankan SQL ini di phpMyAdmin --\n\n$sql\n\n";
    echo "Login penjual: $email / $password\n";
} else {
    header('Content-Type: text/plain; charset=utf-8');
    echo "-- Jalankan SQL ini di phpMyAdmin --\n\n$sql\n\n";
    echo "Login penjual: $email / $password\n";
    echo "\n(Jangan lupa hapus file ini setelah selesai.)";
}
