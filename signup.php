<?php

session_start();

// Database connection parameters
$host = "localhost";
$databaseUserName = "sithmini";
$databasePassword = "bk1234";
$database = "bkdb";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($host, $databaseUserName, $databasePassword, $database);

    // Check connection
    if ($conn->connect_error) {
        // Log connection error
        error_log("Connection failed: " . $conn->connect_error);
        die("Connection failed: " . $conn->connect_error);
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $postCode = $_POST['postCode'];
    $OTP = $_POST['OTP'];
    
    error_log("[NOTERROR] Inserting Data");
    // Prepare the SQL statement to insert data into the users table
    $sql = "INSERT INTO users (UserName, Passwd, Telephone, Address, PostCode, `ACCNO-OTP`) 
            VALUES ('$username', '$password', '$telephone', '$address', '$postCode', '$OTP')";
    
    // Execute the SQL statement
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
    $conn->close();    
}
?>
