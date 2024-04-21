<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="payment.css">
</head>
<body>
    <main>
        <form action="" method="post">
            <div class="container">
                
                <div class="left">
                    <h3>BILLING ADDRESS</h3>
                    
                        Full name
                        <input type="text" name="full_name" placeholder="Enter name"  />
                        
                        Email
                        <input type="email" name="email" placeholder="Enter email" />
                        
                        Address
                        <input type="text" name="address" placeholder="Enter address" />

                        City
                        <input type="text" name="city" placeholder="Enter city" />

                        <div id="Pin-code">
                            <label class="state" >
                                State
                                <input type="text" name="state" placeholder="Enter your state" />
                            </label>

                            <label class="sec1">
                                <div>
                                zip code 
                                </div>
                                
                                <input type="number" name="zipcode" placeholder="Pin code" />
                            </label>
                        </div>
                    
                </div>
            </div>
            <div class="container">    
                <div class="right">
                    <h3>PAYMENT</h3>
                
                        Accepted card
                        <img src="https://logodix.com/logo/845851.png" alt="">
                        
                        Card number
                        <input type="text" name="card_number" placeholder="Enter card number" />
            
            
                        Exp month
                        <input type="text" name="exp_month" placeholder="Enter month" />
            
                        <div id="Pin-code">
                            <label>
                                <DIV>Exp year</DIV>
                                
                                <select name="exp_year" required>
                                    <option value="">Choose Year</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                </select>
                            </label>
            
                            <label class="sec2">
                                <div>CVV</div>
        
                                <input type="number" name="cvv" placeholder="CVV" pattern="[0-9]{3}" required/>

                            </label>
                            
                        </div>
                    <input type="submit" name="submit" value="Proceed Payment" class="btn">    
                        
                
                </div>
            </div>
         </form>

    </main>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
    <script src="payment.js"></script>

</body>

</html>

<?php
session_start(); 
include ('database.php');

if (isset($_POST['submit'])) {
    // Check if the form was submitted

    $numcard = $_POST['card_number'];
    $date_exp = $_POST['exp_year'];
    $adresse = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $cvv = $_POST['cvv'];
    $userID = $_SESSION["userID"];
    $last_id = $_SESSION["lastInsertedProductID"];

    $checkCardQuery = "SELECT numcard FROM carte WHERE numcard = '$numcard' ";
    $result = mysqli_query($conn, $checkCardQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "Card exists";
        // Email already exists, display error message
        $sql1 = "UPDATE payment SET paid = 'Yes', numcarte='$numcard' WHERE id_commande = '$last_id'";
        if (mysqli_query($conn, $sql1)) {  
            mysqli_close($conn);
            sleep(2);
            header("Location: postcard.php");
            exit();
        }
    }else {
        $sql = "INSERT INTO carte (numcard, date_exp, adresse, zipcode, cvv, id) VALUES ('$numcard', '$date_exp', '$adresse', '$zipcode', '$cvv', '$userID')";
        if (mysqli_query($conn, $sql)) {
            // Update payment table to mark the payment as paid
            $sql1 = "UPDATE payment SET paid = 'Yes', numcarte='$numcard' WHERE id_commande = '$last_id'";
            if (mysqli_query($conn, $sql1)) {
                mysqli_close($conn);
                sleep(2);
                header("Location: postcard.php");
                exit();
            }}   
    }
}    

?>
