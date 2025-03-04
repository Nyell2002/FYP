<?php
// Include the database connection
include 'connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $email = $_POST['email'];
    $offers = isset($_POST['offers']) ? 1 : 0;
    $country = $_POST['country'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];
    $payment = $_POST['payment'];

    // Validate payment method
    $allowed_payments = ['credit-card', 'qr-code'];
    if (!in_array($payment, $allowed_payments)) {
        echo "Invalid payment method.";
        exit();
    }

    // Additional validation for credit card (if applicable)
    if ($payment === 'credit-card') {
        $card_number = $_POST['card_number'];
        $expiry_date = $_POST['expiry_date'];
        $cvc = $_POST['cvc'];
        $cardholder_name = $_POST['cardholder_name'];
    }

    // Get cart data from the form
    $cart_items = json_decode($_POST['cart'], true); // Decode the cart data from JSON

    if (!$cart_items) {
        echo "No items in cart.";
        exit();
    }

    // Initialize empty arrays for item names, quantities, and prices
    $item_name = [];
    $item_quantities = [];
    $item_prices = [];

    // Collect item details from the cart
    foreach ($cart_items as $item) {
        $item_name[] = $item['name']; // Add item name to the array
        $item_quantities[] = $item['quantity']; // Add item quantity to the array
        $item_prices[] = $item['price']; // Add item price to the array
    }

    // Convert arrays to strings for storage in the database
    $item_name_str = implode(',', $item_name);
    $item_quantities_str = implode(',', $item_quantities);
    $item_prices_str = implode(',', $item_prices);

    // Insert order into the orders table
    $sql_order = "INSERT INTO orders (email, offers, country, first_name, last_name, address, city, postal_code, payment_method, item_name, item_quantities, item_prices) 
                  VALUES ('$email', '$offers', '$country', '$first_name', '$last_name', '$address', '$city', '$postal_code', '$payment', '$item_name_str', '$item_quantities_str', '$item_prices_str')";

    if (mysqli_query($conn, $sql_order)) {
        echo "Order placed successfully!";
        // Redirect to a success page
        header("Location: success.html");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
