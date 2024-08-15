<?php
include '../backend/connection.php';

// Get the start date and end date from the request
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Prepare the filename with current date and time
$filename = 'Vaccinated_Reports-' . date('Y-m-d_H-i-s') . '.csv';

// Set headers for the CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="' . $filename . '"');

// Open output stream for CSV data
$output = fopen('php://output', 'w');

// Add CSV column headers
fputcsv($output, ['Booking No', 'First Name', 'Last Name', 'Vaccination Date', 'Registered On']);

// Prepare SQL query to fetch data
$query = "SELECT * FROM vaccinationslot WHERE status = 4";
if ($start_date && $end_date) {
    $query .= " AND vaccinationdate BETWEEN '$start_date' AND '$end_date'";
}
$result = $conn->query($query);

// Fetch and write data to CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row["booking_no"],
        $row["first_name"],
        $row["last_name"],
        $row["vaccinationdate"],
        $row["created_at"]
    ]);
}

// Close output stream
fclose($output);
?>
