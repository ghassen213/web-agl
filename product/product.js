//**********te5ou les champs info mta el produit w t3abehom (lezem nfasarha)************//

document.addEventListener('DOMContentLoaded', function() {
  function updateProductDetails() {
  var title = document.querySelector('.product-title h1').innerText;
  var price = document.querySelector('.price ').innerText;
  var size = document.querySelector('.size-options input[name="quantity"]:checked').nextElementSibling.innerText;
  var quantity = document.getElementById('my-input').value;
  var delivery = document.querySelector('.delivery-options input[name="quantity"]:checked').nextElementSibling.innerText;



  document.getElementById('product-title').value = title;
  document.getElementById('product-price').value = price;
  document.getElementById('product-size').value = size;
  document.getElementById('product-quantity').value = quantity;
  document.getElementById('product-delivery').value = delivery;
  }

  document.querySelector('.buy-btn').addEventListener('click', updateProductDetails);
  document.querySelector('.cart-btn').addEventListener('click', updateProductDetails);

 
});


//*******tkhrajlek taswira bedhabet wel donnée mte3ha eli clickit aleha fel catalogue (lezem nfasarha)***********//

document.addEventListener("DOMContentLoaded", function() {
    // Retrieve product data from session storage
    const storedProductData = sessionStorage.getItem('selectedProduct');
    if (storedProductData) {
      const productData = JSON.parse(storedProductData);
      // Update image source, name, and new price
      const mainImgFrame = document.querySelector('.main-img-frame img');
      const productTitle = document.querySelector('.product-title h1');
      const Price = document.querySelector('.price');
      mainImgFrame.src = productData.imgSrc;
      mainImgFrame.alt = productData.name;
      productTitle.textContent = productData.name;
      Price.textContent = productData.price;
    }
  });


//*******fonction teb3a el button mta el quantity*********//
  const myInput = document.getElementById("my-input");
function stepper(btn){
    let id = btn.getAttribute("id");
    let min = myInput.getAttribute("min");
    let max = myInput.getAttribute("max");
    let step = myInput.getAttribute("step");
    let val = myInput.getAttribute("value");
    let calcStep = (id == "increment") ? (step*1) : (step * -1);
    let newValue = parseInt(val) + calcStep;
    console.log(newValue);

    if(newValue >= min && newValue <= max){
        myInput.setAttribute("value", newValue);
    }

}


//*********kenek visiteur w nzelet ala buy yhezek lel sign in direct***********//
function sign() {
  let logedin = JSON.parse(sessionStorage.getItem("logedin"));
  if (!logedin || logedin.value !== "yes") {
    window.location.href = "SignIn.php";
    return false; // Prevent form submission
  }
  return true; // Allow form submission
}





function changeClass(element) {
  var allForWhom = sectionDiv.querySelectorAll('.for-whom');
  for (var i = 0; i < allForWhom.length; i++) {
    allForWhom[i].classList.remove('for-whom1');
  }
  element.parentElement.classList.add('for-whom1');
}
