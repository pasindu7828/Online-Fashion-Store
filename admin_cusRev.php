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
            $revID = $_POST['revID'];
            $newData = $_POST['newData'];

            $sql = "UPDATE cusRev SET Message = ? WHERE revID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $newData, $revID);
            if ($stmt->execute()) {
                echo json_encode(array('success' => 'Message updated successfully.'));
            } else {
                echo json_encode(array('error' => 'Error updating message.'));
            }
        } elseif ($action === "delete") {
            // Delete action
            $revID = $_POST['revID'];

            $sql = "DELETE FROM cusRev WHERE revID = ?";
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
