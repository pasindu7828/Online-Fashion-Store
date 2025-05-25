<?php
session_start();

// Check if UserID is set
if(isset($_SESSION['session_user_id'])) {
    $UserID = $_SESSION['session_user_id'];
    $UserName = $_SESSION['username'];

    // Connect to the database
    $host = "localhost";
    $databaseUserName = "sithmini";
    $databasePassword = "bk1234";
    $database = "bkdb";
    error_log("[NOTERROR] Session Started For Cart Check");
    $conn = new mysqli($host, $databaseUserName, $databasePassword, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch items in the cart for the current user and store them in session variables
    $cartItems = array();
    $cartQuery = "SELECT * FROM cart WHERE UserID=$UserID";
    $result = $conn->query($cartQuery);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Store each cart item in session variables
            $cartItems[] = $row;
        }
    }

    // Store cart items in session variable
    $_SESSION['cart_items'] = $cartItems;

    // Close the database connection
    $conn->close();

    echo json_encode(['success' => true, 'cartItems' => $cartItems, 'UserName' => $UserName ] );
} else {
    echo json_encode(['success' => false, 'message' => 'UserID not provided.','UserName' => 'Invalid User !']);
}
?>
