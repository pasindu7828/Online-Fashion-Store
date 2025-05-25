<?php
session_start();

if(isset($_SESSION['set_product_name']) && isset($_SESSION['set_product_price']) && isset($_SESSION['set_skip_value'])) {
    $productName = $_SESSION['set_product_name'];
    $productPrice = $_SESSION['set_product_price'];
    $skipValue = $_SESSION['set_skip_value'];
    error_log($_SESSION['set_product_price']);
    $response = array(
        'ProductName' => $productName,
        'Price' => $productPrice,
        'skipValue' => $skipValue
    );

    echo json_encode($response);
} else {
    // Handle the case where session variables are not set
    echo "Session variables not set.";
}
?>
