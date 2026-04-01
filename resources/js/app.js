import "./bootstrap";

// ── Dark / Light Mode ──────────────────────────────────────────────────────────
// Toggle class 'dark' di <html> dan simpan pilihan ke localStorage.
document.addEventListener("click", (e) => {
    if (e.target.closest("#theme-toggle")) {
        const isDark = document.documentElement.classList.toggle("dark");
        localStorage.setItem("theme", isDark ? "dark" : "light");
    }
});

document.addEventListener("DOMContentLoaded", () => {
    // Skill Tag Hover Effect
    // Scale-up sedikit saat hover pada tag skill di section About.
    document.querySelectorAll(".skill-hover").forEach((el) => {
        el.style.transition = "all 0.2s ease";
        el.addEventListener("mouseenter", () => {
            el.style.transform = "scale(1.08)";
        });
        el.addEventListener("mouseleave", () => {
            el.style.transform = "scale(1)";
        });
    });

    // Custom Cursor
    const cursorDot = document.createElement("div");
    Object.assign(cursorDot.style, {
        position: "fixed",
        width: "16px",
        height: "16px",
        background:
            "radial-gradient(circle, #10b981 0%, #10b98180 60%, transparent 100%)",
        borderRadius: "50%",
        pointerEvents: "none",
        zIndex: "9999",
        mixBlendMode: "difference",
        transition: "transform 0.15s ease, opacity 0.2s ease",
        willChange: "transform",
        transform: "translate(-50%, -50%)",
        opacity: "0", // Tersembunyi sampai mouse masuk ke window
    });
    document.body.appendChild(cursorDot);

    document.addEventListener("mousemove", (e) => {
        cursorDot.style.left = e.clientX + "px";
        cursorDot.style.top = e.clientY + "px";
        cursorDot.style.opacity = "1";
    });
    document.addEventListener("mouseleave", () => {
        cursorDot.style.opacity = "0";
    });

    // Perbesar kursor saat hover di kartu proyek
    document.querySelectorAll(".custom-cursor-project").forEach((card) => {
        card.addEventListener("mouseenter", () => {
            cursorDot.style.transform = "translate(-50%, -50%) scale(2.5)";
        });
        card.addEventListener("mouseleave", () => {
            cursorDot.style.transform = "translate(-50%, -50%) scale(1)";
        });
    });

    // Smooth Scroll
    document.querySelectorAll('a[href^="#"]').forEach((a) => {
        a.addEventListener("click", (e) => {
            const target = document.querySelector(a.getAttribute("href"));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: "smooth", block: "start" });
            }
        });
    });

    // Scroll-Triggered Reveal
    if ("IntersectionObserver" in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add(
                            "opacity-100",
                            "translate-y-0",
                        );
                        entry.target.classList.remove(
                            "opacity-0",
                            "translate-y-8",
                        );
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.1, rootMargin: "0px 0px -40px 0px" },
        );

        document.querySelectorAll(".reveal").forEach((el) => {
            el.classList.add(
                "opacity-0",
                "translate-y-8",
                "transition-all",
                "duration-700",
            );
            observer.observe(el);
        });
    }

    // Auto-Dismiss Flash Messages
    // Flash message (#flash-success, #flash-error) hilang otomatis setelah 4 detik
    setTimeout(() => {
        document
            .querySelectorAll("#flash-success, #flash-error")
            .forEach((el) => {
                el.style.transition = "opacity 0.4s ease";
                el.style.opacity = "0";
                setTimeout(() => el.remove(), 400);
            });
    }, 4000);
});
