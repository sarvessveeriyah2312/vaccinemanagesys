<?php
// Include your database connection file
require '../backend/connection.php';

// Set content type to JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Log the entire $_POST array for debugging
    error_log(print_r($_POST, true));

    // Retrieve form data
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];
    $VaccineType = $_POST['VaccineType'];
    $vaccinationdate = $_POST['vaccinationdate'];
    $dosage = $_POST['dosage'];
    $current_date = date('Y-m-d');

    // Validate required fields
    $missing_fields = [];

    if (empty($user_id)) {
        $missing_fields[] = 'user_id';
    }
    if (empty($first_name)) {
        $missing_fields[] = 'first_name';
    }
    if (empty($last_name)) {
        $missing_fields[] = 'last_name';
    }
    if (empty($birth_date)) {
        $missing_fields[] = 'birth_date';
    }
    if (empty($VaccineType)) {
        $missing_fields[] = 'VaccineType';
    }
    if (empty($dosage)) {
        $missing_fields[] = 'dosage';
    }

    if (!empty($missing_fields)) {
        $missing_fields_string = implode(', ', $missing_fields);
        error_log("Missing fields: $missing_fields_string");
        echo json_encode(['success' => false, 'message' => "Please fill in all required fields. Missing: $missing_fields_string"]);
        exit;
    }

    // Check if the user ID exists in the users table
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid User ID.']);
        exit;
    }

    // Check if a record exists in the vaccinerecord table for the given user_id
    $stmt->close();
    $stmt = $conn->prepare("SELECT id FROM vaccinerecord WHERE userid = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Record exists, update the 2nd_Vaccine field
        $stmt->close();
        $update_stmt = $conn->prepare("UPDATE vaccinerecord SET 2nd_Vaccine = ? WHERE userid = ?");
        $update_stmt->bind_param("si", $current_date, $user_id);

        if ($update_stmt->execute()) {
            // Update the status in the vaccinationslot table to 4
            $update_slot_stmt = $conn->prepare("UPDATE vaccinationslot SET status = 4 WHERE user_id = ?");
            $update_slot_stmt->bind_param("i", $user_id);

            if ($update_slot_stmt->execute()) {
                echo json_encode(['success' => true, 'message' => '2nd Vaccine date updated and slot status set to 4 successfully.']);
            } else {
                error_log("Database error on updating vaccinationslot: " . $update_slot_stmt->error);
                echo json_encode(['success' => false, 'message' => '2nd Vaccine date updated, but error updating slot status.']);
            }
            $update_slot_stmt->close();
        } else {
            error_log("Database error on updating vaccinerecord: " . $update_stmt->error);
            echo json_encode(['success' => false, 'message' => 'Error updating 2nd Vaccine date.']);
        }
        $update_stmt->close();
    } else {
        // Record does not exist, insert a new record
        $stmt->close();
        $insert_stmt = $conn->prepare("INSERT INTO vaccinerecord (userid, first_name, last_name, birth_date, VaccineType, 1st_Vaccine, Dosage) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert_stmt->bind_param("issssss", $user_id, $first_name, $last_name, $birth_date, $VaccineType, $vaccinationdate, $dosage);

        if ($insert_stmt->execute()) {
            // Update the status and vaccinationdate in the vaccinationslot table
            $new_vaccination_date = date('Y-m-d', strtotime('+7 days'));
            $update_slot_stmt = $conn->prepare("UPDATE vaccinationslot SET status = 3, vaccinationdate = ? WHERE user_id = ?");
            $update_slot_stmt->bind_param("si", $new_vaccination_date, $user_id);

            if ($update_slot_stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Vaccination record submitted and slot updated successfully.']);
            } else {
                error_log("Database error on updating vaccinationslot: " . $update_slot_stmt->error);
                echo json_encode(['success' => false, 'message' => 'Vaccination record submitted, but error updating slot.']);
            }
            $update_slot_stmt->close();
        } else {
            error_log("Database error: " . $insert_stmt->error);
            echo json_encode(['success' => false, 'message' => 'Error submitting vaccination record.']);
        }
        $insert_stmt->close();
    }

   
}
?>
