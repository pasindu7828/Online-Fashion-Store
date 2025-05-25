<?php
session_start();

$host = "localhost";
$databaseUserName = "sithmini";
$databasePassword = "bk1234";
$database = "bkdb";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli($host, $databaseUserName, $databasePassword, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT adminPassword FROM admin WHERE adminUserName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($storedPassword);
        $stmt->fetch();
        if ($password === $storedPassword) {
            $_SESSION['admin_logged_in'] = true;
            echo 'success';
        } else {
            echo 'failed';
        }
    } else {
        echo 'failed';
    }
    $stmt->close();
    $conn->close();
}
?>
