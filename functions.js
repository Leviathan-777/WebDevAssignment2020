'use strict';
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

function termsChange(){
  let text = document.getElementById("termsText");
  let button = document.getElementById("subButton");
  if(checkBox.checked === true){
  text.style.color = "black";
  text.style.fontWeight = "normal";
  button.disabled = false;
  }
  else{
    text.style.color = "#FF0000";
  text.style.fontWeight = "bold";
  button.disabled = true;
  }
}
function calcTotal(){
    let total = 0;
    let books = new Array();
    books = document.getElementsByName("book[]");
    for(let i=0; i<books.length; i++){
      if(books[i].checked === true){
      total += parseFloat(books[i].getAttribute("data-price"));
    }
    }
    document.getElementsByName("total")[0].setAttribute("value", total);
}