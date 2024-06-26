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
if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == 1 && isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];
    // Retrieve user data from the database based on the user ID
    $query = "SELECT * FROM commande WHERE id_client = $userID";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful and if there is any data returned
    if ($result && mysqli_num_rows($result) > 0) {
        $purchase_history = array();
        while ($row = mysqli_fetch_assoc($result)) {
            // Store the purchase history information in an array
            $purchase_history[] = $row;
            // Retrieve payment information for each order
            $commande_id = $row['id_commande'];
            $query2 = "SELECT paid FROM payment WHERE id_commande = '$commande_id'";
            $result2 = mysqli_query($conn, $query2);
            if ($result2 && mysqli_num_rows($result2) > 0) {
                $payment_info = mysqli_fetch_assoc($result2);
                $purchase_history[count($purchase_history) - 1]['paid'] = $payment_info['paid'];
            } else {
                // No payment information found for this order
                $purchase_history[count($purchase_history) - 1]['paid'] = 'Not available';
            }
        }
    } else {
        // No purchase history found
        $purchase_history = array();
    }
} else {
    // User not logged in or session data not set
    $purchase_history = array();
}

// Check if cancel button is clicked
if(isset($_POST['cancel'])) {
    $orderId = $_POST['order_id'];
    // Update the state of the order to "canceled" in the database
    $query = "UPDATE commande SET State = 'canceled' WHERE id_commande = $orderId";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo "<script>alert('Order canceled successfully!'); window.location.href = window.location.href;</script>";
    } else {
        echo "<script>alert('Failed to cancel order.');</script>";
    }
}
else if (isset($_POST['pay'])) {
    $orderId = $_POST['order_id'];
    $_SESSION["lastInsertedProductID"]=$orderId;
    sleep(2);
    header("Location: payment.php");
    exit();


}
?>

<?php
include("database.php");

if (isset($_POST["update"])) {
    // Initialize variables to store the updated values
    $updateQuery = [];
    $updateQuery2 = [];

    // Sanitize input data
    $userID = mysqli_real_escape_string($conn, $_SESSION["userID"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $name2 = mysqli_real_escape_string($conn, $_POST["name2"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    
    // Check which fields have been provided by the user and add them to the update queries
    if (!empty($name)) {
        $updateQuery[] = "nom = '$name'";
    }
    if (!empty($name2)) {
        $updateQuery[] = "prenom = '$name2'";
    }
    if (!empty($email)) {
        $updateQuery[] = "email = '$email'";
    }
    if (!empty($password)) {
        $updateQuery[] = "password = '$password'";
    }
    
    // Construct and execute the update query for the client table
    if (!empty($updateQuery)) {
        $query = "UPDATE client SET " . implode(", ", $updateQuery) . " WHERE id = $userID";
        $result = mysqli_query($conn, $query);
        echo "<script>window.location.href = window.location.href;</script>";
        

    

        
    }
    
    // Check if the address field was provided and add it to the update query
    if (isset($_POST["adresse"])) {
        $adresse = mysqli_real_escape_string($conn, $_POST["adresse"]);
        $updateQuery2[] = "adresse = '$adresse'";
        
        // Construct and execute the update query for the carte table
        $query2 = "UPDATE carte SET " . implode(", ", $updateQuery2) . " WHERE id = $userID";
        $result2 = mysqli_query($conn, $query2);
        echo "<script>window.location.href = window.location.href;</script>";
    }elseif(empty($updateQuery) && empty($updateQuery2)){
        echo "<script>alert('No Data typed!'); window.location.href = window.location.href;</script>";
     }
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
          <img  class="rose-logo" src="./images/logo.png" alt="logo">
            <span>Flora Boutique </span>
          </div>
          
          <div class="header-right">
            <a id="signupButton" href="index.html" class="button"><i class="fa fa-home">Home</a></i>
          </div>
        </div>
      </header>

    <section class="main-profil">
    <div class="container"> 
       
        
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
            </div>

            <?php if(empty($purchase_history)): ?>
                <div class="tabShow">
                    <h1>Payment Info</h1>  
                    <h1 style="margin-top: 300px ; color :brown";>No Card Used Yet.</h1>   
                </div>         
               
                <?php else: ?>
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
                </div>
            <?php endif; ?>

            <?php $counter = 2; ?>
            <?php if(!empty($purchase_history)): ?>
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
                    <?php if ($item['nom_produit'] == 'customized product') : ?>
                    <h2>Your selection</h2>
                    <input type="text" class="input" value="<?php echo $item['perso_data']; ?>">
                    <?php endif; ?>
                    <div style="display: flex";>

                    <div style="width: 350px";>
                    <h2>Order ID</h2>
                    <input type="text" class="input" value="<?php echo $item['id_commande']; ?>">
                    </div>
                    <div style="width: 300px";>
                    <h2>State</h2>
                    <div style="display: flex";>
                    <div>
                        <?php if (($item['paid'] == 'NO') && ($item['State']!='canceled')): ?>
                            <input type="text" class="input" value="Not Paid" style="color: red ; font-weight: bold;">
                             <div style="display: flex";>
                                <form method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $item['id_commande']; ?>">
                                    <button type="submit" name="cancel" style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">Cancel</button>
                                    <button type ="submit" name="pay" style="background-color: green; color: white; border: none; padding: 5px 10px; cursor: pointer;">Pay</button>

                                </form>
                             </div>
                        
                        <?php else: ?>
                            <?php 
                                $state = $item['State'];
                                $color = '';
                                switch ($state) {
                                    case 'delivered':
                                    case 'picked':
                                        $color = 'green';
                                        break;
                                    case 'In Progress':
                                    case 'ready to be picked':
                                        $color = 'orange';
                                        break;
                                    case 'canceled':
                                        $color = 'red';
                                        break;
                                    default:
                                        $color = 'black'; // You can set default color here
                                        break;
                                }
                            ?>
                            <input type="text" class="input" value="<?php echo $state; ?>" style="color: <?php echo $color; ?>; font-weight: bold;">
                            <?php if ($state !== 'delivered' && $state !== 'picked' && $state !== 'canceled'): ?>
                                <form method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $item['id_commande']; ?>">
                                    <button type="submit" name="cancel" style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">Cancel</button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    </div>
                </div>
                
                </div>
                
                    <?php if ($index > 0): ?>
                        <button class="btn" onclick="tabs(<?php echo $counter - 1; ?>)">Previous</button>
                    <?php endif; ?>
                    <?php if (isset($purchase_history[$index + 1])): ?>
                        <button class="btn" onclick="tabs(<?php echo $counter +1; ; ?>)">Next</button>
                
                    <?php endif; ?>
                </div>
                <?php $counter++; ?>
            <?php endforeach; ?>
            
            <?php else: ?>
                <div class="tabShow">
                    <h1>Purchase History</h1>
                    <h1 style="margin-top: 300px ; color :brown";>No purchase history found.</h1>
                </div>
            <?php endif; ?>
          
           
           

        
            <div class="Settings tabShow">
            <h1>Settings</h1>
            <form id="update_form" method="post" action="">
                <h2>Change First Name</h2>
                <input type="text" class="input" name="name" value="">
                <h2>Change Last Name</h2>
                <input type="text" class="input" name="name2" value="">
                <h2>Change Adresse</h2>
                <input type="text" class="input" name="adresse" value="">
                <h2>Change Email</h2>
                <input type="email" class="input" name="email" value="">
                <h2>Change Password</h2>
                <input type="password" class="input" id="updatedpass" name="password" value="">
                <span class="fa fa-eye" id="togglePasswordVisibility2" onclick="togglePasswordVisibility2()"></span>
                
                <!-- Delete Account Button -->
                <button class="btn" type="submit" name="update" style="margin-left: 170px;" onclick="reload()">Update</button>
                
            

                <!-- Update Button -->
            
            </form>
            </div>  
        </div>

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
                    <?php if ($counter == 2) : ?>
                     <a  onclick="tabs(3)" class="tab">
                    <i class="fa fa-cog"></i>
                    </a>
                <?php else : ?>
                <a  onclick="tabs(<?php echo isset($counter) ? $counter : ''; ?>)" class="tab">
                    <i class="fa fa-cog"></i>
                    </a>
                <?php endif; ?>
                
                
            </nav>
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
function togglePasswordVisibility2() {  
    var updatedpass = document.getElementById("updatedpass");
    var eyeIcon2 = document.getElementById("togglePasswordVisibility2");

  if (updatedpass.type === "password") {
      updatedpass.type = "text";
      eyeIcon2.classList.remove("fa-eye");
      eyeIcon2.classList.add("fa-eye-slash");
  } else {
        updatedpass.type = "password";
        eyeIcon2.classList.remove("fa-eye-slash");
        eyeIcon2.classList.add("fa-eye");
  }
}
</script>

    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>


</body>
</html>    
