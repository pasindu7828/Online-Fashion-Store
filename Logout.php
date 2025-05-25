<?php
// Start session (if not already started)
session_start();
$host = "localhost";
$databaseUserName = "sithmini";
$databasePassword = "bk1234";
$database = "bkdb";
// error_log("Clearing Cart For User...");
$conn = new mysqli($host, $databaseUserName, $databasePassword, $database);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
$USER = $_SESSION['session_user_id'];
// Clear all session variables
$_SESSION = array();

error_log("Clearing Sessions...");
// Destroy the session
session_destroy();

error_log("[NOTERROR] Reached Here");
if ($_POST['killAcc'] == 1) {
    error_log("[NOTERROR] Deleting User Account");
    $sql = "DELETE FROM users WHERE UserID = $USER";
    if ($conn->query($sql) === TRUE) {
        // New record created successfully
        error_log("[NOTERROR] Query Completed");
    } else {
        // Error occurred
        error_log("Error: " . $sql . "<br>" . $conn->error);
        echo "Error: " . $sql . "<br>" . $conn->error;
        http_response_code(500);
    }
    $sql = "DELETE FROM cart WHERE UserID = $USER";
    if ($conn->query($sql) === TRUE) {
        // New record created successfully
        error_log("[NOTERROR] Query Completed");
    } else {
        // Error occurred
        error_log("Error: " . $sql . "<br>" . $conn->error);
        echo "Error: " . $sql . "<br>" . $conn->error;
        http_response_code(500);
    }
    $sql = "DELETE FROM payments WHERE UserID = $USER";
    if ($conn->query($sql) === TRUE) {
        // New record created successfully
        error_log("[NOTERROR] Query Completed");
    } else {
        // Error occurred
        error_log("Error: " . $sql . "<br>" . $conn->error);
        echo "Error: " . $sql . "<br>" . $conn->error;
        http_response_code(500);
    }
    $conn->close();
    header("Location: index.html");
    exit();
}
// Redirect to index.html or any other desired location
header("Location: index.html");
exit();
?>
