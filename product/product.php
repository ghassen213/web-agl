<?php
session_start();

include("database.php");

if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == 1 && isset($_SESSION["userID"])) {
  $userID = $_SESSION["userID"];

  if (isset($_POST['buy'])) {
    // Retrieve data from form
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_size = $_POST['product_size'];
    $product_quantity = $_POST['product_quantity'];
    $product_delivery = $_POST['product_delivery'];

    // Prepare and execute SQL query to insert product into 'commande' table
    $sql_insert = "INSERT INTO commande (nom_produit, size, prix, quantity, Delivery, State, id_client) VALUES ('$product_title', '$product_size', '$product_price', '$product_quantity' , '$product_delivery', 'In Progress', $userID)";
    if (mysqli_query($conn, $sql_insert)) {  
      // Get the ID of the inserted product
      $last_id = mysqli_insert_id($conn);
      $sql1 = "INSERT INTO payment (id_commande ,paid) VALUES ('$last_id','NO')";
      mysqli_query($conn, $sql1);

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
  } elseif (isset($_POST['addToCart'])) {
    // Retrieve data from form
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_size = $_POST['product_size'];
    $product_quantity = $_POST['product_quantity'];
    $product_delivery = $_POST['product_delivery'];

    // Prepare and execute SQL query to insert product into 'payment' table
    $sql_insert = "INSERT INTO panier (nom_produit , size, prix, quantity, Delivery, id_client) VALUES ('$product_title', '$product_size', '$product_price', '$product_quantity' , '$product_delivery',  $userID)";
    if (mysqli_query($conn, $sql_insert)) {  
      echo "<script>alert('Item Added successfully!'); window.location.href = window.location.href;</script>";
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
        <img  class="rose-logo" src="./images/logo.png"  alt="logo">
        <span><a href="index.html">Flora Boutique</a></span>
        
      </div>
    </div>
  </header>
  <!-- main container -->

  <main class="main-container">
    <div class="selected-product">
    <script>
    // Retrieve state from sessionStorage
    var productData = JSON.parse(sessionStorage.getItem('selectedProduct'));
    var state = productData ? productData.state : '';
  

    if (state === "on stock" || state=="main") {
        document.write(`
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
                    <div class="delivery">
                        <span>Quantity:</span>
                        <div class="stepper">
                            <button id="decrement" onclick="stepper(this)"> - </button>
                            <input type="number" min="0" max="20" step="1" value="1" id="my-input" readonly>
                            <button id="increment" onclick="stepper(this)"> + </button>
                        </div>
                    </div>
                    <div class="delivery">
                        <span>Delivery:</span>
                        <div class="delivery-options">
                            <div class="quantity ">
                                <input type="radio" id="q5" name="quantity" checked><label for="q5">By courier</label>
                                <input type="radio" id="q6" name="quantity"><label for="q6">Pick up</label>
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
                        <input type="hidden" id="product-delivery" name="product_delivery">
                        <input type="submit" class="cart-btn" value="Add to Cart" name="addToCart">
                        <input type="submit" class="buy-btn" value="Buy" name="buy">
                    </form>
                </div>
            </div>
        `);
    } else {
      document.write(`
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
                <div class="total line">
                    <span>Price:</span>
                    <span class="price"> </span>
                   
                </div>
                <h1 style="color : red ; margin : 50px 250px">Out of stock </h1>
            </div>
        `);
    }
</script>
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


