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
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if action is provided
    if (isset($_POST['action']) && $_POST['action'] === "change") {
        $userID = $_POST['id'];
        $newPassword = $_POST['newPassword'];

        // Hash the new password for security
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $sql = "UPDATE users SET Passwd = ? WHERE UserID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newPassword, $userID);
        if ($stmt->execute()) {
            echo json_encode(array('success' => 'Password changed successfully.'));
        } else {
            echo json_encode(array('error' => 'Error changing password.'));
        }
    } else {
        // If action is not provided or is invalid, return an error
        echo json_encode(array('error' => 'Invalid action.'));
    }

    $conn->close();
}
?>
