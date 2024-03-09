
let container = document.getElementById("container")
let formData= document.querySelector("form")
let message = document.getElementById("shortmsg")
let userData=JSON.parse(localStorage.getItem("userDatabase")) ||[];
formData.addEventListener("submit", function(e){
    e.preventDefault();
let mail = document.getElementById("email").value
let name = document.getElementById("fname").value + " " +document.getElementById("lname").value;
let sex = document.getElementById("sex").value
let bd = document.getElementById("bd").value
let password =document.getElementById("password").value;
let userCrd={
                name : name,
                sex : sex,
                bd : bd,
                email: mail,
                password: password
            }
    userData.push(userCrd)

localStorage.setItem("userDatabase",JSON.stringify(userData))
message.innerHTML="Sign Up Successful..."
setTimeout(()=>window.location.href="signIn.html",2000)

})


