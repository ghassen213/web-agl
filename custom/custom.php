<?php
session_start();

include ("database.php");

if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == 1 && isset($_SESSION["userID"])) {
  $userID = $_SESSION["userID"];

  if (isset($_POST['buy'])) {
    // Retrieve data from form
    $product_title = $_POST['product_title'];
    $product_size = $_POST['product_size'];
    $product_quantity = $_POST['product_quantity'];
    $product_delivery = $_POST['product_delivery'];
    $product_perso= $_POST['product_perso'];
    $product_message= $_POST['product_message'];

    // Prepare and execute SQL query to insert product
    $sql_insert = "INSERT INTO commande (nom_produit, size,  quantity, Delivery, perso_data , state , message, id_client) VALUES ('customized product', '$product_size', '$product_quantity' , '$product_delivery', '$product_perso' , 'In Progress' , '$product_message', $userID)";

    if (mysqli_query($conn, $sql_insert)) {  
      // Get the ID of the inserted product
      $last_id = mysqli_insert_id($conn);

      // Store the ID in a session variable
      $_SESSION["lastInsertedProductID"] = $last_id;

      mysqli_close($conn);
      sleep(2);
      header("Location: payment.php");
      exit();
     
     
  
    } else {
      // Handle error
      echo "Error: ";
    }
  }elseif (isset($_POST['addToCart'])) {
    // Retrieve data from form
    $product_title = $_POST['product_title'];
    $product_size = $_POST['product_size'];
    $product_quantity = $_POST['product_quantity'];
    $product_delivery = $_POST['product_delivery'];
    $product_perso= $_POST['product_perso'];

    // Prepare and execute SQL query to insert product into 'payment' table
    $sql_insert = "INSERT INTO panier (nom_produit, size,  quantity, Delivery, perso_data , id_client) VALUES ('customized product', '$product_size', '$product_quantity' , '$product_delivery', '$product_perso' , $userID)";
    if (mysqli_query($conn, $sql_insert)) {  
      echo "<script>alert('Item Added successfully!'); window.location.href = 'index.html';</script>";

    } else {
      // Handle error
      echo "Error: ";
    }
  }
}
?>



<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="custom.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

  <body>
   
    <div class="container">
      <div class="pages">
        <div class="page one">
           <section class="title">
            <h1>Bouquet Shape</h1>
            <p>choose the shape of your bouquet from the suggestions below:</p>
          </section>
    
    
        <section class="choix-thematique">
          <ul>
            <li><a href="#" id="img"><img src=" images/perso/rond.png" alt="Round"></a>
            <span>Round</span></li>
            <li><a href="#" id="img"><img src=" images/perso/champetre.png" alt="Classic"></a>
            <span>Classic</span></li>
          </ul>
        </section>
    
        <div class="btn">
            <button onClick="slide('next')">Next</button>
          </div>
        </div>



        <div class="page two">
          <section class="title">
            <h1>Dominant colors</h1>
            <p>choose the tone of your bouquet with the dominant color </p>
          </section>
        <div>
        <div class="color-option " style="background-color: #FF5733;" name="orange"></div>
        <div class="color-option" style="background-color: #6B8E23;" name="green"></div>
        <div class="color-option" style="background-color: #FFD700;" name="yellow"></div>
        <div class="color-option" style="background-color: #9370DB;" name="violet"></div>
        <div class="color-option" style="background-color: #FF1493;" name="pink"></div>
        <div class="color-option" style="background-color: #FFFFFF;" name="white"></div>
        </div>
        <div class="btn">
            <button onClick="slide('prev')">Previous</button>
            <button onClick="slide('next')">Next</button>
          </div>
        </div>


        <div class="page three">
          <section class="title">
            <h1>Special flowers</h1>
          </section>
          <section class="choix-thematique">
        <ul>
            <li>
                
                <a href="#" id="img"><img src="images/perso/lisianthus.png" alt="Lisianthus"></a>
                <span> Lisianthus</span>
            </li>
            <li>
                <a href="#" id="img"><img src="images/perso/Lys.png" alt="Lys"></a>
                <span> Lys</span>
            </li>
            <li>
                <a href="#" id="img"><img src="images/perso/roses.png" alt="Rose"></a>
                <span> Rose</span>
            </li>
            <li>
                <a href="#" id="img"><img src="images/perso/hortensia.png" alt="Hortensia"></a>
                <span> Hortensia</span>
            </li>
            <li>
                <a href="# " id="img"><img src="images/perso/germini.png" alt="Germini"></a>
                <span> Germini</span>
            </li>
            <li>
                <a href="# " id="img"><img src="images/perso/gypsophile.png" alt="Gypsophile"></a>
                <span> Gypsophile</span>
            </li>
        </ul>
        </section>
        
        <div class="btn">
            <button onClick="slide('prev')">Previous</button>
            <button onClick="slide('next')">Next</button>
          </div>
        </div>


        <div class="page four">
          <section class="title">
          <h1>Pretty foliage</h1>
          </section>
          <section class="choix-thematique">
        <ul>
            <li>
                <a href="#" id="img"><img src="images/perso/lentisque.png" alt="Lentisque"></a>
                <span> Lentisque</span>
            </li>
            <li>
                <a href="#" id="img"><img src="images/perso/eucalp.png" alt="Eucalyptus"></a>
                <span> Eucalyptus</span>
            </li>
            <li>
                <a href="#" id="img"><img src="images/perso/gramine.png" alt="Graminées"></a>
                <span> Graminees</span>
            </li>
            <li>
                <a href="#" id="img"><img src="images/perso/asparagus.png" alt="Asparagus"></a>
                <span> Asparagus</span>
            </li>
            <li>
                <a href="# " id="img"><img src="images/perso/beargrass.jpg" alt="Beargrass"></a>
                <span> Beargrass</span>
            </li>
            
        </ul>
        </section>

          <div class="btn">
            <button onClick="slide('prev')">Previous</button>
            <button onClick="slide('next')">Next</button>
          </div>
        </div>

        <div class="page five">
          <section class="title2">
            <h1>To your pens!</h1>
            <p>Choose the theme and a dash of inspiration...</p>
          </section>
      
      
          <section class="choix-thematique2">
            <ul>
              <li><a href="#" id="img"><img src=" images\annif.png" alt="Thématique 1"></a></li>
              <li><a href="#" id="img"><img src=" images\merci.png" alt="Thématique 2"></a></li>
              <li><a href="#" id="img"><img src=" images\fete.png" alt="Thématique 3"></a></li>
              <li><a href="#" id="img"><img src=" images\felic.png" alt="Thématique 4"></a></li>
              <li><a href="# " id="img"><img src=" images\love.png" alt="Thématique 5"></a></li>
            </ul>
          </section>
      
      
          <section class="formulaire">
            <form action="" method="post">
              
              <input type="text" id="nom" class="nom" name="nom" placeholder="Your Name (optional)">
              <br>
              <br>
              <textarea id="message" name="message" rows="10" cols="50" placeholder="Your Message (optional)"></textarea>

      
            </form>
          </section>
          <div class="btn">
            <button onClick="slide('prev')">Previous</button>
            <button onClick="slide('next')" onmouseover="filldata()">Next</button>
          </div>
        </div>

        <div class="page six">
          <section class="title2">
            <h1>Your Order !</h1>
          </section>
          <div class="product-info">
            <div class="order">
              <span>Forme: <span id="selectedForm"></span></span>
              <span>Color: <span id="selectedColor"></span></span>
              <span>Flower: <span id="selectedFlower"></span></span>
              <span>Foliage: <span id="selectedFoliage"></span></span>
              <span>price: <span></span> </span>
            </div>
            <div class="other-options line">
              <div class="delivery">
                <span>Quantity:</span>
                  <div class="stepper">
                    <button id="decrement" onclick="stepper(this)"> - </button>
                    <input type="number" min="0" max="20" step="1" value="1" id="my-input" readonly>
                    <button id="increment" onclick="stepper(this)"> + </button>
                  </div>
              </div>
              <div class="size-options ">
                <div class="delivery">
                <span>size:</span>
                <form class="quantity">
                  <input type="radio" id="q1" name="quantity" checked><label for="q1">9 unt.</label>
                  <input type="radio" id="q2" name="quantity"><label for="q2">15 unt.</label>
                  <input type="radio" id="q3" name="quantity"><label for="q3">21 unt.</label>
                  <input type="radio" id="q4" name="quantity"><label for="q4">31 unt.</label>
                </form>
              </div>
            </div>
              <div class="delivery">
                <span>Delivery:</span>
                <div class="delivery-options">
                  <div class="quantity ">
                    <input type="radio" id="q5" name="quantity"  ><label for="q5" >By courier</label>
                    <input type="radio" id="q6" name="quantity"><label for="q6">Pick up</label>
                
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="btn">
          <button onClick="slide('prev')">Previous</button>
            <form id="buy-form" action="" method="post">
            
            <input type="hidden" id="product-title" name="product_title">
            <input type="hidden" id="product-size" name="product_size">
            <input type="hidden" id="product-quantity" name="product_quantity">
            <input type="hidden" id="product-delivery" name="product_delivery">
            <input type="hidden" id="product-perso" name="product_perso">
            <input type="hidden" id="product-message" name="product_message">
            <input type="submit" class="cart-btn" value="Add to cart" name="addToCart"  />
            <input type="submit" class="buy-btn" value="confirm" name="buy"  />
          </form>
          </div>
        </div>
        

    
        
      </div>
    </div>
</body>  




<script>
const pages = document.querySelectorAll(".page");
    const translateAmount = 100; 
    let translate = 0;

    slide = (direction) => {

      direction === "next" ? translate -= translateAmount : translate += translateAmount;

      pages.forEach(
        pages => (pages.style.transform = `translateX(${translate}%)`)
      );
    }

    function retour(){
      window.history.back();
    }
</script>  


<script>    
    document.addEventListener("DOMContentLoaded", function() {
    var images = document.querySelectorAll(".choix-thematique img");

    images.forEach(function(image) {
        image.addEventListener("click", function(event) {
            // Check if a green point already exists for this image
            
            var pointExist = document.querySelector(".one .point");
            if (pointExist) {
                pointExist.parentNode.removeChild(pointExist); // Supprimer la pointe existante
            }
            var PointExists = this.parentNode.querySelector(".point");
            // If a green point exists, remove it; otherwise, create a new one
            if (PointExists) {
                PointExists.parentNode.removeChild(PointExists);
            } else {
                // Create green point
                var Point = document.createElement("div");
                Point.className = "point";
                this.parentNode.appendChild(Point);
            }
        });
    });
});
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var sections = document.querySelectorAll(".choix-thematique");

    sections.forEach(function(section, index) {
        var images = section.querySelectorAll("img");

        images.forEach(function(image) {
            image.addEventListener("click", function(event) {
                if (index === 0) {
                    // For index 0, only store one selected image at a time
                    var selectedImageKey = "selectedImage_" + index;
                    
                    // Remove previously stored selected image
                    sessionStorage.removeItem(selectedImageKey);

                    // Store the alt attribute value of the clicked image in session storage
                    sessionStorage.setItem(selectedImageKey, this.alt);
                } else {
                    // For indexes 1 and 2, allow multiple selections
                    var selectedImagesKey = "selectedImages_" + index;
                    // Retrieve existing selected images array from session storage
                    var existingSelectedImages = sessionStorage.getItem(selectedImagesKey);
                    var selectedImages = existingSelectedImages ? JSON.parse(existingSelectedImages) : [];
                    // Check if the image is already selected
                    var imageIndex = selectedImages.indexOf(this.alt);
                    if (imageIndex !== -1) {
                        // If already selected, remove it from the array
                        selectedImages.splice(imageIndex, 1);
                    } else {
                        // If not selected, add it to the array
                        selectedImages.push(this.alt);
                    }
                    // Store the updated selected images array in session storage
                    sessionStorage.setItem(selectedImagesKey, JSON.stringify(selectedImages));
                }
            });
        });
    });
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    var colorOptions = document.querySelectorAll(".color-option");

    colorOptions.forEach(function(option) {
        option.addEventListener("click", function(event) {
            // Toggle selection
            this.classList.toggle("selected");
            // Get all selected color names
            var selectedColorNames = [];
            document.querySelectorAll(".color-option.selected").forEach(function(selectedOption) {
                selectedColorNames.push(selectedOption.getAttribute("name"));
            });
            // Store selected color names in session storage
            sessionStorage.setItem("selectedColors", JSON.stringify(selectedColorNames));
            // Check if a green point already exists for this color option
            var pointExists = this.querySelector(".point2");
            // If a green point exists, remove it; otherwise, create a new one
            if (pointExists) {
                pointExists.parentNode.removeChild(pointExists);
            } else {
                // Create green point
                var point = document.createElement("div");
                point.className = "point2";
                // Append green point to the clicked color option
                this.appendChild(point);
            }
        });
    });
    // Check if there are previously selected colors and update the UI accordingly
    var storedSelectedColorNames = sessionStorage.getItem("selectedColors");
    if (storedSelectedColorNames) {
        var selectedColorNames = JSON.parse(storedSelectedColorNames);
        selectedColorNames.forEach(function(colorName) {
            var selectedOption = document.querySelector(".color-option[name='" + colorName + "']");
            if (selectedOption) {
                selectedOption.classList.add("selected");
            }
        });
    }
});

</script>


<script>
  function clearSessionStorage() {
    sessionStorage.removeItem("selectedImage_0");
    sessionStorage.removeItem("selectedImages_1");
    sessionStorage.removeItem("selectedImages_2");
    sessionStorage.removeItem("selectedColors");
  }
  window.addEventListener("beforeunload", clearSessionStorage);
</script>


<script>
  function filldata(){

  
    // Get selected items from session storage
    var selectedForm = sessionStorage.getItem("selectedImage_0");
    var selectedColor = sessionStorage.getItem("selectedColors");
    var selectedFlower = sessionStorage.getItem("selectedImages_1");
    var selectedFoliage = sessionStorage.getItem("selectedImages_2");

    // Format the selected items
    selectedColor = selectedColor ? selectedColor.replace(/[\[\]""]/g, '') : '';
    selectedFlower = selectedFlower ? selectedFlower.replace(/[\[\]""]/g, '') : '';
    selectedFoliage = selectedFoliage ? selectedFoliage.replace(/[\[\]""]/g, '') : '';

    // Update the HTML content with selected items
    document.getElementById("selectedForm").innerText = selectedForm;
    document.getElementById("selectedColor").innerText = selectedColor;
    document.getElementById("selectedFlower").innerText = selectedFlower;
    document.getElementById("selectedFoliage").innerText = selectedFoliage;
  };
</script>


<script>
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

</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var imagess = document.querySelectorAll(".choix-thematique2 img");

    imagess.forEach(function(imagee) {
        imagee.addEventListener("click", function(event) {
            // Vérifier si une pointe verte existe déjà pour cette image
            var pointExist = document.querySelector(".point-vert");
            if (pointExist) {
                pointExist.parentNode.removeChild(pointExist); // Supprimer la pointe existante
            }

            // Créer la pointe verte
            var point = document.createElement("div");
            point.className = "point-vert";
            point.style.position = "absolute";
            point.style.top = "5px"; // Ajustez la position verticale selon vos préférences
            point.style.right = "10px"; // Ajustez la position horizontale selon vos préférences
            point.style.width = "20px"; // Ajustez la taille de la pointe selon vos préférences
            point.style.height = "20px"; // Ajustez la taille de la pointe selon vos préférences
            point.style.backgroundColor = "pink"; // Couleur verte
            point.style.borderRadius= "50%";


            // Ajouter la pointe verte à l'image parente
            imagee.parentNode.appendChild(point);
        });
    });
});

</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  function updateProductDetails() {
    var title = document.getElementById("selectedForm").innerText;
    var size = document.querySelector('.size-options input[name="quantity"]:checked').nextElementSibling.innerText;
    var quantity = document.getElementById('my-input').value;
    var delivery = document.querySelector('.delivery-options input[name="quantity"]:checked').nextElementSibling.innerText;
    var colorText = document.getElementById("selectedColor").innerText;
    var flowerText = document.getElementById("selectedFlower").innerText;
    var foliageText = document.getElementById("selectedFoliage").innerText;
    var message = document.getElementById("message").value;

    var perso = [title, colorText, flowerText, foliageText].join(" / ");

    document.getElementById('product-title').value = title;
    document.getElementById('product-size').value = size;
    document.getElementById('product-quantity').value = quantity;
    document.getElementById('product-delivery').value = delivery;
    document.getElementById('product-perso').value = perso;
    document.getElementById('product-message').value = message;

    console.log(message);
    console.log(delivery);
  }

  document.querySelector('.buy-btn').addEventListener('click', updateProductDetails);
  document.querySelector('.cart-btn').addEventListener('click', updateProductDetails);
});
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>
