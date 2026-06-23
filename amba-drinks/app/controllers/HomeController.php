<?php

class HomeController extends Controller
{
    public function index(): void
    {
        $produkModel = $this->model('Produk');

        // flag sambutan login → muncul sekali lalu hapus
        $baruLogin = $_SESSION['baru_login'] ?? false;
        unset($_SESSION['baru_login']);

        $this->view('home/index', [
            'topList'   => $produkModel->topList(),
            'baruLogin' => $baruLogin,
        ], 'style-home.css');
    }
}
