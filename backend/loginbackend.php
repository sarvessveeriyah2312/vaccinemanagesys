<?php
session_start();
include 'connection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Function to send JSON response
function send_response($success, $message, $role = null, $redirect = null)
{
    $response = ['success' => $success, 'message' => $message];
    if ($role !== null) {
        $response['role'] = $role;
    }
    if ($redirect !== null) {
        $response['redirect'] = $redirect;
    }
    echo json_encode($response);
    exit();
}

// Log errors to a file for debugging
function log_error($message)
{

}

// Check if username and password are provided
if (empty($_POST['username']) || empty($_POST['password'])) {
    send_response(false, 'Username and password are required');
}

$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and execute the query to retrieve the user's role ID, hashed password, and ID
$query = $conn->prepare("SELECT id, role_id, password, email, username FROM users WHERE username =?");
if (!$query) {
    log_error('Query preparation failed: ' . $conn->error);
    send_response(false, 'Query preparation failed: ' . $conn->error);
}

$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();
$user_data = $result->fetch_assoc();

// Check if the user exists
if ($user_data) {
    // Verify the password using bcrypt
    $hashed_password = $user_data['password'];
    if (password_verify($password, $hashed_password)) {
        // Generate session details
        $session_id = bin2hex(random_bytes(16)); // generate a random session ID
        $expires = time() + 3600; // set the session to expire in 1 hour
        $data = json_encode(array('login_status' => true, 'expiry_date' => date('Y-m-d H:i:s', $expires)), JSON_UNESCAPED_SLASHES);

        // Insert session data into the database
        $insert_query = $conn->prepare("INSERT INTO sessions (user_id, username, email, session_id, expires, data) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$insert_query) {
            log_error('Insert query preparation failed: ' . $conn->error);
            send_response(false, 'Insert query preparation failed: ' . $conn->error);
        }

        $user_id = $user_data['id'];
        $email = $user_data['email'];

        // Log the data before insertion
        log_error("Inserting session data: UserID: $user_id, Username: $username, Email: $email, SessionID: $session_id, Expires: $expires, Data: $data");

        $insert_query->bind_param("isssis", $user_id, $username, $email, $session_id, $expires, $data);

        if ($insert_query->execute()) {
            // Store the session ID, username, email, user ID, and role ID in the $_SESSION array
            $_SESSION['session_id'] = $session_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role_id'] = $user_data['role_id'];

            // Update the last login timestamp
            $update_query = $conn->prepare("UPDATE users SET last_login_at = NOW() WHERE id =?");
            if (!$update_query) {
                log_error('Update query preparation failed: ' . $conn->error);
                send_response(false, 'Update query preparation failed: ' . $conn->error);
            }
            $update_query->bind_param("i", $user_id);
            if ($update_query->execute()) {
                // Determine the redirect URL based on the user's role
                $redirect_url = '';
                switch ($_SESSION['role_id']) {
                    case 1: // Admin
                        $redirect_url = './system/admindashboard.php';
                        break;
                    case 3: // User
                        $redirect_url = './system/userdashboard.php';
                        break;
                    case 2: // Vaccinator
                        $redirect_url = './system/staffdashboard.php';
                        break;
                    default:
                        log_error('Unknown role for user ID: ' . $user_id);
                        send_response(false, 'Unknown role');
                }
                send_response(true, 'Login successful', $_SESSION['role_id'], $redirect_url);
            } else {
                log_error('Failed to update last login timestamp: ' . $update_query->error);
                send_response(false, 'Failed to update last login timestamp: ' . $update_query->error);
            }
        } else {
            log_error('Failed to insert session data: ' . $insert_query->error);
            send_response(false, 'Failed to insert session data: ' . $insert_query->error);
        }
    } else {
        send_response(false, 'Invalid credentials');
    }
} else {
    send_response(false, 'Invalid credentials');
}

// Close the prepared statements and the database connection
$query->close();
$insert_query->close();
$conn->close();

// Error handling for JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // This is an AJAX request
    if (ob_get_length() > 0) {
        ob_clean();
    }
    flush();
} else {
    // This is not an AJAX request
    header('Content-Type: text/plain');
    echo 'Error: Invalid request';
    exit();
}
