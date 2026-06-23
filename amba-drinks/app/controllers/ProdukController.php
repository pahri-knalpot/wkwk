<?php

class ProdukController extends Controller
{
    public function index(): void
    {
        $produkModel = $this->model('Produk');

        $baruLogin = $_SESSION['baru_login'] ?? false;
        unset($_SESSION['baru_login']);

        $this->view('produk/index', [
            'produk'    => $produkModel->semua(),
            'baruLogin' => $baruLogin,
        ], 'style-product.css');
    }
}
