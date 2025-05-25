<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to admin login page
    header("Location: admin_login.html");
    http_response_code(500);
    exit();
}

echo "Welcome, Admin!";
?>