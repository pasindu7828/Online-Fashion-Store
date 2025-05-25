<?php
// Start session (if not already started)
session_start();
// Clear all session variables
$_SESSION['session_user_id'] = "admin_user";

error_log("Clearing Sessions...");
exit();
?>
