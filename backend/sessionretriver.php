<?php
session_start();
include 'connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure the user is logged in and the username is set in the session
if (!isset($_SESSION['username'])) {
    // Redirect to login page if the user is not logged in
    header('Location:../login.php');
    exit();
}

// Retrieve the username from the session
$username = $_SESSION['username'];

// Prepare and bind
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch the user details
$user = $result->fetch_assoc();

// Close the statement and connection
$stmt->close();
$conn->close();

// Function to get role label
function getRoleLabel($roleId) {
    switch ($roleId) {
        case 1:
            return 'System Administrator';
        case 2:
            return 'Vaccinator';
        case 3:
            return 'Vaccinee';
        default:
            return 'Unknown Role';
    }
}

// Get the role label
$roleLabel = getRoleLabel($user['role_id']);

switch ($user['role_id']) {
    case 1:
        $dashboardLink = 'admindashboard.php';
        break;
    case 2:
        $dashboardLink = 'staffdashboard.php';
        break;
    case 3:
        $dashboardLink = 'userdashboard.php';
        break;
    default:
        $dashboardLink = '../login.php'; 
        break;
}
?>