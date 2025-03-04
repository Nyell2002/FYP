// GET MENU ELEMENTS AND ACTIVE SIDEBAR
const navbarMenu = document.querySelector(".menu");
document.querySelector("#ham-menu").onclick = () => {
  navbarMenu.classList.toggle("active");
};

// CLOSE SIDEBAR WHEN CLICKING  OUTSIDE BAR
const hamburger = document.querySelector("#ham-menu");
document.addEventListener("click", function (e) {
  if (!hamburger.contains(e.target) && !navbarMenu.contains(e.target)) {
    navbarMenu.classList.remove("active");
  }
});
