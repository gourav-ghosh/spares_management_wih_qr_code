
function payment_activate() {
    let payment_checkbox = document.getElementById("payment_checkbox");
    let payment = document.getElementById("payment");

    if (payment_checkbox.checked) {
        payment.style.display = "block";
    } else {
        payment.style.display = "none";
    }
}
function show_image_on_modal(image_path){
        let image = document.getElementById("single_show_image_on_page");
        image.src = image_path;
    }
function show_data_on_modal(email, name, choice){
   let email_input= document.getElementById("email");
   let name_input = document.getElementById("name");
   let subject_input = document.getElementById("msg_subject");
   let body_input = document.getElementById("msg_body");
   
   email_input.value = email;
   name_input.value = name;
   if(choice === "amazon"){
       subject_input.value = "Mytyles Cashback - Amazon Coupon Code";
       body_input.value = `Thanks for giving your valuable review. Here is your AMAZON COUPON Code. 
    Coupon Code:
    Amount:
    `;
   }
   if(choice === "bank"){
       subject_input.value = "Mytyles Cashback - Bank Transaction Details";
       body_input.value = `Thanks for giving your valuable review. Here is your Bank Trasaction Details.
    Trasaction No:
    Amount:
    Date:
    `;
   }
   
}
function show_data_on_modal_money(id){
   let review_id= document.getElementById("review_id");
   
   review_id.value = id;
   
}
function activate_amazon_block() {
    let activate_amazon = document.getElementById("activate_amazon");
    let pay_choice = document.getElementById("pay_choice");

    let activate_bank = document.getElementById("activate_bank");
    let bank_block = document.getElementById("bank_block");

    if (activate_amazon.checked) {

        activate_bank.checked = false;
        bank_block.style.display = "none";
        pay_choice.value = "amazon";
    }
}

function activate_bank_block() {
    let activate_bank = document.getElementById("activate_bank");
    let bank_block = document.getElementById("bank_block");

    let activate_amazon = document.getElementById("activate_amazon");
    let pay_choice = document.getElementById("pay_choice");

    if (activate_bank.checked) {
        bank_block.style.display = "block";
        activate_amazon.checked = false;
        pay_choice.value = "bank";
    } else {
        bank_block.style.display = "none";
    }
}

function myToggleFun(image_id) {
  let x = document.getElementById(image_id);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function custom_activate() {
  let x = document.getElementById('msg_subject');
  let y = document.getElementById('msg_body');
  x.value = '';
  y.value = '';
}
