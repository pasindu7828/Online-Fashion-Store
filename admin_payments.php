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
    if (isset($_POST['sqlQuery'])) {
        $sqlQuery = $_POST['sqlQuery'];

        // Execute SQL query
        $result = $conn->query($sqlQuery);

        if ($result) {
            // If query is successful, return result as JSON
            $rows = array();
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            echo json_encode($rows);
        } else {
            // If query fails, return error message
            echo json_encode(array('error' => 'Query execution failed.'));
        }
    } else {
        // If SQL query is not provided, return error message
        echo json_encode(array('error' => 'No SQL query provided.'));
    }

    $conn->close();
}
?>
