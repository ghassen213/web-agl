<?php
session_start(); 
include ('database.php');
$verif = 0 ;
if (isset($_POST['submit'])) {
    // Check if the form was submitted

    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $gender = $_POST['Gender'];
    $birthday = $_POST['Birthday'];
    $email = $_POST['email'];
    $password = $_POST['psw'];

    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT * FROM client WHERE email = '$email'";
    $result = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        // Email already exists, display error message
        $verif = 1;
    } else {
        // Email does not exist, proceed with data insertion
        $sql = "INSERT INTO client (nom, prenom, email, birthday, gender, password) VALUES ('$firstName', '$lastName' , '$email' , '$birthday' , '$gender' , '$password')";

        if (mysqli_query($conn, $sql)) {
            // Data inserted successfully
            $verif = 2;
            mysqli_close($conn);
        } else {
            // Handle error
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
$_SESSION["verif"] = $verif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="SignUp_SignIn.css">
</head>
<body>
    <div id="maincontainer">
        <div id="left">
            <div></div>
            <div><p id="shortmsg" style="font-size: 35px;font-family: cursive; ">Create an account for faster checkout and order tracking.</p></div>
            <div></div>
        
        </div>
        <div id="right">
            <h1>Create Account</h1><br>
            <form action="" method="post">
                <div id="inputdetail">
                    <div>
                        <label for="firstName"><b>First Name</b></label><br>
                        <input type="text" id="fname" placeholder="Entre here" name="FirstName" required/>
                    </div>
                    <div>
                        <label for="lastName"><b>Last Name</b></label><br>
                        <input type="text" id="lname" placeholder="Entre here" name="LastName" required/><br>
                    </div>
                </div>

                <label for="Gdender"><b>Gender</b></label><br>
                <input type="text" id="sex" placeholder="Enter Gender" name="Gender" required/><br><br>
                
                <label for="Birthday"><b>Birthday</b></label><br>
                <input type="date" id="bd" placeholder="Enter Birthday" name="Birthday" required/><br><br>
                
                <label for="email"><b>Email</b></label><br>
                <input type="email" id="email" placeholder="Enter Email" name="email" required/><br><br>
                
                <label for="psw"><b>Password</b></label><br>
                <input type="password" id="password" placeholder="Enter Password" name="psw" required/><br><br>
                <input type="submit" id="submit" value="Submit" name="submit" onclick="showmsg()" />
            </form>
            <div class="termContainer">
                <p>By continuing, you agree to our <a href="">Terms Of Uses</a> and <a href="">Privacy Notice</a>. </p>
            </div>
            <div id="inst">
                <p>Or SignUp Using</p>
            </div>
            <div id="image">
                <img src="https://cdn1.harryanddavid.com/wcsstore/HarryAndDavid/images/Auth0/fb_signin.png" >
                <img src="https://cdn1.harryanddavid.com/wcsstore/HarryAndDavid/images/Auth0/btn_google_signin_light_normal_web@2x.png">
            </div>
            <div id="newone">
                <p>Existing User?</p>
                <p> <a href="">Login</a></p>
            </div>
        </div>


    </div>
</body>


<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>
<script>
    var verif = <?=$verif?> ;
    let message = document.getElementById("shortmsg")
    if (verif == 1){
        message.innerHTML = "Email already used"
    }
    else if (verif == 2){
        message.innerHTML = "Sign Up Successful..."
        setTimeout(() => window.location.href = "signIn.php", 1500);

    }
</script>    

</html>


