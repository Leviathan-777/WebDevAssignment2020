function mobileMenu() { // Function provides mobile navigation for smartphones
var menu = document.getElementById("menuM");
  if (menu.className === "menu") {
    menu.className += " mobile";
  } else {
    menu.className = "menu";
  }
}
//function stickyMenu() {}
 // Function sticks menu to top of the page