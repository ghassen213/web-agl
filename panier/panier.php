<?php
session_start(); 
include("database.php");


// Initialize an empty array to store purchase history
$purchase_history = array();

// Check if the user is logged in and has a valid user ID stored in the session
if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == 1 && isset($_SESSION["userID"])) {
    $userID = $_SESSION["userID"];

    // Retrieve user data from the database based on the user ID
    $query = "SELECT * FROM panier WHERE id_client = $userID";
   
    $result = mysqli_query($conn, $query);
    
    // Check if the query was successful and if there is any data returned
    if($result && mysqli_num_rows($result) > 0) {
        // Loop through each row of the result set
        while($row = mysqli_fetch_assoc($result)) {
            // Append the current row to the purchase history array
            $purchase_history[] = $row;
           
       
            
            
        }

    }
   $min_height = 1000;
   $total_height = count($purchase_history) * 300;
   $min_height = max($total_height, $min_height);
   
  

   // Handle delete item action
if(isset($_POST['delete_item'])) {
   $item_id = $_POST['item_id'];

   // Delete the item from the database
   $delete_query = "DELETE FROM panier WHERE id_panier = $item_id";
   mysqli_query($conn, $delete_query);

   // Redirect back to the cart page after deletion
   header("Location: panier.php");
   exit();
}
else if (isset($_POST['buy_item'])) {
   // Retrieve data from form
   foreach ($purchase_history as $item) {
      $product_title = $item['nom_produit'];
      $product_price = $item['prix'];
      $product_size = $item['size'];
      $product_quantity = $item['quantity'];
      $product_delivery = $item['delivery'];
      $item_id = $_POST['item_id'];
      // Your code here
  }
   // Prepare and execute SQL query to insert product into 'commande' table
   $sql_insert = "INSERT INTO commande (nom_produit, size, prix, quantity, Delivery, State, id_client) VALUES ('$product_title', '$product_size', '$product_price', '$product_quantity' , '$product_delivery', 'In Progress', $userID)";
   if (mysqli_query($conn, $sql_insert)) {  
     // Get the ID of the inserted product
     $last_id = mysqli_insert_id($conn);
     $sql1 = "INSERT INTO payment (id_commande ,paid) VALUES ('$last_id','NO')";
     $sql2 = "DELETE FROM panier WHERE id_panier = $item_id";
     mysqli_query($conn, $sql1);
     mysqli_query($conn, $sql2);

     // Store the ID in a session variable
     $_SESSION["lastInsertedProductID"] = $last_id;

     mysqli_close($conn);
     sleep(2);
     header("Location: payment.php");
     exit();
   };
}
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Flowers shop - catalogue</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="panier.css">
  
</head>
<body>
    <header>
        <div class="header">
          <div class="header-left">
          <img  class="rose-logo" src="./images/logo.png" alt="logo">
            <span>Flora Boutique </span>
          </div>
          
          <div class="header-right">
            <a id="homeButton" href="index.html" class="button"><i class="fa fa-home">Home</a></i>
          </div>
        </div>
    </header>
    <main>
      <h1 style="margin-left: 50px;">Your Cart</h1>
      <?php
echo '<div class="cart-container" style="height: ' . $min_height . 'px;">';
if (!empty($purchase_history)) :
    foreach ($purchase_history as $item) :
        if ($item['nom_produit'] == 'customized product') : ?>
            <div class="cart-item">
            
                <div class="item-details">
                    <img src="images/perso/custom.jpg" alt="">
                    <div class="info">
                        <h2><?php echo $item['nom_produit']; ?></h2>
                        <p>Price : <span><?php echo $item['prix']; ?></span></p>
                        <p>Size : <span><?php echo $item['size']; ?></span></p>
                        <p>Quantity : <span><?php echo $item['quantity']; ?></span></p>
                        <p>Delivery : <span><?php echo $item['delivery']; ?></span></p>
                        <p>your selection : <span><?php echo $item['perso_data']; ?></span></p>

                    </div>
                </div>
                <div class="item-actions">

                    <form action="" method="post">
                        <input type="hidden" name="item_id" value="<?php echo $item['id_panier']; ?>">
                        <button type="submit" name="buy_item">Buy</button>
                        <button type="submit" name="delete_item">Delete</button>
                    </form>
                </div>
            </div>
        <?php else : ?>
            <div class="cart-item">
                <?php
                $query1 = "SELECT img_src FROM produit WHERE nom = '{$item['nom_produit']}'";
                $result2 = mysqli_query($conn, $query1);

                // Check if the query was successful and if there is any data returned
                if ($result2 && mysqli_num_rows($result2) > 0) {
                    $row2 = mysqli_fetch_assoc($result2);
                    $src = $row2['img_src'];
                }
                ?>
                <div class="item-details">
                    <img src="<?php echo $src; ?>" alt="">
                    <div class="info">
                        <h2><?php echo $item['nom_produit']; ?></h2>
                        <p>Price : <span><?php echo $item['prix']; ?></span></p>
                        <p>Size : <span><?php echo $item['size']; ?></span></p>
                        <p>Quantity : <span><?php echo $item['quantity']; ?></span></p>
                        <p>Delivery : <span><?php echo $item['delivery']; ?></span></p>

                    </div>
                </div>
                <div class="item-actions">

                    <form action="" method="post">
                        <input type="hidden" name="item_id" value="<?php echo $item['id_panier']; ?>">
                        <button type="submit" name="buy_item">Buy</button>
                        <button type="submit" name="delete_item">Supprimer</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else : ?>
    <p>No Products found.</p>
<?php endif; ?>
</div>
     
    </main>

       
          
      </div>
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
  </body>
</html>   
