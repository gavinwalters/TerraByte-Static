document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.querySelector(".hamburger");
  const mobileNav = document.querySelector(".mobile-nav");
  const xmark = document.querySelector(".xmark");
  function lockScroll() {
    document.body.classList.toggle("lock-scroll");
    console.log("LOCK");
  }

  hamburger.addEventListener("click", function () {
    mobileNav.classList.toggle("active");
    hamburger.classList.toggle("active");
    xmark.classList.toggle("active");
    lockScroll();
  });
  xmark.addEventListener("click", function () {
    mobileNav.classList.toggle("active");
    hamburger.classList.toggle("active");
    xmark.classList.toggle("active");
    lockScroll();
  });
});
