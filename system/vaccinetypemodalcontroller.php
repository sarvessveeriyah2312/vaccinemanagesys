<?php
include '../backend/connection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['id'])) {
        $brand = $_POST['brand'];
        $manufacturer = $_POST['manufacturer'];
        $manufacturing_date = $_POST['manufacturing_date'];
        $expiry_date = $_POST['expiry_date'];
        $batch_no = $_POST['batch_no'];

        // Insert user into database
        $query = "INSERT INTO vaccinetype (brand, manufacturer, manufacturing_date, expiry_date, batch_no) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $brand, $manufacturer, $manufacturing_date, $expiry_date, $batch_no);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(array('success' => true, 'message' => 'Vaccine created successfully!'));
        } else {
            echo json_encode(array('success' => false, 'error' => 'Error creating vaccine: ' . mysqli_stmt_error($stmt)));
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        // Handle GET request to fetch user data
        $id = $_GET['id'];
        $query = "SELECT * FROM vaccinetype WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            echo json_encode($data);
        } else {
            echo json_encode(array('error' => "Error: No vaccine found with ID $id"));
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        // Handle POST request to update user
        $id = $_POST['id'];
        $brand = $_POST['brand'];
        $manufacturer = $_POST['manufacturer'];
        $manufacturing_date = $_POST['manufacturing_date'];
        $expiry_date = $_POST['expiry_date'];
        $batch_no = $_POST['batch_no'];

        // Check if the id exists in the table
        $query = "SELECT * FROM vaccinetype WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            echo json_encode(array('success' => false, 'error' => "Error: No Vaccine found with ID $id"));
            exit;
        }

        $query = "UPDATE vaccinetype SET brand = ?, manufacturer = ?, manufacturing_date = ?, expiry_date = ?, batch_no = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssi", $brand, $manufacturer, $manufacturing_date, $expiry_date, $batch_no, $id);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'error' => 'Error updating vaccine: No rows affected'));
            }
        } else {
            echo json_encode(array('success' => false, 'error' => 'Error updating vaccine: ' . mysqli_stmt_error($stmt)));
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET['id'])) {
        // Handle DELETE request to delete user
        $id = $_GET['id'];

        $query = "SELECT * FROM vaccinetype WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            echo json_encode(array('success' => false, 'error' => "Error: No vaccine found with ID $id"));
            exit;
        }

        $query = "DELETE FROM vaccinetype WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'error' => 'Error deleting vaccine: No rows affected'));
            }
        } else {
            echo json_encode(array('success' => false, 'error' => 'Error deleting vaccine: ' . mysqli_stmt_error($stmt)));
        }
    }
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'error' => 'Error: ' . $e->getMessage()));
}
?>
