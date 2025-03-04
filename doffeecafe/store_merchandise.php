<?php
include 'connection.php'; // Include database connection file

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $name = $conn->real_escape_string($_POST['name']);
    $image = $conn->real_escape_string($_POST['image']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);

    // Insert data into the database
    $sql = "INSERT INTO merchandise (name, image, price, description) 
            VALUES ('$name', '$image', '$price', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully!";
        echo '<br><a href="add_merchandise.html">Add another product</a>';
        echo '<br><a href="merchandise.php">View merchandise</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close(); // Close the connection
?>
