<?php

session_start();
$host = "localhost";
$databaseUserName = "sithmini";
$databasePassword = "bk1234";
$database = "bkdb";

header("Access-Control-Allow-Origin: *");
error_log("[NOTERROR] Session Started - Cart");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($host, $databaseUserName, $databasePassword, $database);
    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
        die("Connection failed: " . $conn->connect_error);
    }
    $UserID = $_POST['userId'];
    $ItemSize = $_POST['size'];
    $ItemColor = $_POST['color'];
    $ItemAmount = $_POST['amount'];
    $ProductID = $_POST['productId'];
    $ProductPrice = $_POST['price'];
    
    error_log("[NOTERROR] Inserting Data");
    $sql = "INSERT INTO cart (UserID, ItemSize, ItemColor, ItemAmount, ProductID, price) 
            VALUES ('$UserID', '$ItemSize', '$ItemColor', '$ItemAmount', '$ProductID', '$ProductPrice')";
    
    if ($conn->query($sql) === TRUE) {
        // New record created successfully
        error_log("[NOTERROR] Record Created");
        echo "New record created successfully";
    } else {
        // Error occurred
        error_log("Error: " . $sql . "<br>" . $conn->error);
        echo "Error: " . $sql . "<br>" . $conn->error;
        http_response_code(500);
    }
    
    // Close the database connection
    $conn->close();    
}
?>
