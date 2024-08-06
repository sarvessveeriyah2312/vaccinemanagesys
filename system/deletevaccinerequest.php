<?php
include '../backend/connection.php';

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $query = "DELETE FROM vaccinationslot WHERE id = '$id'";
  $result = $conn->query($query);

  if ($result) {
    $response = array('success' => true, 'message' => 'Vaccination slot deleted successfully!');
  } else {
    $response = array('success' => false, 'error' => 'Error deleting vaccination slot: ' . $conn->error);
  }

  echo json_encode($response);
} else {
  $response = array('success' => false, 'error' => 'Invalid request');
  echo json_encode($response);
}
?>