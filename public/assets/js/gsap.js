document.addEventListener("DOMContentLoaded", () => {
  // Register Plugin
  gsap.registerPlugin(ScrollTrigger);

  // Animasi Hero Section
  gsap.fromTo(".hero-text", { y: 40, opacity: 0 }, { y: 0, opacity: 1, duration: 1, ease: "power3.out" });

  gsap.fromTo(".hero-visual", { x: 50, opacity: 0 }, { x: 0, opacity: 1, duration: 1.2, delay: 0.2, ease: "power3.out" });

  // Animasi Fitur Utama (Fix untuk bug kartu samar/transparan)
  gsap.fromTo(
    ".feature-card",
    {
      y: 50,
      opacity: 0,
    },
    {
      y: 0,
      opacity: 1,
      duration: 0.8,
      stagger: 0.2,
      ease: "power2.out",
      clearProps: "opacity,transform",
      scrollTrigger: {
        trigger: "#fitur-utama",
        start: "top 80%",
      },
    },
  );

  // Animasi Step Cara Kerja
  gsap.fromTo(
    ".step-card",
    {
      y: 30,
      opacity: 0,
    },
    {
      y: 0,
      opacity: 1,
      duration: 0.6,
      stagger: 0.15,
      ease: "back.out(1.7)",
      clearProps: "opacity,transform",
      scrollTrigger: {
        trigger: "#cara-kerja",
        start: "top 75%",
      },
    },
  );
});
