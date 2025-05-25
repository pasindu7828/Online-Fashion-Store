<?php
$host = "localhost";
$databaseUserName = "sithmini";
$databasePassword = "bk1234";
$database = "bkdb";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $passhint = $_POST['passhint'];

    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $conn = new mysqli($host, $databaseUserName, $databasePassword, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO admin (adminUserName, adminPassword, adminEmail, adminPasshint) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $email, $passhint);
    
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'failed';
    }

    $stmt->close();
    $conn->close();
}
?>
