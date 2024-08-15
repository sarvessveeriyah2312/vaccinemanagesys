<?php
include('../backend/connection.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the user ID from the POST request
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;

    // Validate the user ID
    if ($user_id <= 0) {
        echo json_encode(['success' => false, 'error' => 'Invalid or missing user ID']);
        exit;
    }

    // Get form data
    $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validate mandatory fields (First name, Last name, Email)
    if (empty($first_name) || empty($last_name) || empty($email)) {
        echo json_encode(['success' => false, 'error' => 'Required fields are missing']);
        exit;
    }

    // Prepare the SQL query for updating the profile details
    $query = "UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        echo json_encode(['success' => false, 'error' => 'SQL prepare failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);

    // Execute the query to update the profile details
    if ($stmt->execute()) {
        // Check affected rows to ensure the query actually updated something
        if ($stmt->affected_rows === 0) {
            echo json_encode(['success' => false, 'error' => 'No rows were updated.']);
            exit;
        }

        // Check if password needs to be updated
        if (!empty($password)) {
            // Hash the new password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Update the password in the database
            $query = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($query);

            if ($stmt === false) {
                echo json_encode(['success' => false, 'error' => 'SQL prepare failed: ' . $conn->error]);
                exit;
            }

            $stmt->bind_param("si", $hashed_password, $user_id);

            if (!$stmt->execute()) {
                echo json_encode(['success' => false, 'error' => 'Failed to update password: ' . $stmt->error]);
                exit;
            }

            // Check if the password was actually updated
            if ($stmt->affected_rows === 0) {
                echo json_encode(['success' => false, 'error' => 'Password update failed. No rows were affected.']);
                exit;
            }
        }

        // Success response
        echo json_encode(['success' => true]);
    } else {
        // Error response
        echo json_encode(['success' => false, 'error' => 'Failed to update profile: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
