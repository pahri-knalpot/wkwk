// ================= SIDEBAR / HAMBURGER =================

const hamburger = document.querySelector(".hamburger");
const closeIcon = document.querySelector(".close-icon");
const sidebar   = document.querySelector(".sidebar");
const overlay   = document.querySelector(".overlay");

function openSidebar() {
    sidebar?.classList.add("active");
    overlay?.classList.add("active");
}

function closeSidebar() {
    sidebar?.classList.remove("active");
    overlay?.classList.remove("active");
}

hamburger?.addEventListener("click", openSidebar);
closeIcon?.addEventListener("click", closeSidebar);
overlay?.addEventListener("click", closeSidebar);

// ================= SWIPER (TOP LIST) =================

if (typeof Swiper !== "undefined" && document.querySelector(".mySwiper")) {
    new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 26,
        loop: true,
        grabCursor: true,

        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        breakpoints: {
            640:  { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        },
    });
}

// ================= MODAL =================

function openModal(id) {
    document.getElementById(id)?.classList.add("active");
}

function closeModalEl(el) {
    el.closest(".modal-overlay")?.classList.remove("active");
}

// pembuka modal (logout)
document.querySelectorAll("[data-open-modal]").forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();
        openModal(btn.dataset.openModal);
    });
});

// penutup modal (batal / mulai jelajah)
document.querySelectorAll("[data-close-modal]").forEach((btn) => {
    btn.addEventListener("click", () => closeModalEl(btn));
});

// klik area gelap → tutup
document.querySelectorAll(".modal-overlay").forEach((ov) => {
    ov.addEventListener("click", (e) => {
        if (e.target === ov) ov.classList.remove("active");
    });
});

// popup sambutan otomatis muncul sekali setelah login
if (window.AMBA_WELCOME === true) {
    openModal("modal-welcome");
}

// ================= KONFIRMASI HAPUS (link data-confirm) =================

document.querySelectorAll("[data-confirm]").forEach((link) => {
    link.addEventListener("click", (e) => {
        if (!window.confirm(link.dataset.confirm)) {
            e.preventDefault();
        }
    });
});

// ================= PREVIEW UPLOAD GAMBAR =================

const fileInput  = document.getElementById("fileInput");
const preview    = document.getElementById("preview");
const uploadText = document.getElementById("uploadText");

fileInput?.addEventListener("change", () => {
    const file = fileInput.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = (e) => {
        if (preview) {
            preview.src = e.target.result;
            preview.hidden = false;
        }
        if (uploadText) uploadText.textContent = file.name;
    };
    reader.readAsDataURL(file);
});
