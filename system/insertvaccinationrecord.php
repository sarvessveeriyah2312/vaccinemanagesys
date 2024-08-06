<?php
// Include your database connection file
require '../config/database.php';

// Set content type to JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $User_ID = $_POST['User_ID'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $Vaccine_Type = $_POST['Vaccine_Type'];
    $first_Vaccine = $_POST['1st_Vaccine'];
    $second_Vaccine = $_POST['2nd_Vaccine'];
    $Dosage = $_POST['Dosage'];
    $Vaccine_Status = $_POST['Vaccine_Status'];

    // Validate required fields (you can add more validation as needed)
    if (empty($User_ID) || empty($first_name) || empty($last_name) || empty($dob) || empty($Vaccine_Type) || empty($Dosage) || empty($Vaccine_Status)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
        exit;
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO vaccinationrecord (User_ID, first_name, last_name, dob, Vaccine_Type, 1st_Vaccine, 2nd_Vaccine, Dosage, Vaccine_Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("issssssss", $User_ID, $first_name, $last_name, $dob, $Vaccine_Type, $first_Vaccine, $second_Vaccine, $Dosage, $Vaccine_Status);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Vaccination record submitted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error submitting vaccination record.']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
