import "./bootstrap";
import Alpine from "alpinejs";
import Swal from "sweetalert2"; 

window.Alpine = Alpine;

Alpine.start();

// Toggle show/hide password (punyamu tadi)
document.querySelectorAll("[data-toggle-password]").forEach((btn) => {
    const input = document.getElementById(btn.dataset.target);
    const eye = btn.querySelector("[data-eye]");
    const eyeOff = btn.querySelector("[data-eye-off]");

    btn.addEventListener("click", () => {
        const isHidden = input.type === "password";
        input.type = isHidden ? "text" : "password";
        btn.setAttribute("aria-pressed", String(isHidden));
        eye.classList.toggle("hidden", isHidden);
        eyeOff.classList.toggle("hidden", !isHidden);
    });
});

// Logout GET + SweetAlert2
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[data-logout-get]").forEach((el) => {
        el.addEventListener("click", (e) => {
            e.preventDefault();
            const url = el.dataset.url || el.getAttribute("href");
            Swal.fire({
                title: "Keluar dari sistem?",
                text: "Sesi kamu akan diakhiri.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, logout",
                cancelButtonText: "Batal",
                reverseButtons: true,
                focusCancel: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.assign(url);
                }
            });
        });
    });
});
