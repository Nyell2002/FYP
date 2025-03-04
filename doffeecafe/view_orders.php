<?php
session_start();

// Check if the email is set in the session
if (!isset($_SESSION['email'])) {
    // If not set, prompt the user to input their email
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
        // Set the email in session
        $_SESSION['email'] = $_POST['email'];
    }
}

// If the user is still not logged in, display the email input form
if (!isset($_SESSION['email'])) {
    echo '<div class="email-form">';
    echo '<h2>Please enter your email to view your order history</h2>';
    echo '<form method="POST" action="view_orders.php">';
    echo '<label for="email">Email:</label>';
    echo '<input type="email" name="email" required>';
    echo '<button type="submit">Submit</button>';
    echo '</form>';
    echo '<a href="merchandise.php">Back</a>';
    echo '</div>';
    exit();
}

$email = $_SESSION['email']; // Get the user's email from session

// Include the database connection
include 'connection.php';

// Fetch the orders from the database based on the user's email
$sql = "SELECT * FROM orders WHERE email = '$email' ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doffee&copy;-Order History</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="style.css">
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
<!-- NAVBAR START HERE -->
<div class="navbar">
      <div class="navbar-container">
        <a href="index.html#home">
          <img src="img/tugu.png" alt="logo" id="logo" />
        </a>
        <ul class="menu">
          <li>
            <a href="index.html#about">About</a>
          </li>
          <li>
            <a href="index.html#menus">Menu</a>
          </li>
          <li>
            <a href="index.html#contact">Contact</a>
          </li>
          <li>
            <a href="merchandise.php">Merchandise</a>
          </li>
        </ul>
        <ul class="extra-menu">
          <li id="order-logout">
          <a href="logout.php">Logout</a>
          </li>
          <li class="navbar-xmenu">
            <a href="#" id="ham-menu"><i data-feather="menu"></i></a>
          </li>
        </ul>
        <!-- <div class="order-logout">
            <a href="logout.php">Logout</a>
        </div> -->
      </div>
    </div>
    <!-- NAVBAR ENDS HERE -->

<?php
if (mysqli_num_rows($result) > 0) {
    echo "<div class='order-history'>";
    echo "<h2>Order History for: $email</h2>";
    echo "</div>";
    
    // Loop through all orders
    while ($order = mysqli_fetch_assoc($result)) {
        $order_date = $order['created_at'];
        $item_names = explode(',', $order['item_name']);
        $item_quantities = explode(',', $order['item_quantities']);
        $item_prices = explode(',', $order['item_prices']);
        
        // Calculate total price
        $total_price = 0;
        foreach ($item_prices as $key => $price) {
            $price = floatval($price); // Convert price to a float
            $quantity = intval($item_quantities[$key]); // Convert quantity to an integer
            $total_price += $price * $quantity;
        }

        // Display order details
        echo "<div class='order-summary'>";
        echo "<h3>Order Date: $order_date</h3>";
        echo "<ul>";
        
        for ($i = 0; $i < count($item_names); $i++) {
            echo "<li><strong>" . $item_names[$i] . "</strong> - Quantity: " . $item_quantities[$i] . " - Price: RM " . number_format($item_prices[$i], 2) . "</li>";
        }

        echo "</ul>";
        echo "<p><strong>Total: RM " . number_format($total_price, 2) . "</strong></p>";
        echo "</div><hr>";
    }
} else {
    echo "<p>No orders found for this email.</p>";
}
?>
<script>
    feather.replace();
  </script>
</body>
</html>
