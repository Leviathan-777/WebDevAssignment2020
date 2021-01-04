window.addEventListener('load', function() {
  'use strict';
  calcTotal(); //Calculates total cost
  let customer = document.getElementsByName("customerType")[0];
  let subButton = document.getElementById("subButton");
  let deliveries = document.getElementsByName("deliveryType");
  let checkboxes = document.getElementsByName("book[]");
  let termsChkbx = document.getElementsByName("termsChkbx")[0];

  for (var i = 0; i < checkboxes.length; i++) { //Adds event listener to all book checkboxes 
    checkboxes[i].addEventListener("click", calcTotal);
  }

  for(let i=0; i<deliveries.length; i++){ //Adds event listener to all delivery checkboxes
    deliveries[i].addEventListener("click", calcTotal);
  }

  subButton.addEventListener("click", checkForm); //Adds event listener to sumbit button
  customer.addEventListener("click", customerType); // Adds event listener to custumer type
  termsChkbx.addEventListener("click", termsChange); // Adds event listener to terms checkbox

  function checkForm(_evt){ //Checks if the form is filled properly
    let failed = false;
    let orderForm = document.getElementById("orderForm");
    let checkboxes = document.getElementsByName("book[]");
    for (var i = 0; i < checkboxes.length; i++) { //Check if any of book checkboxes is checked
      failed = true;
      if(checkboxes[i].checked == true){
        failed = false;
        break;
      }
    }
    //If block below checks if customer details are filled
    if((orderForm.customerType.value=="trd") && (orderForm.forename.value.trim() == "" || orderForm.surname.value.trim() == "" || orderForm.companyName.value.trim() == "")) 
     failed=true;
   else if(orderForm.forename.value.trim() == "" || orderForm.surname.value.trim() == "") failed=true;
   else if(orderForm.termsChkbx.checked == false) failed=true;
//Shows alert if form is invalid
   if(failed==true){
    alert("Form is invalid!");
    _evt.preventDefault();
  }
}

function termsChange(){ //Changes color and font of terms string if button is clicked
  let text = document.getElementById("termsText");
  let button = document.getElementById("subButton");
  if(termsChkbx.checked === true){
    text.setAttribute("style", "color: black; font-weight: normal;");
    button.disabled = false;
  }
  else{
    text.setAttribute("style", "color: #FF0000; font-weight: bold;");
    button.disabled = true;
  }
}

function customerType(){ //Changes customer type
  let customerChoice = document.getElementsByName("customerType")[0];
  let trade = document.getElementById("tradeCustDetails");
  if(customerChoice.value=="trd"){
    trade.style.visibility = "visible";
  }
  else{
    trade.style.visibility = "hidden";
  }
}

function calcTotal(){ //Calculates total cost
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