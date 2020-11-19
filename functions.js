function mobileMenu() { // Function provides mobile navigation for smartphones
let menu = document.getElementById("menuM");
  if (menu.className === "menu" || menu.className === "menu sticky") {
    menu.classList.add("mobile")

  }
  else {
    menu.classList.remove("mobile");
  }
}
window.onscroll = function() {
let menu = document.getElementById("menuM");
let sticky = menu.offsetTop;
  if (window.pageYOffset > sticky) {
    menu.classList.add("sticky");
  } else {
    menu.classList.remove("sticky");
  }
};