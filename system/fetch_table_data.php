<?php
include '../backend/connection.php';

// Retrieve start date and end date from the AJAX request
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Set default values for $offset and $limit
$limit = 5; // limit the number of rows per page
$offset = 0; // initial offset

// Calculate the total number of rows
$query = "SELECT * FROM vaccinationslot WHERE status = 4";
if ($start_date && $end_date) {
    $query .= " AND vaccinationdate BETWEEN '$start_date' AND '$end_date'";
}
$result = $conn->query($query);
$total_rows = $result->num_rows;

// Calculate the total number of pages
$total_pages = ceil($total_rows / $limit);

// Get the current page number
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $limit;

// Modify the SQL query to filter by date range
$query = "SELECT * FROM vaccinationslot WHERE status = 4";
if ($start_date && $end_date) {
    $query .= " AND vaccinationdate BETWEEN '$start_date' AND '$end_date'";
}
$query .= " LIMIT $offset, $limit";
$result = $conn->query($query);

$rows = '';
$counter = 1; // initialize the counter
while ($row = $result->fetch_assoc()) {
    $rows .= "<tr>";
    $rows .= "<td>" . $counter . "</td>"; // incremental number
    $rows .= "<td>" . $row["booking_no"] . "</td>";
    $rows .= "<td>" . $row["first_name"] . "</td>";
    $rows .= "<td>" . $row["last_name"] . "</td>";
    $rows .= "<td>" . $row["vaccinationdate"] . "</td>";
    $rows .= "<td>" . $row["created_at"] . "</td>";
    $rows .= "</tr>";
    $counter++; // increment the counter
}

// Output the rows
echo $rows;
?>
