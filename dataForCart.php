<?php
// Start session (if not already started)
session_start();

error_log("[NOTERROR]Product Data loading");
// Check if user is logged in
if(isset($_SESSION['session_user_id'])) {
    // User is logged in
    echo json_encode(array('loggedIn' => true, 'pname' => $_SESSION['set_temp_product_id'], 'price' => $_SESSION['set_product_price'], 'Session_UserID' => $_SESSION['session_user_id'], 'RedirectCode' => $_SESSION['set_skip_value']));
} else {
    // User is not logged in
    echo json_encode(array('loggedIn' => false));
}
?>
