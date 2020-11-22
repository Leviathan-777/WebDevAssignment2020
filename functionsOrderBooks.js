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
  subButton.addEventListener("click", checkForm);
  customer.onclick = customerType;
  termsChkbx.onclick = termsChange;
  function checkForm(_evt){
    let failed = false;
    let orderForm = document.getElementById("orderForm");
    let checkboxes = document.getElementsByName("book[]");
    for (var i = 0; i < checkboxes.length; i++) {
      failed = true;
    if(checkboxes[i].checked == true){
      failed = false;
      break;
      }
    }
    if((orderForm.customerType.value=="trd") && (orderForm.forename.value.trim() == "" || orderForm.surname.value.trim() == "" || orderForm.companyName.value.trim() == ""))
     failed=true;
    else if(orderForm.forename.value.trim() == "" || orderForm.surname.value.trim() == "") failed=true;
    else if(orderForm.termsChkbx.checked == false) failed=true;
    
    if(failed==true){
    alert("Form is invalid!");
    _evt.preventDefault();
  }
  }
  
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
});