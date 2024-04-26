
<?php
include("database.php");

// Define the categories
$categories = ['','anniversaire', 'mariage', 'valentine'];

// Initialize arrays to store data for each category
$dataByCategory = [];

// Query and fetch data for each category
foreach ($categories as $category) {
    $query = "SELECT nom, prix, img_src , Availability FROM produit WHERE catégorie='$category'";
    $result = mysqli_query($conn, $query);

    // Store data in arrays
    $names = [];
    $price = [];
    $img_src = [];
    $state = [];


    while ($row = mysqli_fetch_assoc($result)) {
        $names[] = $row['nom'];
        $price[] = $row['prix'];
        $img_src[] = $row['img_src'];
        $state[] = $row['Availability'];
    }

    // Store data arrays in associative array by category
    $dataByCategory[$category] = [
        'names' => $names,
        'price' => $price,
        'img_src' => $img_src,
        'state' => $state
    ];
}

// Convert the associative array to JSON for JavaScript
$jsDataByCategory = json_encode($dataByCategory);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Flowers shop - catalogue</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="catalogue.css">
</head>
<body>
<main class="main-container">
  <header>
    <div class="header">
      <div class="header-left">
        <img  class="rose-logo" src="./images/logo.png" alt="logo">
        <span><a href="index.html">Flora Boutique</a></span>
      </div>
      
      <div class="header-right">
        <a id="signupButton"  class="button" onclick="return sign()">
          Customize</a>
      </div>
    </div>
  </header>
  

<div class="flowers-catalogue">
  <div class="center">
    <h1 class="page-header title">Flowers Catalogue</h1>
    <form action="" class="search-bar">
      <input type="text" placeholder="search anything" name="q">
      <button type="submit"><img src="images/search.png"></button>
      
    </form>
    <div class="select-menu">
      <div class="select">
        <span>Category</span>
        <i class="fa fa-angle-down"></i>
      </div>
      <div class="options-list">
        <div class="option" onclick="tabs(0)">All</div>
        <div class="option" onclick="tabs(1)">Anniversary</div>
        <div class="option" onclick="tabs(2)">Wedding</div>
        <div class="option" onclick="tabs(3)">Valentin</div>
      </div>
    </div>
    
  </div>
  <div class="funnel">
    <span><i class="fa fa-filter" aria-hidden="true"></i> Filters</span>
  </div>
  <div class="main-box">
    <div class="filter-box">
      <div class="slider-container">
        <div class="spacer"></div>
      <span>Price</span>
        <input type="range" id="priceSlider" min="30" max="150" value="30">
        <span id="priceValue">$30</span>
      </div>
      

      
      <div class="section1">
        <div class="spacer"></div>
          <span>Category</span>
          <div class="for-whom">
            <div class="checkmark" onclick="changeClass(this)"><i class="fa fa-check" ></i></div>
            <span >Anniversary</span>
          </div>
          
          <div class="for-whom">
            <div class="checkmark" onclick="changeClass(this)"><i class="fa fa-check" ></i></div>
            <span >Birthday</span>
          </div>
          <div class="for-whom ">
            <div class="checkmark" onclick="changeClass(this)"><i class="fa fa-check" ></i></div>
            <span >valentin's Day</span>
          </div>
          <div>
           
            <span class="fa fa-lock" >   More Coming soon ...</span>
          </div>
          
        </div>
        
      
      <div class="show-btn">Show results</div>
    </div>
    <div class="results-box" id="results-container"></div>
    <script>
  var names = <?php echo $jsDataByCategory; ?>;
  console.log(names['mariage']);
  

  
  var resultsData = [
    { name: names['mariage'].names[0], imgSrc: names['mariage'].img_src[0],   price: "$" + names['mariage'].price[0], state: names['mariage'].state[0] },
    { name: names['valentine'].names[0], imgSrc: names['valentine'].img_src[0],   price: "$" + names['valentine'].price[0] , state: names['mariage'].state[0] },
    { name: names['anniversaire'].names[0], imgSrc: names['anniversaire'].img_src[0],   price: "$" + names['anniversaire'].price[0] , state: names['mariage'].state[0] },
    { name: names['mariage'].names[1], imgSrc: names['mariage'].img_src[1],  price: "$" + names['mariage'].price[1] , state: names['mariage'].state[1]},
    { name: names['valentine'].names[1], imgSrc: names['valentine'].img_src[1],   price: "$" + names['valentine'].price[1] , state: names['mariage'].state[1]},
    { name: names['anniversaire'].names[1], imgSrc: names['anniversaire'].img_src[1],   price: "$" + names['anniversaire'].price[1] , state: names['mariage'].state[1]},
    { name: names['mariage'].names[2], imgSrc: names['mariage'].img_src[2],   price: "$" + names['mariage'].price[2] , state: names['mariage'].state[2]},
    { name: names['valentine'].names[2], imgSrc: names['valentine'].img_src[2],   price: "$" + names['valentine'].price[2] , state: names['mariage'].state[2]},
    { name: names['anniversaire'].names[2], imgSrc: names['anniversaire'].img_src[2],   price: "$" + names['anniversaire'].price[2] , state: names['mariage'].state[2]},
    { name: names['mariage'].names[3], imgSrc: names['mariage'].img_src[3],   price: "$" + names['mariage'].price[3] , state: names['mariage'].state[3]},
    { name: names['valentine'].names[3], imgSrc: names['valentine'].img_src[3],   price: "$" + names['valentine'].price[3] , state: names['mariage'].state[3]},
    { name: names['anniversaire'].names[3], imgSrc: names['anniversaire'].img_src[3],   price: "$" + names['anniversaire'].price[3] , state: names['mariage'].state[3]}
];

  function generateResultHTML(result, index) {
    var color = result.state === 'on stock' ? 'green' : 'red';

    return `
      <div class="result result${index + 1}">
        <i class="fa fa-heart-o" aria-hidden="true" onclick="changeClass2(this)"></i>
        <div class="img-frame">
          <a href="product.php">
            <img src="${result.imgSrc}" alt="${result.altText}" onclick="storeProductData('${result.name}', '${result.price}', '${result.imgSrc}','${result.state}')">
          </a>
        </div>
        <span>${result.name}</span>
        <span class="price-span">${result.price} <a href="product.php"><i class="fa fa-shopping-cart" aria-hidden="true" ></i></a></span>
        <span class="price-span" style="color: ${color}; font-size:22px;">${result.state}</span>

      </div>
    `;
  }
 

  function storeProductData(name, price, imgSrc, state) {
  const productData = {
    name: name,
    price: price,
    imgSrc: imgSrc,
    state: state
  };
  sessionStorage.setItem('selectedProduct', JSON.stringify(productData));
  console.log("Product data stored in session storage:", productData);
}

  const resultsContainer = document.getElementById('results-container');
  resultsData.forEach((result, index) => {
    resultsContainer.innerHTML += generateResultHTML(result, index);
  });
</script>




    <div class="results-box" id="results-container2"></div>
    <script>
  var names = <?php echo $jsDataByCategory; ?>;

  
  
  const resultsData2 = [
    { name: names['anniversaire'].names[0], imgSrc: names['anniversaire'].img_src[0],   price: "$" + names['anniversaire'].price[0], state: names['anniversaire'].state[0] },
    { name: names['anniversaire'].names[1], imgSrc: names['anniversaire'].img_src[1],   price: "$" + names['anniversaire'].price[1] , state: names['anniversaire'].state[1] },
    { name: names['anniversaire'].names[2], imgSrc: names['anniversaire'].img_src[2],   price: "$" + names['anniversaire'].price[2], state: names['anniversaire'].state[2] },
    { name: names['anniversaire'].names[3], imgSrc: names['anniversaire'].img_src[3],   price: "$" + names['anniversaire'].price[3] , state: names['anniversaire'].state[3] },
    { name: names['anniversaire'].names[4], imgSrc: names['anniversaire'].img_src[4],   price: "$" + names['anniversaire'].price[4] , state: names['anniversaire'].state[4]},
    { name: names['anniversaire'].names[5], imgSrc: names['anniversaire'].img_src[5],   price: "$" + names['anniversaire'].price[5] , state: names['anniversaire'].state[5]}
  ];

  function generateResultHTML(result, index) {
    var color = result.state === 'on stock' ? 'green' : 'red';
  return `
    <div class="result result${index + 1}">
      <i class="fa fa-heart-o" aria-hidden="true" onclick="changeClass2(this)"></i>
      <div class="img-frame">
        <a href="product.php">
          <img src="${result.imgSrc}" alt="${result.altText}" onclick="storeProductData('${result.name}', '${result.price}', '${result.imgSrc}','${result.state}')">
        </a>
      </div>
   
        <span>${result.name}</span>
        <span class="price-span">${result.price} <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></span>
        <span class="price-span" style="color: ${color}; font-size:22px;">${result.state}</span>
   
    </div>
  `;
}


function storeProductData(name, price, imgSrc, state) {
  const productData = {
    name: name,
    price: price,
    imgSrc: imgSrc,
    state: state
  };
  sessionStorage.setItem('selectedProduct', JSON.stringify(productData));

}

  const resultsContainer2 = document.getElementById('results-container2');
  resultsData2.forEach((result, index) => {
    resultsContainer2.innerHTML += generateResultHTML(result, index);
  });
</script>






    <div class="results-box" id="results-container3"></div>
    <script>
  var names = <?php echo $jsDataByCategory; ?>;
  
  const resultsData3 = [
    { name: names['mariage'].names[0], imgSrc: names['mariage'].img_src[0],   price: "$" + names['mariage'].price[0] , state: names['mariage'].state[0] },
    { name: names['mariage'].names[1], imgSrc: names['mariage'].img_src[1],   price: "$" + names['mariage'].price[1]  , state: names['mariage'].state[1]},
    { name: names['mariage'].names[2], imgSrc: names['mariage'].img_src[2],   price: "$" + names['mariage'].price[2] , state: names['mariage'].state[2] },
    { name: names['mariage'].names[3], imgSrc: names['mariage'].img_src[3],   price: "$" + names['mariage'].price[3]  , state: names['mariage'].state[3]},
    { name: names['mariage'].names[4], imgSrc: names['mariage'].img_src[4],   price:  "$" + names['mariage'].price[4]  , state: names['mariage'].state[4]},
    { name: names['mariage'].names[5], imgSrc: names['mariage'].img_src[5],   price:  "$" + names['mariage'].price[5]  , state: names['mariage'].state[5]}
  ];

  function generateResultHTML(result, index) {
    var color = result.state === 'on stock' ? 'green' : 'red';
    return `
      <div class="result result${index + 1}">
        <i class="fa fa-heart-o" aria-hidden="true" onclick="changeClass2(this)"></i>
        <div class="img-frame">
          <a href="product.php">
            <img src="${result.imgSrc}" alt="${result.altText}" onclick="storeProductData('${result.name}', '${result.price}', '${result.imgSrc}','${result.state}')">
          </a>
        </div>
        <span>${result.name}</span>
        <span class="price-span">${result.price} <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></span>
        <span class="price-span" style="color: ${color}; font-size:22px;">${result.state}</span>
      </div>
    `;
  }

  function storeProductData(name, price, imgSrc, state) {
  const productData = {
    name: name,
    price: price,
    imgSrc: imgSrc,
    state: state
  };
  sessionStorage.setItem('selectedProduct', JSON.stringify(productData));

}

  const resultsContainer3 = document.getElementById('results-container3');
  resultsData3.forEach((result, index) => {
    resultsContainer3.innerHTML += generateResultHTML(result, index);
  });
</script>

    <div class="results-box" id="results-container4"></div>
    <script>
      var names = <?php echo $jsDataByCategory; ?>;
      

  
      const resultsData4 = [
    { name: names['valentine'].names[0], imgSrc: names['valentine'].img_src[0],   price: "$" + names['valentine'].price[0], state: names['valentine'].state[0]  },
    { name: names['valentine'].names[1], imgSrc: names['valentine'].img_src[1],   price: "$" + names['valentine'].price[1], state: names['valentine'].state[1]},
    { name: names['valentine'].names[2], imgSrc: names['valentine'].img_src[2],   price: "$" + names['valentine'].price[2], state: names['valentine'].state[2]},
    { name: names['valentine'].names[3], imgSrc: names['valentine'].img_src[3],   price: "$" + names['valentine'].price[3], state: names['valentine'].state[3]},
    { name: names['valentine'].names[4], imgSrc: names['valentine'].img_src[4],   price: "$" + names['valentine'].price[4], state: names['valentine'].state[4]},
    { name: names['valentine'].names[5], imgSrc: names['valentine'].img_src[5],   price: "$" + names['valentine'].price[5], state: names['valentine'].state[5]}
];

  function generateResultHTML(result, index) {
    var color = result.state === 'on stock' ? 'green' : 'red';
    return `
      <div class="result result${index + 1}">
        <i class="fa fa-heart-o" aria-hidden="true" onclick="changeClass2(this)"></i>
        <div class="img-frame">
          <a href="product.php">
            <img src="${result.imgSrc}" alt="${result.altText}" onclick="storeProductData('${result.name}', '${result.price}', '${result.imgSrc}','${result.state}')">
          </a>
        </div>
        <span>${result.name}</span>
        <span class="price-span">${result.price} <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></span>
        <span class="price-span" style="color: ${color}; font-size:22px;">${result.state} </span>
      </div>
    `;
  }

  
function storeProductData(name, price, imgSrc, state) {
  const productData = {
    name: name,
    price: price,
    imgSrc: imgSrc,
    state: state
  };
  sessionStorage.setItem('selectedProduct', JSON.stringify(productData));
}

  const resultsContainer4 = document.getElementById('results-container4');
  resultsData4.forEach((result, index) => {
    resultsContainer4.innerHTML += generateResultHTML(result, index);
  });
</script>

  </div>
</section>
<footer>
     
  <div class="footer_section">
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
             <p class="copyright_text">2024 All Rights Reserved. Design by <a href="#4">Our Team</a></p>
          </div>
       </div>
    </div>
 
</footer>
</main> 
</body>
<script src="catalogue.js"></script>
</html>
