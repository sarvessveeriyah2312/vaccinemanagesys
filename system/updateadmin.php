<?php
// updateadmin.php
include '../backend/connection.php';

if (isset($_GET['id'])) { // or $_POST['id'] depending on the request method
    $id = $_GET['id']; // or $_POST['id']
    // Retrieve administrator data from database
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
    } else {
        echo "Error: No administrator found with ID $id";
    }
} else {
    echo "";
}
?>