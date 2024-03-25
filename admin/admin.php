<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./admin.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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
            <h1><span class="navicon" onclick="(window.location.href='index.php')">&#8801</span><span id="task_name"> Dashboard</span></h1>
            <h1>Hii... Admin</h1>
        </nav>
        <div id="dashboard">
            <div id="recntTask">
                <div id="TotalItems">
                    <div>
                        <p>Total Items<br><span id="newtotal">40</span></p>
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
                    <p></p>
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
            <div id="addrender"></div>
            <div id="addform">
                <h2>ADD Product</h2>
                <form >
                    <input id="img" type="text" placeholder="Image">
                    <input id="title" type="text" placeholder="Title">
                    <input id="color" type="text" placeholder="Color">
                    <input id="price" type="number" placeholder="Price">
                    <input id="rating" type="number" placeholder="Rating">
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
        <div id="updateproduct">
            <div id="updaterender"></div>
            <div id="updateform">
                <h2>Update Product</h2>
                <form >
                    <input id="img" type="text" placeholder="Image">
                    <input id="title" type="text" placeholder="Title">
                    <input id="color" type="text" placeholder="Color">
                    <input id="price" type="number" placeholder="Price">
                    <input id="rating" type="number" placeholder="Rating">
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>

        <!-- delete product -->
        <div id="deletedrender"></div>

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
let productID = 0
let newdeleted = 0
let edited = 0
let newadded = 0


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
    fetchAddData()
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
    fetchEditData()
}





// delete product
async function deletepageproduct() {
    deletebutton.style.backgroundColor = 'rgb(254, 203, 203)'
    addbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    dashbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    editbutton.style.backgroundColor = 'rgb(252, 242, 242)'
    userbutton.style.backgroundColor = 'rgb(252, 242, 242)'

    deletedrender.style.display = 'grid'
    addproduct.style.display = 'none'
    dashboard.style.display = 'none'
    updateproduct.style.display = 'none'
    userdetails.style.display = 'none'
    task_name.innerText = 'Delete Product'


}






userbutton.addEventListener('click', () => {
    userbuttonpage()
})

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
