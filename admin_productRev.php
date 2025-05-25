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
        
        if ($action === "edit") {
            // Edit action
            $revID = $_POST['id'];
            $newData = $_POST['newData'];

            $sql = "UPDATE product_reviews SET comment = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $newData, $revID);
            if ($stmt->execute()) {
                echo json_encode(array('success' => 'Comment updated successfully.'));
            } else {
                echo json_encode(array('error' => 'Error updating comment.'));
            }
        } elseif ($action === "delete") {
            // Delete action
            $revID = $_POST['id'];

            $sql = "DELETE FROM product_reviews WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $revID);
            if ($stmt->execute()) {
                echo json_encode(array('success' => 'Record deleted successfully.'));
            } else {
                echo json_encode(array('error' => 'Error deleting record.'));
            }
        }
    } else {
        // If action is not provided, return error message
        echo json_encode(array('error' => 'No action provided.'));
    }

    $conn->close();
}
?>
