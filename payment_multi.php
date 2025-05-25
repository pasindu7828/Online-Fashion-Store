<?php

session_start();
$host = "localhost";
$databaseUserName = "sithmini";
$databasePassword = "bk1234";
$database = "bkdb";

header("Access-Control-Allow-Origin: *");

error_log("[NOTERROR] Session Started - Payment");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($host, $databaseUserName, $databasePassword, $database);
    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch all rows from the cart table for the specific user
    $userID = $_POST['UserID'];
    $cartQuery = "SELECT ItemAmount, price FROM cart WHERE UserID = $userID";
    $cartResult = $conn->query($cartQuery);
    $totalPrice = 0;

    if ($cartResult->num_rows > 0) {
        while ($cartRow = $cartResult->fetch_assoc()) {
            $itemAmount = $cartRow['ItemAmount'];
            $price = $cartRow['price'];
            $totalPrice += $itemAmount * $price;
        }

        // Get other data from POST request
        $UserName = $_POST['UserName'];
        $UserEmail = $_POST['UserEmail'];
        $TelephoneNo = $_POST['TelephoneNo'];
        $PaymentMethod = $_POST['PaymentMethod'];
        $Address = $_POST['Address'];
        $PostCode = $_POST['PostCode'];
        $BankAcc = $_POST['BankAcc'];
        $OTP = $_POST['OTP'];
        $ProductName = $_POST['ProductName'];
        error_log($ProductName);
        error_log("[NOTERROR] Inserting Data");

        // Insert payment data into payments table
        $sql = "INSERT INTO payments (UserName, UserEmail, TelephoneNo, PaymentMethod, Address, PostCode, BankAcc, OTP, UserID, price, ProductID) 
                VALUES ('$UserName', '$UserEmail', '$TelephoneNo', '$PaymentMethod', '$Address', $PostCode, $BankAcc, $OTP, $userID, $totalPrice, '$ProductName')";

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
        // Cart is empty or no data found for the user
        error_log("Cart is empty or no data found for the user");
        echo "Cart is empty or no data found for the user";
        http_response_code(404);
    }

    // Close the database connection
    $conn->close();    
}
?>
