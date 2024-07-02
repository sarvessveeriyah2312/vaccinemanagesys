<?php
include '../backend/connection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Check if it's an update or create request
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Handle POST request to update user
            $id = $_POST['id'];
            $Name = isset($_POST['Name']) ? $_POST['Name'] : null;
            $Address = isset($_POST['Address']) ? $_POST['Address'] : null;
            $PhoneNumber = isset($_POST['PhoneNumber']) ? $_POST['PhoneNumber'] : null;
            $Email = isset($_POST['Email']) ? $_POST['Email'] : null;
            $Capacity = isset($_POST['Capacity']) ? $_POST['Capacity'] : null;
            $VaccineType = isset($_POST['VaccineType']) ? $_POST['VaccineType'] : null;

            // Check if the id exists in the table
            $query = "SELECT * FROM vaccinationcenter WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 0) {
                echo json_encode(array('success' => false, 'error' => "Error: No vaccination center found with ID $id"));
                exit;
            }

            $query = "UPDATE vaccinationcenter SET Name = ?, Address = ?, PhoneNumber = ?, Email = ?, Capacity = ?, VaccineType = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssssiii", $Name, $Address, $PhoneNumber, $Email, $Capacity, $VaccineType, $id);

            if (mysqli_stmt_execute($stmt)) {
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo json_encode(array('success' => true, 'message' => 'Vaccination center updated successfully!'));
                } else {
                    echo json_encode(array('success' => false, 'error' => 'Error updating vaccination center: No rows affected'));
                }
            } else {
                echo json_encode(array('success' => false, 'error' => 'Error updating vaccination center: ' . mysqli_stmt_error($stmt)));
            }
        } else {
            // Handle POST request to create user
            $Name = isset($_POST['Name']) ? $_POST['Name'] : null;
            $Address = isset($_POST['Address']) ? $_POST['Address'] : null;
            $PhoneNumber = isset($_POST['PhoneNumber']) ? $_POST['PhoneNumber'] : null;
            $Email = isset($_POST['Email']) ? $_POST['Email'] : null;
            $Capacity = isset($_POST['Capacity']) ? $_POST['Capacity'] : null;
            $VaccineType = isset($_POST['VaccineType']) ? $_POST['VaccineType'] : null;
        
            // Check if any required fields are missing
            if ($Name && $Address && $PhoneNumber && $Email && $Capacity && $VaccineType) {
                // Insert data into database
                $query = "INSERT INTO vaccinationcenter (Name, Address, PhoneNumber, Email, Capacity, VaccineType) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "ssssii", $Name, $Address, $PhoneNumber, $Email, $Capacity, $VaccineType);
        
                if (mysqli_stmt_execute($stmt)) {
                    echo json_encode(array('success' => true, 'message' => 'Vaccination center created successfully!'));
                } else {
                    echo json_encode(array('success' => false, 'error' => 'Error creating vaccination center: ' . mysqli_stmt_error($stmt)));
                }
            } else {
                echo json_encode(array('success' => false, 'error' => 'Error: Missing required fields.'));
            } 
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        // Handle GET request to fetch user data
        $id = $_GET['id'];
        $query = "SELECT * FROM vaccinationcenter WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            echo json_encode($data);
        } else {
            echo json_encode(array('error' => "Error: No Vaccination Center found with ID $id"));
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET['id'])) {
        // Handle DELETE request to delete user
        $id = $_GET['id'];

        $query = "SELECT * FROM vaccinationcenter WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            echo json_encode(array('success' => false, 'error' => "Error: No Vaccination Center found with ID $id"));
            exit;
        }

        $query = "DELETE FROM vaccinationcenter WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'error' => 'Error deleting Vaccination Center: No rows affected'));
            }
        } else {
            echo json_encode(array('success' => false, 'error' => 'Error deleting Vaccination Center: ' . mysqli_stmt_error($stmt)));
        }
    }
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'error' => 'Error: ' . $e->getMessage()));
}
?>
