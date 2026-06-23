<?php

/**
 * BaseController — helper untuk memuat Model & merender View,
 * plus proteksi akses berdasarkan login/role.
 */
class Controller
{
    /** Memuat & menginstansiasi Model. */
    protected function model(string $nama): object
    {
        require_once __DIR__ . '/../models/Model.php';
        require_once __DIR__ . '/../models/' . $nama . '.php';
        return new $nama();
    }

    /** Render view dengan layout (header + footer). */
    protected function view(string $view, array $data = [], string $css = ''): void
    {
        extract($data);
        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/' . $view . '.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }

    /** Render view tanpa layout (mis. login/register full-screen). */
    protected function viewPolos(string $view, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }

    /** Redirect relatif terhadap BASE_URL. */
    protected function redirect(string $path = ''): void
    {
        header('Location: ' . BASE_URL . '/' . ltrim($path, '/'));
        exit;
    }

    /* ============ PROTEKSI AKSES ============ */

    /** Wajib login; jika belum → ke halaman login. */
    protected function wajibLogin(): void
    {
        if (!isset($_SESSION['id'])) {
            $this->redirect('login');
        }
    }

    /** Wajib login sebagai penjual; selain itu → ke home. */
    protected function wajibPenjual(): void
    {
        $this->wajibLogin();
        if (($_SESSION['role'] ?? '') !== 'penjual') {
            $this->redirect('');
        }
    }
}
