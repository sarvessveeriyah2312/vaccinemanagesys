<?php
include '../backend/connection.php';
 

$sql = "SELECT id, first_name, last_name, vaccinationdate AS start, '1st Dose' AS title FROM vaccinationslot
        UNION ALL
        SELECT id, first_name, last_name, 2nd_Vaccine AS start, '2nd Dose' AS title FROM vaccinerecord";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = [
            'title' => $row['title'] . '-' . $row['first_name'] . ' ' . $row['last_name'],
            'start' => $row['start']
        ];
    }
}

$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($events);
?>
