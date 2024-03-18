
    let scrollContainer = document.querySelector(".slideshow");
    let backbtn = document.getElementById("backbtn");
    let nextbtn = document.getElementById("nextbtn");
  
 
    nextbtn.addEventListener("click", ()=>{
      scrollContainer.style.scrollBehavior = "smooth";
      scrollContainer.scrollLeft += 1900;
    });
  
    backbtn.addEventListener("click", ()=>{
      scrollContainer.style.scrollBehavior = "smooth";
      scrollContainer.scrollLeft -= 2000;
    });


    let testimonialsContainer = document.querySelector(".testimonials-box");
    let testimonialsBackBtn = document.getElementById("BackBtn2");
    let testimonialsNextBtn = document.getElementById("NextBtn2");
  

  
    testimonialsNextBtn.addEventListener("click", ()=>{
      testimonialsContainer.style.scrollBehavior = "smooth";
      testimonialsContainer.scrollLeft += 2500;
    });
  
    testimonialsBackBtn.addEventListener("click", ()=>{
      testimonialsContainer.style.scrollBehavior = "smooth";
      testimonialsContainer.scrollLeft -= 2500;
    });


    function changeClass2(element) {
        var isHeartFilled = element.classList.contains('fa-heart');
        var allHeartIcons = document.querySelectorAll('.offers i.fa-heart');
        
      if (isHeartFilled) {
        element.classList.remove('fa-heart');
        element.classList.add('fa-heart-o');
      } else {
        for (var i = 0; i < allHeartIcons.length; i++) {
          allHeartIcons[i].classList.remove('fa-heart');
          allHeartIcons[i].classList.add('fa-heart-o');
        }
        element.classList.remove('fa-heart-o');
        element.classList.add('fa-heart');
      }
    }



    //remove sign in login button//
    let clname = JSON.parse(sessionStorage.getItem("clname"));
    let signUpButton = document.getElementById("signupButton");
    let loginButton = document.getElementById("loginButton");
    let navMenu = document.querySelector(".header-right .nav");

    let logedin = JSON.parse(sessionStorage.getItem("logedin"));
    

    if (logedin){
      if (logedin.value == "yes") {
        signUpButton.style.display = "none";
        loginButton.style.display = "none";
        navMenu.style.opacity = "1";
        let navLink = document.querySelector(".header-right .nav__link");
        navLink.innerHTML = `<i class="fa fa-user"></i>${clname.name} <i class="ri-arrow-down-s-line dropdown__arrow"></i>`;
  
        
      }

    }
    

function reset(){
    sessionStorage.removeItem("logedin");
  }



  document.addEventListener("DOMContentLoaded", function() {
    const dropdownLinks = document.querySelectorAll('.dropdown__link');
    
    dropdownLinks.forEach(function(link, index) {
        link.addEventListener('click', function(event) {
  
            const nom = link.textContent.trim();
            const position = index + 1;
            sessionStorage.setItem('nom', nom);
            sessionStorage.setItem('position', position);
            console.log("nom=" + nom + " position=" + position);
            
            // Supprimer les éléments précédemment stockés
            sessionStorage.removeItem('nom');
            sessionStorage.removeItem('position');
            
            // Ajouter les nouveaux éléments
            sessionStorage.setItem('nom', nom);
            sessionStorage.setItem('position', position);
        });
    });
});
