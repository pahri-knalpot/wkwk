    </main>

    <?php if (($_SESSION['role'] ?? '') !== 'penjual'): ?>
    <!-- ============ FOOTER (publik / pembeli) ============ -->
    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-brand">
                <a class="brand" href="<?= BASE_URL ?>/">
                    <img src="<?= BASE_URL ?>/gambar/logo.png" alt="Logo AMBA DRINKS">
                    AMBA <span>DRINKS</span>
                </a>
                <p>Minuman segar, creamy, dan nikmat — siap menemani setiap momen harimu.</p>
            </div>

            <div class="footer-col">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="<?= BASE_URL ?>/">Home</a></li>
                    <li><a href="<?= BASE_URL ?>/produk">Produk</a></li>
                    <li><a href="<?= BASE_URL ?>/contact">Kontak</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Hubungi Kami</h4>
                <p><i class="fa-brands fa-whatsapp"></i>
                    <a href="https://wa.me/+6289670258804" target="_blank" rel="noopener noreferrer">+62 896-7025-8804</a>
                </p>
                <p><i class="fa-brands fa-instagram"></i>
                    <a href="https://www.instagram.com/amba_drinks" target="_blank" rel="noopener noreferrer">@amba_drinks</a>
                </p>
                <p><i class="fa-solid fa-location-dot"></i> Tembok Ratapan, Solo</p>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; <?= date('Y') ?> AMBA DRINKS. Semua hak dilindungi.
        </div>
    </footer>
    <?php endif; ?>

    <!-- ============ MODAL: konfirmasi logout ============ -->
    <div class="modal-overlay" id="modal-logout">
        <div class="modal-box">
            <div class="modal-icon warn"><i class="fa-solid fa-right-from-bracket"></i></div>
            <h3>Keluar dari akun?</h3>
            <p>Apakah kamu yakin ingin logout dari AMBA DRINKS?</p>
            <div class="modal-actions">
                <button class="btn-modal batal" type="button" data-close-modal>Batal</button>
                <a class="btn-modal konfirm" href="<?= BASE_URL ?>/logout">Ya, Logout</a>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['id'])): ?>
    <!-- ============ MODAL: sambutan login ============ -->
    <div class="modal-overlay" id="modal-welcome">
        <div class="modal-box">
            <div class="modal-icon"><i class="fa-solid fa-mug-hot"></i></div>
            <h3>Selamat datang, <?= htmlspecialchars($_SESSION['nama']) ?>!</h3>
            <?php if (($_SESSION['role'] ?? '') === 'penjual'): ?>
                <p>Selamat berjualan. Kelola produkmu dan tambahkan menu baru kapan saja.</p>
            <?php else: ?>
                <p>Senang melihatmu kembali. Yuk nikmati menu segar favoritmu hari ini.</p>
            <?php endif; ?>
            <div class="modal-actions">
                <button class="btn-modal konfirm" type="button" data-close-modal>Mulai Jelajah</button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ============ MODAL: harus login dulu (klik Beli) ============ -->
    <div class="modal-overlay" id="modal-login-dulu">
        <div class="modal-box">
            <div class="modal-icon"><i class="fa-solid fa-circle-user"></i></div>
            <h3>Login dulu, yuk!</h3>
            <p>Kamu perlu masuk ke akun pembeli sebelum bisa membeli produk.</p>
            <div class="modal-actions">
                <button class="btn-modal batal" type="button" data-close-modal>Nanti Saja</button>
                <a class="btn-modal konfirm" href="<?= BASE_URL ?>/login">Login Sekarang</a>
            </div>
        </div>
    </div>

    <script>
        window.AMBA_WELCOME   = <?= !empty($baruLogin) ? 'true' : 'false' ?>;
        window.AMBA_LOGGED_IN = <?= isset($_SESSION['id']) ? 'true' : 'false' ?>;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="<?= BASE_URL ?>/js/main.js"></script>
</body>

</html>
