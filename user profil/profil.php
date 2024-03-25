<?php
session_start(); 
include("database.php");

// Check if the user is logged in and has a valid user ID stored in the session
if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == 1 && isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];

    // Retrieve user data from the database based on the user ID
    $query = "SELECT * FROM client WHERE id = $userID";
    $result = mysqli_query($conn, $query);
    
    // Check if the query was successful and if there is any data returned
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Populate the profile fields with the user data
        $fullName = $row['nom'] . " " . $row['prenom'];
        $birthday = $row['birthday'];
        $gender = $row['gender'];
        $email = $row['email'];
        $password = $row['password']; // Note: It's not recommended to pre-fill the password field for security reasons
    }
}
?>
<?php

include("database.php");

// Check if the user is logged in and has a valid user ID stored in the session
if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == 1 && isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];

    // Retrieve user data from the database based on the user ID
    $query = "SELECT * FROM carte WHERE id = $userID";
    $result = mysqli_query($conn, $query);
    
    // Check if the query was successful and if there is any data returned
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Populate the profile fields with the user data
        $numcarte = $row['numcard'];
        $date_exp = $row['date_exp'];
        $adresse = $row['adresse'];
        $zipcode = $row['zipcode'];
        $cvv = $row['cvv']; // Note: It's not recommended to pre-fill the password field for security reasons
    }
}
?>
<?php
include("database.php");

// Check if the user is logged in and has a valid user ID stored in the session
if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == 1 && isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    // Retrieve user data from the database based on the user ID
    $query = "SELECT * FROM commande WHERE id_client = $userID";
    $result = mysqli_query($conn, $query);
    
    // Check if the query was successful and if there is any data returned
    if($result && mysqli_num_rows($result) > 0) {
        $purchase_history = array();
        while($row = mysqli_fetch_assoc($result)) {
            // Store the purchase history information in an array
            $purchase_history[] = $row;
        }
    } else {
        // No purchase history found
        $purchase_history = array();
    }
} else {
    // User not logged in or session data not set
    $purchase_history = array();
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Flowers shop - catalogue</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="profil.css">
</head>
<body>
    <header>
        <div class="header">
          <div class="header-left">
            <img  class="rose-logo" src="./images/rose-logo.png" alt="logo">
            <span>Boutique Name</span>
          </div>
          
          <div class="header-right">
            <a id="signupButton" href="index.html" class="button"><i class="fa fa-home">Home</a></i>
          </div>
        </div>
      </header>

    <section class="main-profil">
    <div class="container"> 
        <div class="leftbox">
            <nav>
                <a onclick="tabs(0)" class="tab">
                    <i class="fa fa-user"></i>
                </a>
                <a onclick="tabs(1)" class="tab">
                    <i class="fa fa-credit-card"></i>
                </a>
              
                <a onclick="tabs(2)" class="tab">
                    <i class="fa fa-shopping-cart"></i>
                </a>
                <a  onclick="tabs(6)" class="tab">
                    <i class="fa fa-cog"></i>
                    
                </a>
          
            </nav>
        </div>
        <div class="rightbox">
            <div class="profile tabShow">
                <h1>Personal Info</h1>
                <h2>Full Name</h2>
                <input type="text" class="input" value="<?php echo isset($fullName) ? $fullName : ''; ?>">
                <h2>Birthday</h2>
                <input type="text" class="input" value="<?php echo isset($birthday) ? $birthday : ''; ?>">
                <h2>Gender</h2>
                <input type="text" class="input" value="<?php echo isset($gender) ? $gender : ''; ?>">
                <h2>Email</h2>
                <input type="text" class="input" value="<?php echo isset($email) ? $email : ''; ?>">
                <h2>Password</h2>
                <input type="password" class="input" id="passwordField" value="<?php echo isset($password) ? $password : ''; ?>">
                <span class="fa fa-eye" id="togglePasswordVisibility" onclick="togglePasswordVisibility()"></span>
                <button class="btn">Update</button>
            </div>
       
            <div class="payment tabShow">
                <h1>Payment Info</h1>
                <h2>Payment Method</h2>
                <input type="text" class="input" value=" VisaCard- <?php echo isset($numcarte) ?  $numcarte : ''; ?>">
                <h2>Date_exp</h2>
                <input type="text" class="input" value="<?php echo isset($date_exp) ? $date_exp : ''; ?>">
                <h2>Adresse</h2>
                <input type="text" class="input" value="<?php echo isset($adresse) ? $adresse : ''; ?>">
                <h2>Zip Code</h2>
                <input type="text" class="input" value="<?php echo isset($zipcode) ? $zipcode : ''; ?>">
                <h2>cvv</h2>
                <input type="text" class="input" value="<?php echo isset($cvv ) ? $cvv  : ''; ?>">
                <button class="btn">Update</button>
            </div>
    
            <?php if(!empty($purchase_history)): ?>
            <?php $counter = 2; ?>
            <?php foreach($purchase_history as $index => $item): ?>
                <div class="history2 tabShow" id="history_<?php echo $counter; ?>">
                    <h1>Purchase History</h1>
                    <h2>Product Name</h2>
                    <input type="text" class="input" value="<?php echo $item['nom_produit']; ?>">
                    <h2>Size</h2>
                    <input type="text" class="input" value="<?php echo $item['size']; ?>">
                    <h2>Quantity</h2>
                    <input type="text" class="input" value="<?php echo $item['quantity']; ?>">
                    <h2>Price</h2>
                    <input type="text" class="input" value="<?php echo $item['prix']; ?>">
                    <h2>Purchase Date</h2>
                    <input type="text" class="input" value="<?php echo $item['date']; ?>">
                    <h2>Order ID</h2>
                    <input type="text" class="input" value="<?php echo $item['id_commande']; ?>">
                    <?php if ($index > 0): ?>
                        <button class="btn" onclick="tabs(<?php echo $counter - 1; ?>)">Previous</button>
                    <?php endif; ?>
                    <?php if (isset($purchase_history[$index + 1])): ?>
                        <button class="btn" onclick="tabs(<?php echo $counter + 1; ?>)">Next</button>
                    <?php else: ?>
                        <h3 style="color: brown";>No more purchases</h3>
                    <?php endif; ?>
                </div>
                <?php $counter++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <h1 class="tabShow" style="margin-top: 350px ; color :brown";>No purchase history found.</h1>
        <?php endif; ?>
            
             
          
           
           
        </div>

        
        
    </div>
</section>

  
    <footer>
     
        <div class="footer_section">
          <div class="container2">
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
          <div class="container2">
             <div class="row">
                <div class="zone2">
                   <p class="copyright_text">2024 All Rights Reserved. Design by <a href="#4">Our Team</a></p>
                </div>
             </div>
          </div>
        </div>  
       
    </footer>







 
    




<script>
    
    document.querySelectorAll(".tab").forEach(function(tab) {
    tab.addEventListener("click", function() {
        // Add "active" class to the clicked tab
        this.classList.add("active");
        
        // Remove "active" class from all siblings of the clicked tab
        var siblings = Array.from(this.parentNode.children);
        siblings.forEach(function(sibling) {
            if (sibling !== tab) {
                sibling.classList.remove("active");
            }
        });
    });
});

</script>
<script>    
const tab=document.querySelectorAll('.tabShow');

function tabs(panelIndex){
  tab.forEach(function(node , index){
    if (index === panelIndex) {
        tab[panelIndex].style.display="block";
        } else {
            node.style.display="none";
         
            
        }
    });
}
tabs(0);
function togglePasswordVisibility() {
  var passwordField = document.getElementById("passwordField");
  var eyeIcon = document.getElementById("togglePasswordVisibility");

  if (passwordField.type === "password") {
      passwordField.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
  } else {
      passwordField.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
  }
}

  
</script>

</body>
</html>    
