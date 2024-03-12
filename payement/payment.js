let checkOut = document.querySelector(".btn");
let inputs = document.querySelectorAll("input, select");
let digits = '1234567890';

let otp = '';

function genOtp() {
  otp = '';
  for (let i = 0; i < 4; i++) {
    otp += digits[Math.floor(Math.random() * 10)];
  }
  console.log(otp);
}

checkOut.addEventListener("click", (e) => {
  e.preventDefault();
  let invalidFields = [];
  inputs.forEach(input => {
    if (!input.checkValidity()) {
      invalidFields.push(input.getAttribute('placeholder'));
    }
  });
  if (invalidFields.length === 0) {
    let check = prompt(`Enter Otp: ${otp}`);
    if (check === otp) {
      alert("Thank you for shopping.");
      setTimeout(() => window.location.href = "/index.html", 2000);
      genOtp();
    } else {
      alert("Otp incorrect");
      genOtp();
    }
    console.log(check);
  } else {
    let errorMsg = "Please correct the following input(s): \n";
    invalidFields.forEach(field => {
      errorMsg += `- ${field}\n`;
    });
    alert(errorMsg);
  }
});
