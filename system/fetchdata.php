<?php
include('../backend/connection.php');
header('Content-Type: application/json');

$response = array();

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("SELECT * FROM vaccinationslot WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response = array('success' => true, 'data' => $row);
        } else {
            $response = array('success' => false, 'message' => 'No data found for id ' . $id);
        }
    } else {
        $response = array('success' => false, 'message' => 'Database query failed');
    }

    $stmt->close();
} else {
    $response = array('success' => false, 'message' => 'Missing id field in POST data');
}

echo json_encode($response);
$conn->close();
?>
