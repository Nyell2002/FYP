<?php
session_start(); // Start the session

// Destroy the session to log the user out
session_destroy();

// Redirect the user to the homepage or another page after logging out
header("Location: view_orders.php");
exit();
?>
