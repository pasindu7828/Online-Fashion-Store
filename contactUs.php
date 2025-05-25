<?php
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

    // Fetching data from the POST request
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phonenumber'];
    $message = $_POST['message'];

    // Preparing the SQL statement to insert data into the database
    $sql = "INSERT INTO cusRev (UserName, UserEmail, PhoneNumber, Message) VALUES ('$name', '$email', '$phoneNumber', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Your Response Saved !";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
