const priceSlider = document.getElementById('priceSlider');
const priceValue = document.getElementById('priceValue');

priceSlider.addEventListener('input', () => {
  priceValue.textContent = '$' + priceSlider.value;
});

// Initialize the displayed value
priceValue.textContent = '$' + priceSlider.value;


function changeClass(element, section) {
  var sectionDiv = document.querySelector('.' + section);
  var allForWhom = sectionDiv.querySelectorAll('.for-whom');
  for (var i = 0; i < allForWhom.length; i++) {
    allForWhom[i].classList.remove('for-whom1');
  }
  element.parentElement.classList.add('for-whom1');
}

function changeClass2(element) {
  var isHeartFilled = element.classList.contains('fa-heart');
  var allHeartIcons = document.querySelectorAll('.results-box i.fa-heart');
  
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

function selectColor(element) {
  var colors = document.querySelectorAll('.color');
  for (var i = 0; i < colors.length; i++) {
    colors[i].innerHTML = '&nbsp;';
   
  }
  var checkmark = document.createElement('i');
  checkmark.classList.add('fa', 'fa-check');
  element.appendChild(checkmark);

 

}
