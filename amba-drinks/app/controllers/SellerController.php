<?php

/**
 * =====================================================
 * Controller: Seller (Dashboard Penjual)
 * =====================================================
 * Hanya bisa diakses oleh user dengan role 'penjual'.
 * Fitur: lihat, tambah, edit, hapus produk miliknya sendiri.
 */
class SellerController extends Controller
{
    /** Folder upload (relatif terhadap public/). */
    private string $uploadDir;

    public function __construct()
    {
        $this->uploadDir = __DIR__ . '/../../public/gambar/produk/';
    }

    /* ---------------- DASHBOARD ---------------- */

    public function index(): void
    {
        $this->wajibPenjual();

        $produkModel = $this->model('Produk');
        $produk      = $produkModel->milikPenjual((int) $_SESSION['id']);

        // ambil flag sambutan lalu hapus → popup muncul sekali
        $baruLogin = $_SESSION['baru_login'] ?? false;
        unset($_SESSION['baru_login']);

        $this->view('penjual/index', [
            'produk'    => $produk,
            'baruLogin' => $baruLogin,
        ], 'style-seller.css');
    }

    /* ---------------- FORM TAMBAH ---------------- */

    public function tambah(): void
    {
        $this->wajibPenjual();
        $this->view('penjual/form', [
            'mode'   => 'tambah',
            'produk' => null,
        ], 'style-seller.css');
    }

    public function prosesTambah(): void
    {
        $this->wajibPenjual();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('penjual');
        }

        $data = $this->ambilInput();
        $err  = $this->validasi($data, true);
        if ($err) {
            $this->alertKembali($err, 'penjual/tambah');
        }

        $namaFile = $this->uploadGambar($_FILES['gambar'] ?? null);
        if ($namaFile === null) {
            $this->alertKembali('Gambar gagal diupload (cek format JPG/PNG & ukuran < 2MB).', 'penjual/tambah');
        }

        $data['gambar'] = $namaFile;

        $produkModel = $this->model('Produk');
        if ($produkModel->tambah($data, (int) $_SESSION['id'])) {
            $this->alertKembali('Produk berhasil ditambahkan!', 'penjual');
        }
        $this->alertKembali('Gagal menambah produk.', 'penjual/tambah');
    }

    /* ---------------- FORM EDIT ---------------- */

    public function edit(): void
    {
        $this->wajibPenjual();
        $id = (int) ($_GET['id'] ?? 0);

        $produkModel = $this->model('Produk');
        $produk      = $produkModel->cariMilik($id, (int) $_SESSION['id']);

        if (!$produk) {
            $this->alertKembali('Produk tidak ditemukan.', 'penjual');
        }

        $this->view('penjual/form', [
            'mode'   => 'edit',
            'produk' => $produk,
        ], 'style-seller.css');
    }

    public function prosesEdit(): void
    {
        $this->wajibPenjual();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('penjual');
        }

        $id          = (int) ($_POST['id'] ?? 0);
        $produkModel = $this->model('Produk');
        $lama        = $produkModel->cariMilik($id, (int) $_SESSION['id']);

        if (!$lama) {
            $this->alertKembali('Produk tidak ditemukan.', 'penjual');
        }

        $data = $this->ambilInput();
        $err  = $this->validasi($data, false);
        if ($err) {
            $this->alertKembali($err, 'penjual/edit&id=' . $id);
        }

        // gambar opsional saat edit
        $namaFile = null;
        if (!empty($_FILES['gambar']['name'])) {
            $namaFile = $this->uploadGambar($_FILES['gambar']);
            if ($namaFile === null) {
                $this->alertKembali('Gambar gagal diupload.', 'penjual/edit&id=' . $id);
            }
            // hapus gambar lama jika file upload (bukan seed bawaan)
            $this->hapusFile($lama['gambar']);
        }

        if ($produkModel->ubah($id, $data, (int) $_SESSION['id'], $namaFile)) {
            $this->alertKembali('Produk berhasil diperbarui!', 'penjual');
        }
        $this->alertKembali('Gagal memperbarui produk.', 'penjual/edit&id=' . $id);
    }

    /* ---------------- HAPUS ---------------- */

    public function hapus(): void
    {
        $this->wajibPenjual();
        $id = (int) ($_GET['id'] ?? 0);

        $produkModel = $this->model('Produk');
        $produk      = $produkModel->cariMilik($id, (int) $_SESSION['id']);

        if ($produk) {
            $produkModel->hapus($id, (int) $_SESSION['id']);
            $this->hapusFile($produk['gambar']);
            $this->alertKembali('Produk dihapus.', 'penjual');
        }
        $this->alertKembali('Produk tidak ditemukan.', 'penjual');
    }

    /* ============ HELPER PRIVAT ============ */

    /** Ambil & rapikan input produk dari POST. */
    private function ambilInput(): array
    {
        return [
            'nama'      => trim($_POST['nama'] ?? ''),
            'deskripsi' => trim($_POST['deskripsi'] ?? ''),
            'harga'     => (int) ($_POST['harga'] ?? 0),
        ];
    }

    /** Validasi sederhana. Kembalikan pesan error atau '' jika valid. */
    private function validasi(array $data, bool $butuhGambar): string
    {
        if ($data['nama'] === '' || $data['deskripsi'] === '') {
            return 'Nama dan deskripsi wajib diisi.';
        }
        if ($data['harga'] <= 0) {
            return 'Harga harus lebih dari 0.';
        }
        if ($butuhGambar && empty($_FILES['gambar']['name'])) {
            return 'Gambar produk wajib diupload.';
        }
        return '';
    }

    /**
     * Upload gambar dengan validasi. Kembalikan nama file unik,
     * atau null jika gagal.
     */
    private function uploadGambar(?array $file): ?string
    {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // batas ukuran 2MB
        if ($file['size'] > 2 * 1024 * 1024) {
            return null;
        }

        // validasi tipe berdasarkan isi file (bukan ekstensi saja)
        $izin = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        $mime = mime_content_type($file['tmp_name']);
        if (!isset($izin[$mime])) {
            return null;
        }

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0775, true);
        }

        $namaFile = 'produk_' . uniqid() . '.' . $izin[$mime];
        $tujuan   = $this->uploadDir . $namaFile;

        if (!move_uploaded_file($file['tmp_name'], $tujuan)) {
            return null;
        }

        // disimpan ke DB sebagai path relatif terhadap folder gambar/
        return 'produk/' . $namaFile;
    }

    /** Hapus file gambar upload (lewati jika gambar seed bawaan). */
    private function hapusFile(string $gambar): void
    {
        if (str_starts_with($gambar, 'produk/')) {
            $path = __DIR__ . '/../../public/gambar/' . $gambar;
            if (is_file($path)) {
                @unlink($path);
            }
        }
    }

    /** Alert JS lalu redirect (mendukung query string mis. edit&id=3). */
    private function alertKembali(string $pesan, string $tujuan): void
    {
        $pesanAman = htmlspecialchars($pesan, ENT_QUOTES);

        // pisahkan path & query agar router membaca ?url= dengan benar
        if (str_contains($tujuan, '&')) {
            [$path, $query] = explode('&', $tujuan, 2);
            $url = BASE_URL . '/index.php?url=' . $path . '&' . $query;
        } else {
            $url = BASE_URL . '/' . ltrim($tujuan, '/');
        }

        echo "<script>
                alert('{$pesanAman}');
                window.location='{$url}';
              </script>";
        exit;
    }
}
