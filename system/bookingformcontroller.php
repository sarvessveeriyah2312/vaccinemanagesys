<?php
include '../backend/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle POST request to create vaccination slot
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $idnumber = isset($_POST['idnumber']) ? $_POST['idnumber'] : null;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $birth_date = isset($_POST['birth_date']) ? $_POST['birth_date'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;
    $covid_diagnosis = isset($_POST['covid_diagnosis']) ? $_POST['covid_diagnosis'] : null;
    $disease = isset($_POST['disease']) ? $_POST['disease'] : null;
    $medication = isset($_POST['medication']) ? $_POST['medication'] : null;
    $allergies = isset($_POST['allergies']) ? $_POST['allergies'] : null;
    $moreDetails = isset($_POST['moreDetails']) ? $_POST['moreDetails'] : null;
    $symptom1 = isset($_POST['symptom1']) ? 1 : 0;
    $symptom2 = isset($_POST['symptom2']) ? 1 : 0;
    $symptom3 = isset($_POST['symptom3']) ? 1 : 0;
    $symptom4 = isset($_POST['symptom4']) ? 1 : 0;
    $symptom5 = isset($_POST['symptom5']) ? 1 : 0;
    $symptom6 = isset($_POST['symptom6']) ? 1 : 0;
    $symptom7 = isset($_POST['symptom7']) ? 1 : 0;
    $symptom8 = isset($_POST['symptom8']) ? 1 : 0;
    $symptom9 = isset($_POST['symptom9']) ? 1 : 0;
    $symptom10 = isset($_POST['symptom10']) ? 1 : 0;
    $symptom11 = isset($_POST['symptom11']) ? 1 : 0;
    $VaccineType = isset($_POST['VaccineType']) ? $_POST['VaccineType'] : null;
    $vaccinationcenter = isset($_POST['vaccinationcenter']) ? $_POST['vaccinationcenter'] : null;
    $vaccinationdate = isset($_POST['vaccinationdate']) ? $_POST['vaccinationdate'] : null;
    $vaccinationtime = isset($_POST['vaccinationtime']) ? $_POST['vaccinationtime'] : null;
    

    $missing_fields = array();

    if (!$user_id) $missing_fields[] = 'user_id';
    if (!$first_name) $missing_fields[] = 'first_name';
    if (!$last_name) $missing_fields[] = 'last_name';
    if (!$idnumber) $missing_fields[] = 'idnumber';
    if (!$gender) $missing_fields[] = 'gender';
    if (!$email) $missing_fields[] = 'email';
    if (!$birth_date) $missing_fields[] = 'birth_date';
    if (!$address) $missing_fields[] = 'address';
    if (!$covid_diagnosis) $missing_fields[] = 'covid_diagnosis';
    if (!$VaccineType) $missing_fields[] = 'VaccineType';
    if (!$vaccinationcenter) $missing_fields[] = 'vaccinationcenter';
    if (!$vaccinationdate) $missing_fields[] = 'vaccinationdate';
    if (!$vaccinationtime) $missing_fields[] = 'vaccinationtime';

    if (count($missing_fields) > 0) {
        echo json_encode(array('success' => false, 'error' => 'Error: Missing required fields: ' . implode(', ', $missing_fields)));
    } else {
        $query = "INSERT INTO vaccinationslot (user_id, first_name, last_name, idnumber, gender, email, birth_date, address, covid_diagnosis, disease, medication, allergies, moreDetails, symptom1, symptom2, symptom3, symptom4, symptom5, symptom6, symptom7, symptom8, symptom9, symptom10, symptom11, VaccineType, vaccinationcenter, vaccinationdate, vaccinationtime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        
        mysqli_stmt_bind_param($stmt, "issssssssssssiiiiiiiiiiiiiss", 
            $user_id,$first_name, $last_name, $idnumber, $gender, $email, $birth_date, $address, 
            $covid_diagnosis, $disease, $medication, $allergies, $moreDetails, 
            $symptom1, $symptom2, $symptom3, $symptom4, $symptom5, $symptom6, 
            $symptom7, $symptom8, $symptom9, $symptom10, $symptom11, 
            $VaccineType, $vaccinationcenter, $vaccinationdate, $vaccinationtime);
        
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(array('success' => true, 'message' => 'Vaccination slot created successfully!'));
        } else {
            echo json_encode(array('success' => false, 'error' => 'Error creating vaccination slot: ' . mysqli_stmt_error($stmt)));
        }
    }
}
?>
