//******** ki t3amer cbon w tenzel tkharajlek alert feha code de verification lezem tektbou *********//
let checkOut = document.querySelector(".btn");
let inputs = document.querySelectorAll("input, select");
let digits = '1234567890';

let otp ='';
genOtp()
function genOtp() {
  otp = '';
  for (let i = 0; i < 4; i++) {
    otp += digits[Math.floor(Math.random() * 10)]
  }
}


//************ thabet mel code shih walle w thabet les input shah walle sinn ykharajlek alert ykolek chneya el ghalet ******//
checkOut.addEventListener("click", (e) => {

  let invalidFields = [];
  inputs.forEach(input => {
    if (!input.checkValidity()) {
      invalidFields.push(input.getAttribute('name'));
    }
  });
  if (invalidFields.length === 0) {
    let check = prompt(`Enter Otp: ${otp}`);
    if (check === otp) {
      alert("Thank you for shopping.");
      
      genOtp();
    } else {
      alert("verification code incorrect");
      genOtp();
    }
  } else {
    let errorMsg = "Please correct the following input(s): \n";
    invalidFields.forEach(field => {
      errorMsg += `- ${field}\n`;
    });
    alert(errorMsg);
  }
});
