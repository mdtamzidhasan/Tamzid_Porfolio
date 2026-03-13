// ============================================================
// PORTFOLIO JS — File: public/js/portfolio.js
// ============================================================

document.addEventListener("DOMContentLoaded", () => {
    // ── Page Loader ──
    window.addEventListener("load", () => {
        const loader = document.getElementById("page-loader");
        if (loader) {
            setTimeout(() => loader.classList.add("hidden"), 400);
        }
    });

    // ── Theme Toggle ──
    const themeToggle = document.getElementById("themeToggle");
    const themeIcon = document.getElementById("themeIcon");
    const html = document.documentElement;

    const savedTheme = localStorage.getItem("portfolio-theme") || "dark";
    html.setAttribute("data-theme", savedTheme);
    updateThemeIcon(savedTheme);

    themeToggle?.addEventListener("click", () => {
        const current = html.getAttribute("data-theme");
        const next = current === "dark" ? "light" : "dark";
        html.setAttribute("data-theme", next);
        localStorage.setItem("portfolio-theme", next);
        updateThemeIcon(next);
    });

    function updateThemeIcon(theme) {
        if (!themeIcon) return;
        themeIcon.className = theme === "dark" ? "fas fa-sun" : "fas fa-moon";
    }

    // ── Navbar: Scroll behavior ──
    const navbar = document.getElementById("navbar");
    window.addEventListener("scroll", () => {
        if (window.scrollY > 50) navbar?.classList.add("scrolled");
        else navbar?.classList.remove("scrolled");
        updateScrollSpy();
        updateScrollTopBtn();
    });

    // ── Hamburger / Mobile menu ──
    const hamburger = document.getElementById("hamburger");
    const navLinks = document.getElementById("navLinks");
    const mobileOverlay = document.getElementById("mobileOverlay");

    hamburger?.addEventListener("click", () => {
        navLinks?.classList.toggle("open");
        mobileOverlay?.classList.toggle("open");
    });
    mobileOverlay?.addEventListener("click", closeMobileMenu);
    document.querySelectorAll(".nav-link").forEach((link) => {
        link.addEventListener("click", closeMobileMenu);
    });
    function closeMobileMenu() {
        navLinks?.classList.remove("open");
        mobileOverlay?.classList.remove("open");
    }

    // ── Scroll Spy ──
    function updateScrollSpy() {
        const sections = document.querySelectorAll("section[id]");
        const navLinkEls = document.querySelectorAll(".nav-link");
        let current = "";
        sections.forEach((section) => {
            if (window.scrollY >= section.offsetTop - 120) {
                current = section.getAttribute("id");
            }
        });
        navLinkEls.forEach((link) => {
            link.classList.toggle(
                "active",
                link.getAttribute("href") === `#${current}`,
            );
        });
    }

    // ── Scroll to Top Button ──
    const scrollTopBtn = document.getElementById("scrollTop");
    function updateScrollTopBtn() {
        if (window.scrollY > 400) scrollTopBtn?.classList.add("visible");
        else scrollTopBtn?.classList.remove("visible");
    }
    scrollTopBtn?.addEventListener("click", () =>
        window.scrollTo({ top: 0, behavior: "smooth" }),
    );

    // ── Typed.js Hero Text ──
    const typedEl = document.getElementById("typed-text");
    if (typedEl && typeof Typed !== "undefined") {
        const strings = typedEl.dataset.strings
            ? JSON.parse(typedEl.dataset.strings)
            : [
                  "Full Stack Developer",
                  "Laravel Expert",
                  "React Developer",
                  "Problem Solver",
              ];
        new Typed("#typed-text", {
            strings,
            typeSpeed: 60,
            backSpeed: 40,
            loop: true,
            backDelay: 1500,
        });
    }

    // ── Counter Animation ──
    const counters = document.querySelectorAll(".stat-number[data-count]");
    const counterObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.5 },
    );
    counters.forEach((counter) => counterObserver.observe(counter));

    function animateCounter(el) {
        const target = parseInt(el.dataset.count, 10);
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        const timer = setInterval(() => {
            current = Math.min(current + step, target);
            el.textContent = Math.floor(current) + (el.dataset.suffix || "+");
            if (current >= target) clearInterval(timer);
        }, 16);
    }

    // ── Skill Bars Animation ──
    const skillBars = document.querySelectorAll(".skill-bar");
    const skillObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const fill = entry.target.querySelector(".skill-fill");
                    const width = entry.target.dataset.width;
                    if (fill) fill.style.width = width + "%";
                    skillObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.3 },
    );
    skillBars.forEach((bar) => skillObserver.observe(bar));

    // ── AOS Init ──
    if (typeof AOS !== "undefined") {
        AOS.init({ duration: 700, once: true, offset: 80 });
    }

    // ── GLightbox (Certificate lightbox) ──
    if (typeof GLightbox !== "undefined") {
        GLightbox({ selector: ".glightbox", touchNavigation: true });
    }

    // ── Project / Certificate Filtering ──
    document.querySelectorAll(".filter-tabs").forEach((tabGroup) => {
        const buttons = tabGroup.querySelectorAll(".filter-btn");
        // Find the closest grid
        const grid = tabGroup.nextElementSibling;
        if (!grid) return;

        buttons.forEach((btn) => {
            btn.addEventListener("click", () => {
                buttons.forEach((b) => b.classList.remove("active"));
                btn.classList.add("active");
                const filter = btn.dataset.filter;
                grid.querySelectorAll("[data-category]").forEach((card) => {
                    const match =
                        filter === "all" || card.dataset.category === filter;
                    card.classList.toggle("hidden", !match);
                });
            });
        });
    });

    // ── Testimonials Slider ──
    const track = document.getElementById("testimonialsTrack");
    const dotsEl = document.getElementById("testimonialDots");
    const prevBtn = document.getElementById("prevTestimonial");
    const nextBtn = document.getElementById("nextTestimonial");

    if (track) {
        const cards = track.querySelectorAll(".testimonial-card");
        let current = 0;
        let autoPlay;

        // Build dots
        cards.forEach((_, i) => {
            const dot = document.createElement("button");
            dot.className = "testimonial-dot" + (i === 0 ? " active" : "");
            dot.addEventListener("click", () => goTo(i));
            dotsEl?.appendChild(dot);
        });

        function goTo(idx) {
            current = (idx + cards.length) % cards.length;
            track.style.transform = `translateX(-${current * 100}%)`;
            dotsEl?.querySelectorAll(".testimonial-dot").forEach((d, i) => {
                d.classList.toggle("active", i === current);
            });
            resetAuto();
        }

        prevBtn?.addEventListener("click", () => goTo(current - 1));
        nextBtn?.addEventListener("click", () => goTo(current + 1));

        function startAuto() {
            autoPlay = setInterval(() => goTo(current + 1), 5000);
        }
        function resetAuto() {
            clearInterval(autoPlay);
            startAuto();
        }
        startAuto();
    }

    // ── Contact Form (AJAX) ──
    const contactForm = document.getElementById("contactForm");
    contactForm?.addEventListener("submit", async (e) => {
        e.preventDefault();
        const btn = document.getElementById("submitBtn");
        const alertEl = document.getElementById("formAlert");
        const btnText = btn.querySelector(".btn-text");
        const btnLoading = btn.querySelector(".btn-loading");

        btn.disabled = true;
        btnText.style.display = "none";
        btnLoading.style.display = "inline-flex";

        const formData = new FormData(contactForm);

        try {
            const res = await fetch(contactForm.action || "/contact", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    )?.content,
                    Accept: "application/json",
                },
                body: formData,
            });
            const data = await res.json();

            alertEl.style.display = "block";
            if (data.success) {
                alertEl.className = "form-alert success";
                alertEl.textContent =
                    data.message || "Message sent successfully!";
                contactForm.reset();
            } else {
                alertEl.className = "form-alert error";
                const errors = data.errors
                    ? Object.values(data.errors).flat().join(" ")
                    : "Something went wrong.";
                alertEl.textContent = errors;
            }
        } catch {
            alertEl.style.display = "block";
            alertEl.className = "form-alert error";
            alertEl.textContent = "Network error. Please try again.";
        }

        btn.disabled = false;
        btnText.style.display = "inline-flex";
        btnLoading.style.display = "none";
        setTimeout(() => {
            alertEl.style.display = "none";
        }, 5000);
    });
});
