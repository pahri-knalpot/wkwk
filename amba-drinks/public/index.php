<?php

/**
 * =====================================================
 * FRONT CONTROLLER (titik masuk semua request)
 * =====================================================
 */

session_start();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/controllers/Controller.php';

$url = trim($_GET['url'] ?? '', '/');

$routes = [
    ''                 => ['HomeController',    'index'],
    'produk'           => ['ProdukController',  'index'],
    'contact'          => ['ContactController', 'index'],

    // auth
    'login'            => ['AuthController',    'login'],
    'proses-login'     => ['AuthController',    'prosesLogin'],
    'register'         => ['AuthController',    'register'],
    'proses-register'  => ['AuthController',    'prosesRegister'],
    'logout'           => ['AuthController',    'logout'],

    // dashboard penjual
    'penjual'              => ['SellerController', 'index'],
    'penjual/tambah'       => ['SellerController', 'tambah'],
    'penjual/proses-tambah'=> ['SellerController', 'prosesTambah'],
    'penjual/edit'         => ['SellerController', 'edit'],
    'penjual/proses-edit'  => ['SellerController', 'prosesEdit'],
    'penjual/hapus'        => ['SellerController', 'hapus'],
];

if (isset($routes[$url])) {
    [$namaController, $method] = $routes[$url];
    require_once __DIR__ . '/../app/controllers/' . $namaController . '.php';
    (new $namaController())->$method();
} else {
    http_response_code(404);
    echo "<h1>404 — Halaman tidak ditemukan</h1>";
    echo '<a href="' . BASE_URL . '/">Kembali ke Home</a>';
}
