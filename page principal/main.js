
    let scrollContainer = document.querySelector(".slideshow");
    let backbtn = document.getElementById("backbtn");
    let nextbtn = document.getElementById("nextbtn");
  
 
    nextbtn.addEventListener("click", ()=>{
      scrollContainer.style.scrollBehavior = "smooth";
      scrollContainer.scrollLeft += 2000;
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

    let test = JSON.parse(sessionStorage.getItem("test"));
  
    if (test.value == "yes") {
      signUpButton.style.display = "none";
      loginButton.style.display = "none";
      navMenu.style.opacity = "1";
      let navLink = document.querySelector(".header-right .nav__link");
      navLink.innerHTML = `<i class="fa fa-user"></i>${clname.name} <i class="ri-arrow-down-s-line dropdown__arrow"></i>`;

      
    }

function reset(){
    sessionStorage.removeItem("test");
  }




