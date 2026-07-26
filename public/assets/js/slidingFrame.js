/* 
    Sliding Frame Login and Register 
    > Functional behavior
*/
document.addEventListener("DOMContentLoaded", () => {
  const overlay = document.getElementById("overlay-panel");
  const loginContent = document.getElementById("overlay-login-content");
  const registerContent = document.getElementById("overlay-register-content");

  // Desktop Register and Login
  const btnToRegister = document.getElementById("btn-to-register");
  const btnToLogin = document.getElementById("btn-to-login");

  // Mobile Register and Login
  const mobileToRegister = document.getElementById("mobile-to-register");
  const mobileToLogin = document.getElementById("mobile-to-login");

  // Function Toggle Panel
  function showRegister() {
    overlay.classList.add("-translate-x-full");
    loginContent.classList.add("hidden");
    registerContent.classList.remove("hidden");
  }

  // Function show login form
  function showLogin() {
    overlay.classList.remove("-translate-x-full");
    registerContent.classList.add("hidden");
    loginContent.classList.remove("hidden");
  }

  // Button behaviour
  btnToRegister.addEventListener("click", showRegister);
  btnToLogin.addEventListener("click", showLogin);
  if (mobileToRegister) mobileToRegister.addEventListener("click", showRegister);
  if (mobileToLogin) mobileToLogin.addEventListener("click", showLogin);
});
