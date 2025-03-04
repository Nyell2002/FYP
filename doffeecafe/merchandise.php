<?php
include 'connection.php'; // Include connection file
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Doffee&copy;-Merchandise</title>
  <link rel="stylesheet" href="style.css" />
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
  <div class="navbar">
    <div class="navbar-container">
      <a href="index.html">
        <img src="img/tugu.png" alt="pic" id="logo" />
      </a>
      <ul class="menu" id=merch>
        <li><a href="index.html#about">About</a></li>
        <li><a href="index.html#menus">Menu</a></li>
        <li><a href="index.html#contact">Contact</a></li>
        <li><a href="index.html">Home</a></li>
      </ul>
      <ul class="extra-menu">
        <li class="shp-bag">
          <a href="view_orders.php"><i data-feather="shopping-bag"></i></a>
        </li>
        <li class="navbar-cart">
          <a href="#" id="cart-btn"><i data-feather="shopping-cart"></i></a>
        </li>
          <li class="navbar-xmenu">
            <a href="#" id="ham-menu"><i data-feather="menu"></i></a>
          </li>
        </ul>
    </div>
  </div>
  <section class="merchandise">
    
    <h1>Our <span>Merchandise</span></h1>
    <p>Discover exclusive Doffee Cafe merchandise crafted for coffee lovers!</p>
    <div class="row">

<?php
// Fetch merchandise data
$sql = "SELECT * FROM merchandise";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="product-card">
          <img src="/doffeecafe/' . $row['image'] . '" alt="' . $row['name'] . '" />
          <h2>' . htmlspecialchars($row['name']) . '</h2>
          <p class="price">MYR ' . htmlspecialchars($row['price']) . '</p>
          <p class="description">' . htmlspecialchars($row['description']) . '</p>
          <button 
            class="btn" 
            onclick="addToCart({ 
              name: \'' . addslashes($row['name']) . '\', 
              price: ' . htmlspecialchars($row['price']) . ', 
              image: \'' . htmlspecialchars($row['image']) . '\' 
            })">
            Add to Cart
          </button>
        </div> ';
}
} else {
    echo "<p>No merchandise available yet. Check back soon!</p>";
}
?>

    </div>
    <!-- CART POPUP -->
    <div id="cart-popup" class="cart-popup">
      <div class="cart-content">
        <h2>Your Shopping Cart</h2>
        <div id="cart-items">
          <p>Your cart is empty.</p>
        </div>
        <button class="btn" id="checkout-btn">Checkout</button>
        <button id="close-cart" class="btn">Close</button>
      </div>
    </div>
  </section>
  <div class="slogan-container">
        <p class="slogan">Ingat Kopi, Ingat Doffee! &#11044; Ingat Kopi, Ingat Doffee! &#11044; Ingat Kopi, Ingat Doffee!
        </p>
    </div>
  <footer>
    <div class="sosial">
      <a
        href="https://www.instagram.com/dniel.ilhn?igsh=cTZ0cW40ZmtsazM2&utm_source=qr"
        ><i data-feather="instagram"></i
      ></a>
      <a href="https://x.com/dnielilhn?s=21"
        ><i data-feather="twitter"></i
      ></a>
      <a href="https://www.facebook.com/share/12CB4K1K2QW/?mibextid=wwXIfr"
        ><i data-feather="facebook"></i
      ></a>
    </div>
    <div class="link">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#menus">Menu</a>
        <a href="#contact">Contact</a>
      </div>
    <div class="credit">
      <p>Created by <a href="">Daniel Ilhan</a> | &copy; 2024.</p>
    </div>
  </footer>

  <script src="js/cart.js"></script>
  <script src="js/ads.js"></script>
  <script src="js/script.js"></script>
  <script src="js/order.js"></script>
  <script>
    feather.replace();
  </script>
</body>
</html>
