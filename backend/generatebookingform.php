<?php
require_once('../fpdf/fpdf.php'); // Include the FPDF library
require_once('../phpqrcode/phpqrcode/qrlib.php');
include 'connection.php';

$id = $_POST['id']; // Get the ID from the AJAX request

// Prepare and execute the query to retrieve the vaccination slot data
$stmt = $conn->prepare("SELECT vs.*, vt.brand AS vaccinename, vc.name AS centername
                        FROM vaccinationslot vs
                        JOIN vaccinetype vt ON vs.VaccineType = vt.id
                        JOIN vaccinationcenter vc ON vs.vaccinationcenter = vc.id
                        WHERE vs.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("No data found for the given ID.");
}

// Fetch the data from the result set
$data = $result->fetch_assoc();

$booking_no = $data['booking_no'];
$qrCodeFilename = "../sources/temp/{$booking_no}.png"; // Path to save the QR code

// Generate the QR code
QRcode::png($booking_no, $qrCodeFilename, QR_ECLEVEL_L, 3);

// Generate the PDF using FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Header section
$pdf->Cell(0, 10, 'Vaccination Slot Details', 0, 1, 'C');
$pdf->Ln(10);

// Patient information section
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Patient Information', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Name: ' . $data['first_name'] . ' ' . $data['last_name'], 0, 1, 'L');
$pdf->Cell(0, 10, 'ID Number: ' . $data['idnumber'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Gender: ' . $data['gender'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Age: ' . $data['age'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Email: ' . $data['email'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Birth Date: ' . $data['birth_date'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Address: ' . $data['address'], 0, 1, 'L');

// QR Code section
$pdf->Image($qrCodeFilename, 180, 2, 30, 30); // Insert QR code into PDF


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Symptoms', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$symptoms = array();
if ($data['symptom1'] == 1) $symptoms[] = 'Loss of taste or smell';
if ($data['symptom2'] == 1) $symptoms[] = 'Difficulty in breathing';
if ($data['symptom3'] == 1) $symptoms[] = 'Runny nose';
if ($data['symptom4'] == 1) $symptoms[] = 'Cough';
if ($data['symptom5'] == 1) $symptoms[] = 'Nasal congestion';
if ($data['symptom6'] == 1) $symptoms[] = 'Other';
if ($data['symptom7'] == 1) $symptoms[] = 'High fever';
if ($data['symptom8'] == 1) $symptoms[] = 'Body aches';
if ($data['symptom9'] == 1) $symptoms[] = 'Diarrhea';
if ($data['symptom10'] == 1) $symptoms[] = 'Persistent pain or pressure on chest';
if ($data['symptom11'] == 1) $symptoms[] = 'Sore throat';
$pdf->Cell(0, 10, 'Symptoms: ' . implode(', ', $symptoms), 0, 1, 'L');

// Covid Diagnosis section
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Covid Diagnosis', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Covid Diagnosis: ' . $data['covid_diagnosis'], 0, 1, 'L');

// Disease section
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Disease', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Disease: ' . $data['disease'], 0, 1, 'L');

// Medication section
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Medication', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Medication: ' . $data['medication'], 0, 1, 'L');


// Vaccination details section
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Vaccination Details', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Vaccine Type: ' . $data['vaccinename'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Vaccination Center: ' . $data['centername'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Vaccination Date: ' . $data['vaccinationdate'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Vaccination Time: ' . $data['vaccinationtime'], 0, 1, 'L');

// Output the PDF as a base64-encoded string
$pdf_string = $pdf->Output('S');
echo base64_encode($pdf_string);

// Close the database connection
$stmt->close();
$conn->close();
?>
