# AMBA DRINKS — Website (MVC, Desain Baru)

Versi baru website AMBA DRINKS dengan desain ulang yang lebih modern dan
bersih, tetap memakai arsitektur **MVC (Model–View–Controller)** PHP murni.
Warna brand dipertahankan (merah marun + kuning emas).

---

## 1. Struktur Folder

```
amba-drinks/
├── app/
│   ├── controllers/   # HomeController, ProdukController, ContactController, AuthController, Controller (base)
│   ├── models/        # Model (base), Produk, User
│   └── views/
│       ├── layouts/   # header.php (navbar + sidebar), footer.php
│       ├── home/index.php
│       ├── produk/index.php
│       ├── contact/index.php
│       └── auth/  (login.php, register.php)
├── config/
│   └── config.php     # Koneksi PDO + BASE_URL
├── database/
│   └── website.sql    # Sama seperti versi sebelumnya
├── public/
│   ├── index.php      # Front Controller + Router
│   ├── .htaccess
│   ├── css/  (base.css, style-home.css, style-product.css, style-contact.css, style-auth.css)
│   ├── js/   (main.js)
│   └── gambar/        # Taruh semua gambar di sini
└── .htaccess
```

> Struktur ini sengaja dibuat mirip versi MVC sebelumnya. Perbedaan utama
> hanya pada **desain (CSS + tampilan view)** dan tambahan `base.css`
> sebagai design system bersama.

---

## 2. Yang Baru di Desain Ini

- **Design system** (`base.css`): variabel warna, font Poppins, navbar
  sticky transparan dengan blur, footer 3 kolom, tombol konsisten.
- **Home**: hero dua kolom dengan badge, statistik, kartu keunggulan,
  carousel TOP LIST yang sudah rapi (titik & panah diberi jarak), dan
  CTA penutup.
- **Produk**: grid kartu modern dengan badge, harga emas, tombol "Beli",
  dan efek hover (gambar zoom + kartu naik).
- **Kontak**: tiga kartu (Lokasi, WhatsApp, Instagram) yang bisa diklik
  + info jam operasional.
- **Login & Register**: tampilan split-screen (panel brand + panel form)
  dengan input ber-ikon.
- **Responsif**: navbar berubah jadi sidebar (hamburger) di layar kecil.

---

## 3. Cara Menjalankan

1. **Import database**: buka phpMyAdmin → tab **Import** → pilih
   `database/website.sql` → **Go**. (Membuat database `website` + tabel
   `users` & `produk` + 8 data minuman.)
2. **Letakkan folder** `amba-drinks` ke `htdocs` (XAMPP) / `www` (Laragon).
3. **Cek BASE_URL** di `config/config.php`:
   ```php
   define('BASE_URL', '/amba-drinks/public');
   ```
4. **Taruh gambar** (logo.png, minuman-1.jpeg … minuman-8.jpeg,
   bg-owner.jpeg) ke `public/gambar/`.
5. **Buka**: `http://localhost/amba-drinks/public/`

---

## 4. Daftar Route

| URL                | Controller          | Method         |
|--------------------|---------------------|----------------|
| `/`                | HomeController      | index          |
| `/produk`          | ProdukController    | index          |
| `/contact`         | ContactController   | index          |
| `/login`           | AuthController      | login          |
| `/proses-login`    | AuthController      | prosesLogin    |
| `/register`        | AuthController      | register       |
| `/proses-register` | AuthController      | prosesRegister |
| `/logout`          | AuthController      | logout         |

---

## 5. Catatan Gambar

Folder `public/gambar/` masih kosong. Salin gambar dari proyek lama
(folder `gambar/`) ke sini. File yang dipakai:
`logo.png`, `bg-owner.jpeg`, dan `minuman-1.jpeg` s/d `minuman-8.jpeg`.
