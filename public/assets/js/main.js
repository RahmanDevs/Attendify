document.addEventListener("DOMContentLoaded", () => {
  const menuBtn = document.getElementById("menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");

  if (menuBtn && mobileMenu) {
    // Tambahkan class bawaan untuk transisi di awal
    mobileMenu.classList.add("transition-all", "duration-300", "ease-in-out", "overflow-hidden", "max-h-0", "opacity-0");

    // Hapus hidden bawaan Tailwind
    mobileMenu.classList.remove("hidden");

    let isOpen = false;

    const toggleMenu = () => {
      isOpen = !isOpen;

      if (isOpen) {
        mobileMenu.classList.remove("max-h-0", "opacity-0");
        mobileMenu.classList.add("max-h-64", "opacity-100"); // 64 = tinggi max menu
      } else {
        mobileMenu.classList.remove("max-h-64", "opacity-100");
        mobileMenu.classList.add("max-h-0", "opacity-0");
      }
    };

    menuBtn.addEventListener("click", toggleMenu);

    document.querySelectorAll("#mobile-menu a").forEach((link) => {
      link.addEventListener("click", () => {
        if (isOpen) toggleMenu();
      });
    });
  }
});
