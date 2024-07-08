<?php
require '../backend/connection.php'; // Assuming this file contains your database connection

// Check if userId is provided via GET request
if (!isset($_GET['userId'])) {
    echo json_encode(array('error' => 'User ID not provided'));
    exit;
}

$userId = $_GET['userId'];

// Prepare SQL statement to check if user_id exists in vaccinationslot table
$stmt = $conn->prepare("SELECT * FROM vaccinationslot WHERE user_id =?");
$stmt->bind_param("i", $userId); // Bind userId as integer (assuming user_id is integer type)
$stmt->execute();

// Check for SQL errors
if ($stmt->errno) {
    echo json_encode(array('error' => 'SQL Error: '. $stmt->error));
    exit;
}

// Get result set from the executed statement
$result = $stmt->get_result();

// Check if there are rows returned (user exists) or not (user does not exist)
if ($result->num_rows > 0) {
    echo json_encode(array('exists' => true));
} else {
    echo json_encode(array('exists' => false));
}

$stmt->close();
$conn->close();
?>