<?php
// Database configuration
$dbHost = 'localhost';
$dbUsername = 'sithmini';
$dbPassword = 'bk1234';
$dbName = 'bkdb';

// Create connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data using POST method
$productName = $_POST['Pname'];
$rating = $_POST['rating'];
$email = $_POST['email'];
$reviewerName = $_POST['name'];
$reviewTitle = $_POST['title'];
$comment = $_POST['comment'];

// Prepare SQL query to insert data into product_reviews table
$sql = "INSERT INTO product_reviews (product_name, rating, email, reviewer_name, review_title, comment) 
        VALUES ('$productName', '$rating', '$email', '$reviewerName', '$reviewTitle', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo "Review submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
