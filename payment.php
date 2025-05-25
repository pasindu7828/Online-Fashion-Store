<?php

session_start();
$host = "localhost";
$databaseUserName = "sithmini";
$databasePassword = "bk1234";
$database = "BKDB";

header("Access-Control-Allow-Origin: *");

error_log("[NOTERROR] Session Started - Payment");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($host, $databaseUserName, $databasePassword, $database);
    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the last line of the cart table to get the price and item amount
    $cartQuery = "SELECT price, ItemAmount FROM cart ORDER BY CartSessionID DESC LIMIT 1";
    $cartResult = $conn->query($cartQuery);
    if ($cartResult->num_rows > 0) {
        $cartRow = $cartResult->fetch_assoc();
        $Price = $cartRow['price'];
        $ItemAmount = $cartRow['ItemAmount'];

        // Calculate the total price
        $totalPrice = $Price * $ItemAmount;

        // Get other data from POST request
        $UserName= $_POST['UserName'];
        $UserEmail = $_POST['UserEmail'];
        $TelephoneNo = $_POST['TelephoneNo'];
        $PaymentMethod = $_POST['PaymentMethod'];
        $Address = $_POST['Address'];
        $PostCode = $_POST['PostCode'];
        $BankAcc = $_POST['BankAcc'];
        $OTP = $_POST['OTP'];
        $UserID = $_POST['UserID'];
        $ProductName = $_POST['ProductName'];
        error_log($ProductName);
        error_log("[NOTERROR] Inserting Data");

        // Insert payment data into payments table
        $sql = "INSERT INTO payments (UserName, UserEmail, TelephoneNo, PaymentMethod, Address, PostCode, BankAcc, OTP, UserID, price, ProductID) 
                VALUES ('$UserName', '$UserEmail', '$TelephoneNo', '$PaymentMethod', '$Address', $PostCode, $BankAcc, $OTP, $UserID, $totalPrice, '$ProductName')";

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
    } else {
        // Cart is empty or no data found
        error_log("Cart is empty or no data found");
        echo "Cart is empty or no data found";
        http_response_code(404);
    }

    // Close the database connection
    $conn->close();    
}
?>
