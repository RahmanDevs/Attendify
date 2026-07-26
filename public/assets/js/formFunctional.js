document.addEventListener("DOMContentLoaded", () => {
  const overlay = document.getElementById("overlay-panel");
  const loginContent = document.getElementById("overlay-login-content");
  const registerContent = document.getElementById("overlay-register-content");
  const btnToRegister = document.getElementById("btn-to-register");
  const btnToLogin = document.getElementById("btn-to-login");

  const tabLogin = document.getElementById("tab-login");
  const tabRegister = document.getElementById("tab-register");
  const mobilePill = document.getElementById("mobile-pill");
  const formsTrack = document.getElementById("forms-track");

  function switchToRegister() {
    if (window.innerWidth >= 768) {
      overlay?.classList.add("-translate-x-full");
      loginContent?.classList.add("hidden");
      registerContent?.classList.remove("hidden");
    } else {
      if (formsTrack) formsTrack.style.transform = "translateX(-50%)";
      if (mobilePill) mobilePill.style.transform = "translateX(100%)";

      tabRegister?.classList.add("text-navy-900");
      tabRegister?.classList.remove("text-navy-700");
      tabLogin?.classList.remove("text-navy-900");
      tabLogin?.classList.add("text-navy-700");
    }
  }

  function switchToLogin() {
    if (window.innerWidth >= 768) {
      overlay?.classList.remove("-translate-x-full");
      registerContent?.classList.add("hidden");
      loginContent?.classList.remove("hidden");
    } else {
      if (formsTrack) formsTrack.style.transform = "translateX(0%)";
      if (mobilePill) mobilePill.style.transform = "translateX(0%)";

      tabLogin?.classList.add("text-navy-900");
      tabLogin?.classList.remove("text-navy-700");
      tabRegister?.classList.remove("text-navy-900");
      tabRegister?.classList.add("text-navy-700");
    }
  }

  // Event Listeners Klik
  btnToRegister?.addEventListener("click", switchToRegister);
  btnToLogin?.addEventListener("click", switchToLogin);
  tabRegister?.addEventListener("click", switchToRegister);
  tabLogin?.addEventListener("click", switchToLogin);

  // ==========================================
  // AUTO SWITCH DETECTION (DIJAMIN JALAN)
  // ==========================================
  function checkUrlAndSwitch() {
    const urlParams = new URLSearchParams(window.location.search);
    const mode = urlParams.get("mode");

    if (mode === "register") {
      switchToRegister();
    } else if (mode === "login") {
      switchToLogin();
    }
  }

  // Jalankan langsung dan beri sedikit delay timeout untuk menjamin DOM sudah siap
  checkUrlAndSwitch();
  setTimeout(checkUrlAndSwitch, 100);
});
