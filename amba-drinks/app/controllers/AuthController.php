<?php

/**
 * Controller: Auth (Login, Register, Logout).
 */
class AuthController extends Controller
{
    /* ---------------- LOGIN ---------------- */

    public function login(): void
    {
        $this->viewPolos('auth/login');
    }

    public function prosesLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('login');
        }

        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = $this->model('User');
        $user      = $userModel->cariByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id']         = $user['id'];
            $_SESSION['nama']       = $user['nama'];
            $_SESSION['email']      = $user['email'];
            $_SESSION['role']       = $user['role'];
            $_SESSION['baru_login'] = true;   // tandai untuk popup sambutan

            // penjual diarahkan ke dashboard, pembeli ke home
            if ($user['role'] === 'penjual') {
                $this->redirect('penjual');
            }
            $this->redirect('');
        }

        $pesan = $user ? 'Password salah!' : 'Email tidak ditemukan!';
        $this->alertKembali($pesan, 'login');
    }

    /* ---------------- REGISTER ---------------- */

    public function register(): void
    {
        $this->viewPolos('auth/register');
    }

    public function prosesRegister(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('register');
        }

        $nama       = trim($_POST['nama'] ?? '');
        $email      = trim($_POST['email'] ?? '');
        $password   = $_POST['password'] ?? '';
        $konfirmasi = $_POST['konfirmasi'] ?? '';
        // Registrasi publik SELALU sebagai pembeli.
        // Akun penjual hanya dibuat manual lewat database.
        $role       = 'pembeli';

        if ($password !== $konfirmasi) {
            $this->alertKembali('Konfirmasi password tidak sama!', 'register');
        }

        $userModel = $this->model('User');

        if ($userModel->emailSudahAda($email)) {
            $this->alertKembali('Email sudah digunakan!', 'register');
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        if ($userModel->buat($nama, $email, $hash, $role)) {
            $this->alertKembali('Registrasi berhasil!', 'login');
        }

        $this->alertKembali('Registrasi gagal!', 'register');
    }

    /* ---------------- LOGOUT ---------------- */

    public function logout(): void
    {
        session_unset();
        session_destroy();
        $this->redirect('');
    }

    /* ---------------- HELPER ---------------- */

    private function alertKembali(string $pesan, string $tujuan): void
    {
        $pesanAman = htmlspecialchars($pesan, ENT_QUOTES);
        $url       = BASE_URL . '/' . ltrim($tujuan, '/');

        echo "<script>
                alert('{$pesanAman}');
                window.location='{$url}';
              </script>";
        exit;
    }
}
