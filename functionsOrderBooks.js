window.addEventListener('load', function() {
    'use strict';
  calcTotal();
  let customer = document.getElementsByName("customerType")[0];
  let subButton = document.getElementById("subButton");
  let deliveries = document.getElementsByName("deliveryType");
  let checkboxes = document.getElementsByName("book[]");
  let termsChkbx = document.getElementsByName("termsChkbx")[0];
  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].onclick = calcTotal;
  }
  for(let i=0; i<deliveries.length; i++){
  deliveries[i].onclick = calcTotal;
  }
  subButton.onclick = checkForm;
  customer.onclick = customerType;
  termsChkbx.onclick = termsChange;
  function termsChange(){
  let text = document.getElementById("termsText");
  let button = document.getElementById("subButton");
  if(termsChkbx.checked === true){
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
  function customerType(){
  let customerChoice = document.getElementsByName("customerType")[0];
  let trade = document.getElementById("tradeCustDetails");
  if(customerChoice.value=="trd"){
    trade.style.visibility = "visible";
  }
  else{
    trade.style.visibility = "hidden";
  }
  }
  function calcTotal(){
    let total = 0;
    let books = new Array();
    let delivery = new Array();
    books = document.getElementsByName("book[]");
    delivery = document.getElementsByName("deliveryType");
    for(let i=0; i<delivery.length; i++){
      if(delivery[i].checked === true){
      total += parseFloat(delivery[i].getAttribute("data-price"));
    }
    }
    for(let i=0; i<books.length; i++){
      if(books[i].checked === true){
      total += parseFloat(books[i].getAttribute("data-price"));
    }
    }
    document.getElementsByName("total")[0].setAttribute("value", total.toFixed(2));
}
function checkForm(){
  let books = document.getElementsByName("book[]");
  let surname = document.getElementsByName("surname")[0];
  let forename = document.getElementsByName("forename")[0];
    alert("test");
}
});