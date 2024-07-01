<?php
include '../backend/connection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['id'])) {
        // Create user logic here
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role_id = $_POST['role_id'];
        $status = '1';

        // Hash the password using bcrypt
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert user into database
        $query = "INSERT INTO users (username, first_name, last_name, email, password, role_id, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssis", $username, $first_name, $last_name, $email, $hashed_password, $role_id, $status);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(array('success' => true, 'message' => 'User created successfully!'));
        } else {
            echo json_encode(array('success' => false, 'error' => 'Error creating user: ' . mysqli_stmt_error($stmt)));
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        // Handle GET request to fetch user data
        $id = $_GET['id'];
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            echo json_encode($data);
        } else {
            echo json_encode(array('error' => "Error: No user found with ID $id"));
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        // Handle POST request to update user
        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $status = $_POST['status'];

        // Check if the id exists in the table
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            echo json_encode(array('success' => false, 'error' => "Error: No user found with ID $id"));
            exit;
        }
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ?, status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssii", $first_name, $last_name, $email, $hashed_password, $status, $id);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'error' => 'Error updating user: No rows affected'));
            }
        } else {
            echo json_encode(array('success' => false, 'error' => 'Error updating user: ' . mysqli_stmt_error($stmt)));
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET['id'])) {
        // Handle DELETE request to delete user
        $id = $_GET['id'];

        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            echo json_encode(array('success' => false, 'error' => "Error: No user found with ID $id"));
            exit;
        }

        $query = "DELETE FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'error' => 'Error deleting user: No rows affected'));
            }
        } else {
            echo json_encode(array('success' => false, 'error' => 'Error deleting user: ' . mysqli_stmt_error($stmt)));
        }
    }
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'error' => 'Error: ' . $e->getMessage()));
}
?>
