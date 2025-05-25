<?php
session_start();
$host = "localhost";
$databaseUserName = "sithmini";
$databasePassword = "bk1234";
$database = "bkdb";

error_log("Clearing Cart For User...");

$conn = new mysqli($host, $databaseUserName, $databasePassword, $database);

// Check connection
if ($conn->connect_error) {
    // Log connection error
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}

$USER = $_SESSION['session_user_id'];

// Clear the cart data for the user ID
$sql_clear = "DELETE FROM cart WHERE UserID = $USER";
if ($conn->query($sql_clear) === TRUE) {
    error_log("[NOTERROR] Cart Cleared");
} else {
    // Error occurred
    error_log("Error clearing cart: " . $conn->error);
    echo "Error clearing cart: " . $conn->error;
    http_response_code(500);
}

$conn->close();
?>
