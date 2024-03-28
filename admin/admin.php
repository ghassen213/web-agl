<?php
include("database.php");

// Fetch data from the database
$query = "SELECT * FROM produit"; // Assuming 'produits' is the name of your products table
$result = mysqli_query($conn, $query);

// Initialize an array to store product data
$resultsData = [];

// Fetch each row of data and store it in the array
while ($row = mysqli_fetch_assoc($result)) {
    $resultsData[] = [
        'name' => $row['nom'],
        'imgSrc' => $row['img_src'],
        'price' => "$" . $row['prix'],
        'state' =>$row['Availability']
    ];
}

// Convert the PHP array to JSON for JavaScript
$jsResultsData = json_encode($resultsData);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["product_name"])) {
    // Include database connection


    // Sanitize input
    $productName = htmlspecialchars($_POST["product_name"]);

    // Perform the deletion query
    $query = "DELETE FROM produit WHERE nom = '$productName'";
    $result = $conn->query($query);

    // Check if deletion was successful
    if ($result) {
        echo "<script>alert('Product deleted successfully!'); window.location.href = window.location.href;</script>";
    } else {
        echo "<script>alert('Failed to delete product!'); window.location.href = window.location.href;</script>";
    }

    // Close connection
    $conn->close();

}
?>

<?php
// Initialize variables to count form submissions

// Retrieve form data and determine form type
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['form_type'])) {
        $formType = $_POST['form_type'];
        if ($formType === "insert") {
            // Handle insertion logic
            $imgSrc = $_POST['img'];
            $title = $_POST['title'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $availability = $_POST['rating'];

            // Insert data into the database
            $sql = "INSERT INTO produit (img_src, nom, prix, catégorie, Availability) 
                    VALUES ('$imgSrc', '$title', '$price', '$category', '$availability')";
            
            $result = $conn->query($sql);
            if ($result) {
            echo "<script>alert('Product Added successfully!'); window.location.href = window.location.href;</script>";
            } else {
                echo "<script>alert('Failed to Add product!'); window.location.href = window.location.href;</script>";
            }
        } elseif ($formType === "update") {
            // Handle updating logic
            $name = $_POST['name'];
            $imgSrc = $_POST['img'];
            $title = $_POST['title'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $availability = $_POST['rating'];

            // Update product data in the database
            $sql = "UPDATE produit 
                    SET img_src = '$imgSrc', nom = '$title', prix = '$price', catégorie = '$category', Availability = '$availability' 
                    WHERE nom = '$name'";
            
            $result = $conn->query($sql);
            if ($result) {
            echo "<script>alert('Product Edited successfully!'); window.location.href = window.location.href;</script>";
            } else {
            echo "<script>alert('Failed to Edit product!'); window.location.href = window.location.href;</script>";
            }

        }
    }   
}

// Close database connection
$conn->close();

// Output the count of inserts and updates

?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Hub</title>
    <link rel="stylesheet" href="./admin.css">
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body>
    <aside id="asidenav">
        <div>
            <br>
            <P id="dashbutton"><span class="material-symbols-outlined">menu</span> <span class="icontext" id="task">Dashboard</span></P>
            <P id="addbutton"><span class="material-symbols-outlined">folder_open</span> <span class="icontext" >Add Product</span></P>
            <P id="editbutton"><span class="material-symbols-outlined">edit_square</span> <span class="icontext" >Edit Product</span></P>
            <P id="deletebutton"><span class="material-symbols-outlined">delete</span> <span class="icontext">Delete Product</span> </P>
            <P id="userbutton"><span class="material-symbols-outlined">manage_accounts</span><span class="icontext">User</span> </P>
        </div>
        <div id="moreinfo">
            <P id="logout"><span class="material-symbols-outlined">logout</span><span class="icontext">Log Out</span> </P>
        </div>
    </aside>
    <main>
        <nav id="navtop">
            <h1><span class="navicon" >&#8801</span><span id="task_name"> Dashboard</span></h1>
            <h1>Hii... Admin</h1>
        </nav>
        <div id="dashboard">
            <div id="recntTask">
                <div id="TotalItems">
                    <div>
                        <p>Total Items<br><span id="newtotal">21</span></p>
                        <img src="https://www.iconpacks.net/icons/3/free-icon-blue-shopping-cart-10910.png" alt="">
                    </div>
                    <p></p>
                </div>
                <div id="NewlyAdded">
                    <div>
                        <p>New Added<br><span id="newadd">0</span></p>
                        <img src="https://www.iconpacks.net/icons/3/free-icon-green-shopping-cart-10909.png" alt="">
                    </div>
                    <p></p>
                </div>
                <div id="TotalEdited">
                    <div>
                        <p>Total Edited<br><span id="newedit">0</span></p>
                        <img src="https://www.iconpacks.net/icons/3/free-icon-yellow-shopping-cart-10905.png" alt="">
                    </div>
                    <p></p>
                </div>

                <div id="TotalDeleted">
                    <div>
                        <p>Deleted<br><span id="newdelete">0</span></p>
                        <img src="https://www.iconpacks.net/icons/3/free-icon-red-shopping-cart-10906.png
                            " alt="">
                    </div>
                </div>
            </div>
            <div id="adminDetails">
                <div id="fullinfo">
                    <img src="images/pie_chart222.gif" alt="">
                </div>
                <div id="adminadname">
                    <h4>Admins -</h4>
                    <!-- <p> IA - Ritesh kamthe</p> -->
                    <p><span class="codehidden"></span>- Adem Fathali</p>
                    <p><span class="codehidden"></span>- Mohamed Amine Bhouri</p>
                    <p><span class="codehidden"></span>- Ghassen Dhouib</p>
                    <p><span class="codehidden"></span>- Nour Lefi</p>
                    <!-- <p> Fw22_418 - Anand Singh</p> -->
                </div>
            </div>
        </div>
        <!-- add product  -->
        <div id="addproduct">
            <div id="addrender">
            <div class="results-box1" id="results-container"> </div>

                 <script>
                    var resultsData = <?php echo $jsResultsData; ?>;

                    function generateResultHTML(result) {
                        // Define color based on result.state
                        var color = result.state === 'on stock' ? 'green' : 'red';

                        return `
                        <div class="result">
                            <div class="img-frame">
                                <a href="product.php">
                                    <img src="${result.imgSrc}" alt="${result.altText}">
                                </a>
                            </div>
                            <span>${result.name}</span>
                            <span class="price-span">${result.price}</span>
                            <span class="price-span" style="color: ${color}; font-size:22px;">${result.state}</span>
                        </div>
                        `;
                    }

                    // Generate HTML for each product and append it to the div
                    var resultContainer = document.getElementById('results-container');
                    resultsData.forEach(function(product) {
                        resultContainer.innerHTML += generateResultHTML(product);
                    });

                    // Function to delete product
                </script>
            </div>
            <div id="addform">
                <h2>ADD Product</h2>
                <form action="" method="post" >
                    <input type="hidden" name="form_type" value="insert">
                    <input name="img" type="text" placeholder="Image source">
                    <input name="title" type="text" placeholder="Title">
                    <input name="price" type="text" placeholder="Price">
                    <input name="category" type="text" placeholder="Category">
                    <input name="rating" type="text" placeholder="Availability">
                    <input type="submit" value="Add">
                </form>
            </div>
        </div>





        <div id="updateproduct">
            <div id="updaterender">
            <div class="results-box1" id="results-container2"> </div>

           <script>
                    var resultsData2 = <?php echo $jsResultsData; ?>;

                    function generateResultHTML(result) {
                        // Define color based on result.state
                        var color = result.state === 'on stock' ? 'green' : 'red';

                        return `
                        <div class="result">
                            <div class="img-frame">
                                <a href="product.php">
                                    <img src="${result.imgSrc}" alt="${result.altText}">
                                </a>
                            </div>
                            <span>${result.name}</span>
                            <span class="price-span">${result.price}</span>
                            <span class="price-span" style="color: ${color}; font-size:22px;">${result.state}</span>
                        </div>
                        `;
                    }

                    // Generate HTML for each product and append it to the div
                    var resultContainer2 = document.getElementById('results-container2');
                    resultsData2.forEach(function(product) {
                        resultContainer2.innerHTML += generateResultHTML(product);
                    });

                    // Function to delete product
                </script>
            </div>
           
            <div id="updateform">
                <h2>Update Product</h2>
                <form action="" method="post" >
                    <input type="hidden" name="form_type" value="update">
                    <input name="name" type="text" placeholder="Product Name you want to change">
                    <br>
                    <h2 style="margin: 20px 130px;">New Data</h2>
                    <input name="img" type="text" placeholder="Image source">
                    <input name="title" type="text" placeholder="Title">
                    <input name="price" type="text" placeholder="Price">
                    <input name="category" type="text" placeholder="Category">
                    <input name="rating" type="text" placeholder="Availability">
                    <input type="submit" value="Update">
                </form>
            </div>
        </div>

        <!-- delete product -->
        <div id="deletedrender">

            <div class="results-box2" id="results-container3"> </div>

            <script>
                var resultsData3 = <?php echo $jsResultsData; ?>;

                function generateResultHTML(result) {
                        // Define color based on result.state
                        var color = result.state === 'on stock' ? 'green' : 'red';

                        return `
                        <div class="result">
                        <i class="fa fa-trash-o"  onclick="deleteProduct('${result.name}')"></i>
                            <div class="img-frame2">
                                <a href="product.php">
                                    <img src="${result.imgSrc}" alt="${result.altText}">
                                </a>
                            </div>
                            <span>${result.name}</span>
                            <span class="price-span">${result.price}</span>
                            <span class="price-span" style="color: ${color}; font-size:22px;">${result.state}</span>
                        </div>
                        `;
                    }

                // Generate HTML for each product and append it to the div
                var resultContainer3 = document.getElementById('results-container3');
                resultsData3.forEach(function(product) {
                    resultContainer3.innerHTML += generateResultHTML(product);
                });

                // Function to delete product

                function deleteProduct(productName) {
                if (confirm("Are you sure you want to delete this product?")) {
        
                    // Create a form element
                    var form = document.createElement("form");
                    form.method = "POST";
                    form.action = "";

                    // Create a hidden input field for product name
                    var productNameField = document.createElement("input");
                    productNameField.type = "hidden";
                    productNameField.name = "product_name";
                    productNameField.value = productName;

                    // Append the input field to the form
                    form.appendChild(productNameField);

                    // Append the form to the document body
                    document.body.appendChild(form);


                    event.preventDefault();

                    // Submit the form
                    form.submit();
             

                    
                }

            }

            // Use the updatedDeleteCount variable as needed, such as inserting it into HTML
            
            </script>
        </div>
        <!-- user details -->
        <div id="userdetails">
            <table>
                <thead>
                    <th style="padding-bottom: 10px;">Name</th>
                    <th style="padding-bottom: 10px;">Lastname</th>
                    <th style="padding-bottom: 10px;">Email</th>
                    <th style="padding-bottom: 10px;">Delete</th>
                </thead>
                <tbody>
                    <?php
                    include("database.php");
                

                    
                    $sql = "SELECT * FROM client";
                    $result = mysqli_query($conn, $sql);
                    

                    // Check if there are any users
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                    

                            // Output the user details as table rows
                            echo "<tr>";
                            echo "<td>" . $row['nom'] . "</td>";
                            echo "<td>" . $row['prenom'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td><button onclick=\"deleteUser(this)\">Delete</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No users found</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>

 <script>
    // Function to delete a user row
    function deleteUser(button) {
        if (confirm("Are you sure you want to delete this user?")) {
            // Find the closest <tr> element (the row containing the button)
            var row = button.closest('tr');
            // Remove the row from the table
            row.remove();
        }
    }
</script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>
<script>



let task_name = document.getElementById('task_name')
let dashboard = document.getElementById('dashboard')
let addproduct = document.getElementById('addproduct')
let deletedrender = document.getElementById('deletedrender')
let updateproduct = document.getElementById('updateproduct')
let userdetails = document.getElementById('userdetails')

let dashbutton = document.getElementById('dashbutton')
let addbutton = document.getElementById('addbutton')
let editbutton = document.getElementById('editbutton')
let deletebutton = document.getElementById('deletebutton')
let userbutton = document.getElementById('userbutton')
let logout = document.getElementById('logout')


dashbutton.addEventListener('click', () => {
    showdashboardpage()
    showdetails()
})

addbutton.addEventListener('click', () => {
    showaddpage()
})
deletebutton.addEventListener('click', () => {
    deletepageproduct()
})
editbutton.addEventListener('click', () => {
    editbuttonpage()
})
userbutton.addEventListener('click', () => {
    userbuttonpage()
})

showdashboardpage()

logout.addEventListener('click', () => {
    window.location.href = "signIn.php";
});

// to show dashbooard
function showdashboardpage() {
    dashbutton.style.backgroundColor = 'rgb(254, 203, 203)'
    addbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    editbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    deletebutton.style.backgroundColor = 'rgb(252, 242, 242)'
    userbutton.style.backgroundColor = 'rgb(252, 242, 242)'

    dashboard.style.display = 'block'
    addproduct.style.display = 'none'
    deletedrender.style.display = 'none'
    updateproduct.style.display = 'none'
    userdetails.style.display = 'none'
    task_name.innerText = 'Dashboard'
}

// to show addpage
function showaddpage() {
    addbutton.style.backgroundColor = 'rgb(254, 203, 203)'
    dashbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    editbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    deletebutton.style.backgroundColor = 'rgb(252, 242, 242)'
    userbutton.style.backgroundColor = 'rgb(252, 242, 242)'

    addproduct.style.display = 'grid'
    dashboard.style.display = 'none'
    deletedrender.style.display = 'none'
    updateproduct.style.display = 'none'
    userdetails.style.display = 'none'
    task_name.innerText = 'Add Product'
   
}
// edit data
function editbuttonpage() {
    editbutton.style.backgroundColor = 'rgb(254, 203, 203)'
    addbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    dashbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    deletebutton.style.backgroundColor = 'rgb(252, 242, 242)'
    userbutton.style.backgroundColor = 'rgb(252, 242, 242)'

    updateproduct.style.display = 'grid'
    deletedrender.style.display = 'none'
    addproduct.style.display = 'none'
    dashboard.style.display = 'none'
    userdetails.style.display = 'none'
    task_name.innerText = 'Edit Product'
   
}

// delete product
async function deletepageproduct() {
    deletebutton.style.backgroundColor = 'rgb(254, 203, 203)'
    addbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    dashbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    editbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    userbutton.style.backgroundColor = 'rgb(252, 242, 242)'

    deletedrender.style.display = 'flex'
    addproduct.style.display = 'none'
    dashboard.style.display = 'none'
    updateproduct.style.display = 'none'
    userdetails.style.display = 'none'
    task_name.innerText = 'Delete Product'


}
function userbuttonpage(params) {
    userbutton.style.backgroundColor = 'rgb(254, 203, 203)'
    deletebutton.style.backgroundColor = 'rgb(252, 242, 242)'
    addbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    dashbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    editbutton.style.backgroundColor = 'rgb(252, 242, 242)'

    userdetails.style.display = 'block'
    deletedrender.style.display = 'none'
    addproduct.style.display = 'none'
    dashboard.style.display = 'none'
    updateproduct.style.display = 'none'
    task_name.innerText = 'User Details'


   
}

</script>    
</body>


</html>
