<?php
// Start session (if not already started)
session_start();

// Check if user is logged in
if(isset($_SESSION['session_user_id'])) {
    // User is logged in
    echo json_encode(array('loggedIn' => true, 'userID' => $_SESSION['session_user_id'], 'username' => $_SESSION['username']));
} else {
    // User is not logged in
    echo json_encode(array('loggedIn' => false));
}
?>
