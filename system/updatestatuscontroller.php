<?php
include '../backend/connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required_fields = ['status', 'id'];
    $missing_fields = [];

    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $missing_fields[] = $field;
        }
    }

    if (empty($missing_fields)) {
        $status = (int)$_POST['status'];
        $id = (int)$_POST['id'];

        $query = "UPDATE vaccinationslot SET status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $status, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'message' => 'Status updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error updating status: ' . mysqli_stmt_error($stmt)]);
        }
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Error: Missing required fields.', 'missing_fields' => $missing_fields]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>
