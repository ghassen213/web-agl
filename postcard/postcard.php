<?php
session_start(); 
include ('database.php');
if (isset($_POST['submit'])) {
    // Check if the form was submitted
    $last_id = $_SESSION["lastInsertedProductID"]; // Corrected session variable name
    $message = $_POST['message'];
    // Check if the email already exists in the database
    $sql = "UPDATE commande SET message='$message' WHERE id_commande='$last_id'";
    $result = mysqli_query($conn, $sql);
    if ($result){
      echo "<script>alert('thanks for shoping '); window.location.href = 'index.html';</script>";
    }
}
?>






<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page d'accueil</title>
  <link rel="stylesheet" href="postcard.css">
</head>
<body>
  <main>
    <section class="title">
      <h1>To your pens!</h1>
      <p>Choose the theme and a dash of inspiration...</p>
    </section>


    <section class="choix-thematique">
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
        <div class="buttons">
          <input type="submit" class="btn" name="submit" value="Valid" id="valid" onclick="submitForm(event)">
        </div>

      </form>
    </section>
  </main>
  <script >
document.addEventListener("DOMContentLoaded", function() {
    var images = document.querySelectorAll(".choix-thematique img");

    images.forEach(function(image) {
        image.addEventListener("click", function(event) {
            // Vérifier si une pointe verte existe déjà pour cette image
            var pointExist = document.querySelector(".point-vert");
            if (pointExist) {
                pointExist.parentNode.removeChild(pointExist); // Supprimer la pointe existante
            }

            // Créer la pointe verte
            var point = document.createElement("div");
            point.className = "point-vert";
            point.style.position = "absolute";
            point.style.top = "10px"; // Ajustez la position verticale selon vos préférences
            point.style.right = "10px"; // Ajustez la position horizontale selon vos préférences
            point.style.width = "20px"; // Ajustez la taille de la pointe selon vos préférences
            point.style.height = "20px"; // Ajustez la taille de la pointe selon vos préférences
            point.style.backgroundColor = "light green"; // Couleur verte


            // Ajouter la pointe verte à l'image parente
            image.parentNode.appendChild(point);
        });
    });
});

  </script>
  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</body>
</html>
