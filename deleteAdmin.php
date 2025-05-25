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

    // Check if action is provided and is "delete"
    if (isset($_POST['action']) && $_POST['action'] === "delete") {
        $adminID = $_POST['id'];

        // Delete the admin from the database
        $sql = "DELETE FROM admin WHERE adminID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $adminID);
        if ($stmt->execute()) {
            echo json_encode(array('success' => 'Admin deleted successfully.'));
        } else {
            echo json_encode(array('error' => 'Error deleting admin.'));
        }
    } else {
        // If action is not provided or is invalid, return an error
        echo json_encode(array('error' => 'Invalid action.'));
    }

    session_destroy();
    $conn->close();
}
?>
