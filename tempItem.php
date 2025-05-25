<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log("[NOTERROR 1] TEMP ITEM SET");
    $_SESSION['set_product_name'] = $_POST['ProductName'];
    $_SESSION['set_temp_product_id'] = $_POST['ProductName'];
    $_SESSION['set_temp_product_price'] = $_POST['Price'];
    $_SESSION['set_product_price'] = $_POST['Price'];
    $_SESSION['set_skip_value'] = $_POST['skipValue'];
}

if (isset($_SESSION['session_user_id'])) {
    $host = "localhost";
    $databaseUserName = "sithmini";
    $databasePassword = "bk1234";
    $database = "bkdb";

    $conn = new mysqli($host, $databaseUserName, $databasePassword, $database);

    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
        die("Connection failed: " . $conn->connect_error);
    }

    $USER = $_SESSION['session_user_id'];

    $sql = "SELECT SUM(Price) AS TotalPrice FROM cart WHERE UserID = '$USER'";
    $result = $conn->query($sql);

    if ($result) {
        if ($row = $result->fetch_assoc()) {
            $totalPrice = $row['TotalPrice'];
            $_SESSION['total_price'] = $totalPrice;
            $response = array(
                'product_name' => $_SESSION['set_product_name'],
                'total_price' => $totalPrice,
                'UserID' => $USER
            );
            echo json_encode($response);
        } else {
            echo json_encode(array('error' => 'No records found'));
        }
    } else {
        error_log("Error executing SQL query: " . $conn->error);
        echo json_encode(array('error' => 'SQL error'));
    }

    $conn->close();
} else {
    echo json_encode(array('error' => 'Session user ID not set'));
}
?>
