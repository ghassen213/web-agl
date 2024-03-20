<?php
session_start(); 
include("database.php"); // connection base

$isLoggedIn = 0; // Default value
$fullName = ""; // Initialize fullName variable
$userID = 0; // Initialize userID variable

if (!empty($_POST["submit"])) {
    $email = $_POST['uname'];
    $password = $_POST['psw'];

    $query = "SELECT * FROM client WHERE email = '$email' and password='$password'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        // User login successful
        $row = mysqli_fetch_assoc($result);
        $userID = $row['id']; // Get the ID of the user
        $fullName = $row['nom'] . " " . $row['prenom']; // Concatenate name and surname
        mysqli_close($conn);
        $isLoggedIn = 1; 
    } else if ($email == "admin@gmail.com" && $password == "admin") {
        // Admin login successful
        mysqli_close($conn);
        $isLoggedIn = 2;
    } else {
        // Login failed
        $isLoggedIn = 3;
    }
}

// Set the session variables based on the values retrieved
$_SESSION["isLoggedIn"] = $isLoggedIn;// Store isloggedIn in session variable
$_SESSION["fullName"] = $fullName; // Store fullName in session variable
$_SESSION["userID"] = $userID; // Store userID in session variable
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique Name Sign-In</title>
    <link rel="stylesheet" href="SignUp.css">
</head>
<body>
    <div id="maincontainer">
        <div id="left">
            <div></div>
            <div><p id="shortmsg" style="font-size: 35px;font-family: cursive;margin-bottom: 100px;">Welcome!!!</p></div>
            <div>
               
            </div>
        </div>
        <div id="right" style="padding: 10px;">
            <h1>Please Enter Your Details</h1>
            <h3>Don't Have a Account <a href="SignUp.php">Register Here</a></h3>
            <form action="" method="post" id="myform">
                <label for="uname"><b>Email</b></label><br>
                <input type="email" id="email" placeholder="Enter Email" name="uname" required/><br><br>
                <label for="psw"><b>Password</b></label><br>
                <input type="password" id="password" placeholder="Enter Password" name="psw" required/><br><br>
                <span class="psw"><a href="">Forgot password?</a></span><br><br>
                <input type="submit" value="Submit" id="submit" name="submit"  />
            </form><br>
            <div style="margin-top: 0px;" id="inst">
                <p>Or  SignIn  Using</p>
            </div>
            <div id="image" style="margin-bottom: 20px;">
                <img src="https://cdn1.harryanddavid.com/wcsstore/HarryAndDavid/images/Auth0/fb_signin.png">
                <img src="https://cdn1.harryanddavid.com/wcsstore/HarryAndDavid/images/Auth0/btn_google_signin_light_normal_web@2x.png" >
            </div>
        </div>
    </div>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<script>
        let message = document.getElementById("shortmsg")
        var isLoggedIn = <?=$isLoggedIn ?> ;
        console.log("isLoggedIn:", isLoggedIn);
        if (isLoggedIn == 1) {
            var fullName = <?php echo json_encode($fullName); ?>;
            window.sessionStorage.setItem("logedin", JSON.stringify({ "value": "yes" }));
            window.sessionStorage.setItem("clname", JSON.stringify({ "name": fullName }));
            message.innerHTML = "Log in Successful"
            setTimeout(() => window.location.href = "index.html", 1500);
        }else if(isLoggedIn == 2){
            window.location.href = "admin.php"
        }else if (isLoggedIn == 3){
            message.innerHTML = "wrong credentials"
        }   
        
    </script>
</body>

</html>



