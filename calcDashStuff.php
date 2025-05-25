<?php

session_start();

$host = "localhost";
$databaseUserName = "sithmini";
$databasePassword = "bk1234";
$database = "bkdb";

header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL); // Enable error reporting for debugging

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $conn = new mysqli($host, $databaseUserName, $databasePassword, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userSql = "SELECT COUNT(*) AS user_count FROM users";
    $userResult = $conn->query($userSql);

    if ($userResult === false) {
        die("Query failed: " . $conn->error);
    }

    $userRow = $userResult->fetch_assoc();
    $userCount = $userRow['user_count'];

    $paymentSql = "SELECT COUNT(*) AS payment_count FROM payments";
    $paymentResult = $conn->query($paymentSql);

    if ($paymentResult === false) {
        die("Query failed: " . $conn->error);
    }

    $paymentRow = $paymentResult->fetch_assoc();
    $paymentCount = $paymentRow['payment_count'];

    $revenueSql = "SELECT SUM(price) AS total_revenue FROM payments";
    $revenueResult = $conn->query($revenueSql);

    if ($revenueResult === false) {
        die("Query failed: " . $conn->error);
    }

    $revenueRow = $revenueResult->fetch_assoc();
    $totalRevenue = $revenueRow['total_revenue'];

    error_log("User Count: " . $userCount);
    error_log("Payment Count: " . $paymentCount);
    error_log("Total Revenue: " . $totalRevenue);

    echo json_encode(array('user_count' => $userCount, 'order_count' => $paymentCount, 'total_revenue' => $totalRevenue));

    $conn->close();
} else {
    die("Invalid request method.");
}
?>
