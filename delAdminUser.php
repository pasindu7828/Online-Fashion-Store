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

    // Check if SQL query is sent from AJAX request
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        if ($action === "delete") {
            // Delete action
            $userID = $_POST['id'];

            $sql = "DELETE FROM users WHERE UserID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userID);
            if ($stmt->execute()) {
                echo json_encode(array('success' => 'User deleted successfully.'));
            } else {
                echo json_encode(array('error' => 'Error deleting user.'));
            }
        }
    } else {
        // If action is not provided, return error message
        echo json_encode(array('error' => 'No action provided.'));
    }

    $conn->close();
}
?>
