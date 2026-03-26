import "./bootstrap";

// Dark/Light Mode Toggle - Persist in localStorage
document.addEventListener("DOMContentLoaded", () => {
    const html = document.documentElement;
    const themeToggle = document.getElementById("theme-toggle");
    const sunIcon = document.getElementById("sun-icon");
    const moonIcon = document.getElementById("moon-icon");

    // Load saved theme
    const savedTheme =
        localStorage.getItem("theme") ||
        (window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light");
    html.classList.toggle("dark", savedTheme === "dark");

    if (savedTheme === "dark") {
        sunIcon.classList.remove("hidden");
        moonIcon.classList.add("hidden");
    }

    // Toggle handler
    if (themeToggle) {
        themeToggle.addEventListener("click", () => {
            const isDark = html.classList.contains("dark");
            const newTheme = isDark ? "light" : "dark";

            html.classList.toggle("dark");
            localStorage.setItem("theme", newTheme);

            // Toggle icons
            sunIcon.classList.toggle("hidden");
            moonIcon.classList.toggle("hidden");
        });
    }

    // "Skill" hover interaction
    const skillSpans = document.querySelectorAll(".skill-hover");
    skillSpans.forEach((span) => {
        span.addEventListener("mouseenter", () => {
            span.style.transform = "scale(1.1)";
            span.style.color = "#10b981";
        });
        span.addEventListener("mouseleave", () => {
            span.style.transform = "scale(1)";
            span.style.color = "";
        });
    });

    // Custom Cursor
    const cursor = document.createElement("div");
    cursor.id = "custom-cursor";
    cursor.style.cssText = `
        position: fixed;
        width: var(--cursor-size, 20px);
        height: var(--cursor-size, 20px);
        background: radial-gradient(circle, #10b981 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        mix-blend-mode: difference;
        transition: transform 0.1s ease;
        will-change: transform;
    `;
    document.body.appendChild(cursor);

    let mouseX = 0,
        mouseY = 0;
    document.addEventListener("mousemove", (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        cursor.style.left = mouseX + "px";
        cursor.style.top = mouseY + "px";
    });

    // React to project cards
    const projectCards = document.querySelectorAll(".custom-cursor-project");
    projectCards.forEach((card) => {
        card.addEventListener("mouseenter", () => {
            cursor.style.transform = "scale(2)";
            cursor.style.setProperty("--cursor-size", "24px");
        });
        card.addEventListener("mouseleave", () => {
            cursor.style.transform = "scale(1)";
            cursor.style.setProperty("--cursor-size", "20px");
        });
    });

    // Floating animations (Framer Motion style dengan CSS)
    const floatElements = document.querySelectorAll(".animate-float");
    floatElements.forEach((el) => {
        el.style.animation = "float 6s ease-in-out infinite";
    });

    // Form validation real-time
    const contactForm = document.getElementById("contact-form");
    if (contactForm) {
        contactForm.addEventListener("input", () => {
            const inputs = contactForm.querySelectorAll(".contact-input");
            let isValid = true;
            inputs.forEach((input) => {
                if (!input.checkValidity()) {
                    input.classList.add(
                        "border-red-500",
                        "ring-2",
                        "ring-red-500/50",
                    );
                    isValid = false;
                } else {
                    input.classList.remove(
                        "border-red-500",
                        "ring-2",
                        "ring-red-500/50",
                    );
                    input.classList.add(
                        "border-emerald-500",
                        "ring-2",
                        "ring-emerald-500/50",
                    );
                }
            });
            const submitBtn = contactForm.querySelector(
                'button[type="submit"]',
            );
            submitBtn.disabled = !isValid;
        });
    }

    // Toast notifications (emilkowalski/skill style)
    // Note: Requires npm install @emilkowalski/skill or similar
    // Placeholder implementation
    function showToast(message, type = "success") {
        const toast = document.createElement("div");
        toast.className = `fixed top-20 right-4 z-50 px-6 py-4 rounded-2xl shadow-2xl animate-slide-in text-white ${type === "success" ? "bg-emerald-500" : "bg-red-500"}`;
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 4000);
    }

    // Listen for Laravel flash messages
    document.addEventListener("livewire:init", () => {
        // Livewire toast integration if used
    });
});

// Custom CSS animations
const style = document.createElement("style");
style.textContent = `
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    @keyframes slide-in-from-top {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes pulse-hero {
        0%, 100% { opacity: 0.2; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(1.05); }
    }
    
    .glassmorphism {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
    
    .btn-emerald {
        background: linear-gradient(to right, #10b981, #059669);
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
`;
document.head.appendChild(style);

console.log("Portfolio JS loaded - Dark mode, cursor, animations ready!");
