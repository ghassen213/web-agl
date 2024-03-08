const tabBtn=document.querySelectorAll(".tab");
    const tab=document.querySelectorAll('.tabShow');

    function tabs(panelIndex){
        tab.forEach(function(node){
            node.style.display="none";
        });
        tab[panelIndex].style.display="block";

    }
    tabs(0);



    


 // Retrieve the JSON string from local storage
 var userDataString = localStorage.getItem("userDatabase");
 var indice = sessionStorage.getItem("indice");


// Parse the JSON string back into a JavaScript object
var userData = JSON.parse(userDataString);
var i = JSON.parse(indice);



console.log(userData);

// Set input values from the userData object
document.querySelector('.payment,.profile .input:nth-of-type(1)').value =userData[i.value].name;
document.querySelector('.rightbox .input:nth-of-type(2)').value =userData[i.value].birthday;
document.querySelector('.rightbox .input:nth-of-type(3)').value =userData.gender;
document.querySelector('.rightbox .input:nth-of-type(4)').value =userData[i.value].email;
document.querySelector('.rightbox .input[type="password"]').value =userData[i.value].password;



   // Selecting the elements
   const inputField = document.querySelector('.input[type="password"]');
   const eyeIcon = document.getElementById('togglePasswordVisibility');
 
   // Adding click event listener to the eye icon
   eyeIcon.addEventListener('click', function() {
     // Toggle password visibility
     if (inputField.type === 'password') {
       inputField.type = 'text';
       eyeIcon.classList.remove('fa-eye');
       eyeIcon.classList.add('fa-eye-slash');
     } else {
       inputField.type = 'password';
       eyeIcon.classList.remove('fa-eye-slash');
       eyeIcon.classList.add('fa-eye');
     }
   });    
