//******* Function teb3a el barre zarka mta el prix  **********/
const priceSlider = document.getElementById('priceSlider');
const priceValue = document.getElementById('priceValue');

priceSlider.addEventListener('input', () => {
  priceValue.textContent = '$' + priceSlider.value;
});

// Initialize the displayed value
priceValue.textContent = '$' + priceSlider.value;




//******** function ki tnnzel 3al les case li ta7et couleur trodhom checked *********//
function changeClass(element, section) {
  var sectionDiv = document.querySelector('.' + section);
  var allForWhom = sectionDiv.querySelectorAll('.for-whom');
  for (var i = 0; i < allForWhom.length; i++) {
    allForWhom[i].classList.remove('for-whom1');
  }
  element.parentElement.classList.add('for-whom1');
}

//******** ki tenzel al kaleb li fouk el produit ywali a7mer m3abi  **********//
function changeClass2(element) {
  var isHeartFilled = element.classList.contains('fa-heart');
  var allHeartIcons = document.querySelectorAll('.results-box i.fa-heart');
  
  if (isHeartFilled) {
    element.classList.remove('fa-heart');
    element.classList.add('fa-heart-o');
  } else {
 
    element.classList.remove('fa-heart-o');
    element.classList.add('fa-heart');
  }
}

//******** function bch tchecki beha el colors *********//
function selectColor(element) {
  var colors = document.querySelectorAll('.color');
  for (var i = 0; i < colors.length; i++) {
    colors[i].innerHTML = '&nbsp;';
   
  }
  var checkmark = document.createElement('i');
  checkmark.classList.add('fa', 'fa-check');
  element.appendChild(checkmark);

 

}


//********** hedhi lezem nfasarha  ************//
var nom = sessionStorage.getItem("nom");
var position = sessionStorage.getItem("position");
const tab = document.querySelectorAll('.results-box');
console.log(position);
console.log(nom);

function tabs(panelIndex) {
  tab.forEach(function (node) {
      node.style.display = "none";
  });
  tab[panelIndex].style.display = "flex";
}
if (nom && position) {
  tabs(position);
  const select = document.querySelector(".select"); 
  if (select) {
      const spanElement = select.querySelector("span"); 
      if (spanElement) {
          spanElement.innerHTML = nom;
      }
  }

} else {
  tabs(0);
}

function removeItemsFromSessionStorage() {
  sessionStorage.removeItem("nom"); 
  sessionStorage.removeItem("position");
}

window.addEventListener('beforeunload', function(event) {
  removeItemsFromSessionStorage();
});








//******** function teb3a menu mta el category ***********//
const select = document.querySelector(".select");
const options_list = document.querySelector(".options-list");
const options = document.querySelectorAll(".option");

//show & hide options list
select.addEventListener("click", () => {
  options_list.classList.toggle("active");

});

//select option
options.forEach((option) => {
  option.addEventListener("click", () => {
    options.forEach((option) => {option.classList.remove('selected')});
    select.querySelector("span").innerHTML = option.innerHTML;
    option.classList.add("selected");
    options_list.classList.toggle("active");
   
  });
});


