<?php

session_start();

// Database connection parameters
$host = "localhost";
$databaseUserName = "sithmini";
$databasePassword = "bk1234";
$database = "bkdb";

header("Access-Control-Allow-Origin: *");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($host, $databaseUserName, $databasePassword, $database);

    // Check connection
    if ($conn->connect_error) {
        // Log connection error
        error_log("Connection failed: " . $conn->connect_error);
        http_response_code(100); // Internal Server Error
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $username = $_POST['username']; 
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE UserName = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password === $row['Passwd']) {
            // Redirect user to dashboard or another page
            $_SESSION['username'] = $row['UserName'];
            http_response_code(200); // OK
            error_log("[NOTERROR]Login successful");
            echo "Login successful";
            $_SESSION['session_user_id'] = $row['UserID'];
            exit();
        } else {
            http_response_code(10); // Unauthorized
            $errorMessage = "Incorrect password";
            error_log($errorMessage);
            echo $errorMessage;
        }
    } else {
        http_response_code(104); // Not Found
        $errorMessage = "User not found";
        error_log($errorMessage);
        echo $errorMessage;
    }
    // Close the database connection
    $conn->close();
}
?>
