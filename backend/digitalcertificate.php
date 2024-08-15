<?php
require_once('../fpdf/fpdf.php'); // Include the FPDF library
require_once('../phpqrcode/phpqrcode/qrlib.php');
include 'connection.php';

$id = $_POST['id']; 


$stmt = $conn->prepare("SELECT vs.*, 
       vt.brand AS vaccinename, 
       vc.name AS centername, 
       vr.1st_Vaccine AS first_vaccine_date, 
       vr.2nd_Vaccine AS second_vaccine_date
FROM vaccinationslot vs
JOIN vaccinetype vt ON vs.VaccineType = vt.id
JOIN vaccinationcenter vc ON vs.vaccinationcenter = vc.id
JOIN vaccinerecord vr ON vs.user_id = user_id
WHERE vs.user_id = ?
  AND  vs.status = 4;");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("No data found for the given ID.");
}

// Fetch the data from the result set
$data = $result->fetch_assoc();

$idnumber = $data['idnumber'];
$encryptedID = hash('sha256', $idnumber);
$qrCodeFilename = "../sources/temp/{$idnumber}.png"; // Path to save the QR code

// Generate the QR code
QRcode::png($encryptedID, $qrCodeFilename, QR_ECLEVEL_L, 3);

// Generate the PDF using FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Header section
$pdf->Cell(0, 10, 'COVID-19 VACCINATION DIGITAL CERTIFICATE', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Image('../sources/images/logo.png', 10, 20, 60, 60); 
$pdf->Ln(40);

// Patient information section
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Patient Information', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Name: ' . $data['first_name'] . ' ' . $data['last_name'], 0, 1, 'L');
$pdf->Cell(0, 10, 'ID Number: ' . $data['idnumber'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Gender: ' . $data['gender'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Age: ' . $data['age'] . ' years old', 0, 1, 'L');
$pdf->Cell(0, 10, 'Email: ' . $data['email'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Birth Date: ' . $data['birth_date'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Address: ' . $data['address'], 0, 1, 'L');

// QR Code section
$pdf->Image($qrCodeFilename, 140, 70, 50, 50); 
$pdf->Image('../sources/images/best.png', 150, 120, 30, 30); 



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


$pdf->SetDrawColor(169, 169, 169); 
$pdf->Line(10, 160, 200, 160);

$pdf->SetDrawColor(169, 169, 169); 
$pdf->Line(10, 180, 200, 180);


$pdf->SetDrawColor(169, 169, 169); 
$pdf->Line(10, 200, 200, 200);

// Vaccination details section
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Vaccination Details', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Vaccine Type: ' . $data['vaccinename'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Vaccination Center: ' . $data['centername'], 0, 1, 'L');
$pdf->Cell(0, 10, '1st Vaccination Dose Date: ' . $data['first_vaccine_date'], 0, 1, 'L');
$pdf->Cell(0, 10, '2nd Vaccination Dose Date: ' . $data['second_vaccine_date'], 0, 1, 'L');

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->MultiCell(0, 5, "This COVID-19 Digital Certificate is generated for informational purposes only \nand should not be used as a substitute for official medical advice.", 0, 'C');
$pdf->Ln(6);

$pdf->SetFont('Arial', 'I', 7);
$pdf->Cell(0, 10, 'Digital Signature :' .$encryptedID, 0, 1, 'L');
$pdf_string = $pdf->Output('S');
echo base64_encode($pdf_string);

// Close the database connection
$stmt->close();
$conn->close();
?>
