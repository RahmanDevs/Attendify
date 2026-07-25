// Konfigurasi Tailwind CDN
tailwind.config = {
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', "sans-serif"],
      },
      colors: {
        navy: {
          900: "#0f172a",
          800: "#1e293b",
          700: "#334155",
        },
        brand: {
          700: "#1d4ed8",
          600: "#2563eb",
          500: "#3b82f6",
          400: "#60a5fa",
          100: "#dbeafe",
          50: "#eff6ff",
        },
        cream: {
          300: "#ede6d8",
          200: "#f7f3eb",
          100: "#fdfbf7",
          50: "#fffefc",
        },
      },
    },
  },
};

// Logic Toggle Mobile Menu
document.addEventListener("DOMContentLoaded", () => {
  const menuBtn = document.getElementById("menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");

  if (menuBtn && mobileMenu) {
    menuBtn.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
    });

    document.querySelectorAll("#mobile-menu a").forEach((link) => {
      link.addEventListener("click", () => {
        mobileMenu.classList.add("hidden");
      });
    });
  }
});
