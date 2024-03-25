<?php
session_start();

include ("database.php");
if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == 1 && isset($_SESSION["userID"])) {
  $userID = $_SESSION["userID"];

  if (isset($_POST['submit'])) {
  // Retrieve data from form
  $product_title = $_POST['product_title'];
  $product_price = $_POST['product_price'];
  $product_size = $_POST['product_size'];
  $product_quantity = $_POST['product_quantity'];

  // Prepare and execute SQL query
  $sql = "INSERT INTO commande (nom_produit, size, prix, quantity, id_client) VALUES ('$product_title', '$product_size', '$product_price', '$product_quantity' , $userID)";

  if (mysqli_query($conn, $sql)) {  
      mysqli_close($conn);
      sleep(2);
      header("Location: payment.php");
      exit();
  
  } else {
    // Handle error
    echo "Error: ";
  }
  }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Flowers shop - Product page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="product.css">
  <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond&display=swap" rel="stylesheet"> 
</head>
<body>

  <!-- header of the page-->
  
  <header>
    <div class="header">
      <div class="header-left">
        <img  class="rose-logo" src="./images/rose-logo.png" alt="logo">
        <span>Boutique Name</span>
      </div>
    </div>
  </header>
  <!-- main container -->

  <main class="main-container">
    <div class="selected-product">
      <div class="product-img">

        <div class="main-img-frame">
          <img src="" alt="Turkish Rose">
        </div>
      </div>
      <div class="product-info">
        <div class="product-title line">
          <h1></h1>
          <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i></a>
        </div>
        <div class="size line">Size:</div>
        <div class="size-options line">
          <form class="quantity">
            <input type="radio" id="q1" name="quantity" checked><label for="q1">9 unt.</label>
            <input type="radio" id="q2" name="quantity"><label for="q2">15 unt.</label>
            <input type="radio" id="q3" name="quantity"><label for="q3">21 unt.</label>
            <input type="radio" id="q4" name="quantity"><label for="q4">31 unt.</label>
          </form>
        </div>
        <div class="other-options line">
          <div class="color-picker">
            <span>Color:</span>
            <div class="balls">
              <div class="color-ball color-ball1"></div>
              <div class="color-ball color-ball2"></div>
              <div class="color-ball color-ball3"></div>
              <div class="color-ball color-ball4"></div>
            </div>
          </div>
          <div class="delivery">
            <span>Delivery:</span>
            <div class="delivery-options">
              <div class="options-line">
                <div class="checkmark1 checkmark"></div>
                <div class="delivery-option">By courier</div>
                <div class="checkmark2 checkmark"></div>
                <div class="delivery-option">Pick up</div>
              </div>
          </div>
         
          <div class="quantity2">
            <span>Quantity:</span>
            <div class="stepper">
              <button id="decrement" onclick="stepper(this)"> - </button>
              <input type="number" min="0" max="20" step="1" value="1" id="my-input" readonly>
              <button id="increment" onclick="stepper(this)"> + </button>
          </div>
          </div>
        </div>
        </div>
        <div class="total line">
          <span>Price:</span>
          <span class="price"> </span>
          <form id="buy-form" action="" method="post" onsubmit="return sign()">
            <input type="hidden" id="product-title" name="product_title">
            <input type="hidden" id="product-size" name="product_size">
            <input type="hidden" id="product-quantity" name="product_quantity">
            <input type="hidden" id="product-price" name="product_price">
            <input type="submit" class="buy-btn" value="Buy" name="submit"  />
          </form>
        </div>
      </div>
    </div>

    <!-- related products section -->

    <div class="related-products">
      <nav class="related-products-bar">
        <h2 class="title">Related products</h2>
        <div class="related-arrows">
          <i class="fa fa-angle-left" aria-hidden="true"></i>
          &nbsp;
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </div>
      </nav>
      <div class="related-box">
        <div class="related1 related">
          <a href=""><i class="fa fa-heart-o like" aria-hidden="true"></i></a>
          <div class="img-frame">
            <a href="product.html">
              <img src="./images/trjar.png" alt="Turkish Rose">
            </a>
          </div>
          <span>Turkish Rose</span>
          <span class="price-span">$49 <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></span>
        </div>
        <div class="related2 related">
          <a href=""><i class="fa fa-heart-o like" aria-hidden="true"></i></a>
          <div class="img-frame">
            <a href="product.html">
              <img src="./images/rfjar.png" alt="Rose Flower">
            </a>
          </div>
          <span>Rose Flower</span>
          <span class="price-span">$49 <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></span>
        </div>
        <div class="related3 related">
          <a href=""><i class="fa fa-heart-o like" aria-hidden="true"></i></a>
          <div class="img-frame">
            <a href="product.html">
              <img src="./images/acjar.png" alt="Assorted Colors">
            </a>
          </div>
          <span>Assorted Colors</span>
          <span class="price-span">$49 <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></span>
        </div>
      </div>
    </div>
    
  </main>
  <footer>
     
    <div class="footer_section" id="5">
      <div class="container3">
         <div class="location_main">
            <div class="location_text"><a href="#"><span class="padding_15"><i class="fa fa-map-marker" ></i></span> Location</a></div>
            <div class="location_text"><a href="#"><span class="padding_15"><i class="fa fa-phone" ></i></span> Call +216 71-235-095</a></div>
            <div class="location_text"><a href="#"><span class="padding_15"><i class="fa fa-envelope" ></i></span>BoutiqueName@gmail.com</a></div>
         </div>
         <div class="footer_section_2">
            <div class="row">
               <div class="zone">
                  <h3 class="footer_text">About Us</h3>
                  <p class="lorem_text">With a commitment to quality and creativity, we source the freshest blooms from trusted local growers and artisans, ensuring that each arrangement is a vibrant celebration of nature's beauty. Whether you're marking a special occasion, sending a thoughtful gesture, or simply indulging in a bit of floral luxury for yourself, our dedicated team is here to exceed your expectations.</p>
               </div>
               <div class="zone">
                  <h3 class="footer_text">Services </h3>
                  <p class="lorem_text">At [Your Flower Shop Name], our dedicated team is always at your service, ready to assist you with all your floral needs. Whether you have questions about our products, need help selecting the perfect arrangement, or require assistance with your order, our knowledgeable and friendly staff are here to help.</p>
               </div>
               <div class="zone">
                  <h3 class="footer_text">Subscribe</h3>
                  <div class="form-group">
                     <textarea class="update_mail" placeholder="Enter Your Email" rows="5" id="comment" name="Enter Your Email"></textarea>
                     <div class="subscribe_bt"><a href="#">Subscribe</a></div>
                  </div>
                  <div class="social_icon">
                     <ul>
                        <li><a href="#"><div class="fa fa-facebook" ></div></a></li>
                        <li><a href="#"><div class="fa fa-twitter" ></div></a></li>
                        <li><a href="#"><div class="fa fa-linkedin" ></div></a></li>
                        <li><a href="#"><div class="fa fa-instagram" ></div></a></li>
                        <li><a href="#"><div class="fa fa-youtube-play"></div></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- copyright section start -->
   <div class="copyright_section">
      <div class="container3">
         <div class="row">
            <div class="zone2">
               <p class="copyright_text">2024 All Rights Reserved. Design by <a href="index.html #4">Our Team</a></p>
            </div>
         </div>
      </div>
   
  </footer>
  <script src="product.js">
    
  </script>



  
</body>

</html>


