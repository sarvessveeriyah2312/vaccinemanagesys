<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Covid.19 Vaccination Management System</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../sources/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../sources/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../sources/css/style2.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../sources/images/favicon.ico" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .custom-close {
            background-color: transparent;
            /* Red background */
            color: red;
            /* White text */
            border-radius: 50%;
            padding: 5px 10px;
            border: none;
            font-size: 24px;
        }

        .custom-close:hover {
            background-color: transparent;
            /* Darker red on hover */
        }

        /* pagination styles */
        .pagination {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: right;
        }

        .pagination li {
            margin-right: 10px;
        }

        .pagination li a {
            color: #337ab7;
            text-decoration: none;
        }

        .pagination li a:hover {
            color: #23527c;
        }

        .pagination li.active a {
            color: #23527c;
            font-weight: bold;
        }

        .password-instruction {
            display: block;
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        .form-check-inline .form-check-input {
            margin-right: 0.3em;
        }

        .form-check-inline .form-check-label {
            margin-right: 1em;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php require '../template/topnavbar.php'; ?>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php require '../template/sidebar.php'; ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            </span>Book Vaccination
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" id="booking_title">Vaccination Booking <span id="booking_number"></span></h4>
                                <p class="card-description" style="display: flex; align-items: center; justify-content: space-between;">
                                    Book your vaccination slot here based on your preferrence.
                                </p>
                                <form id="updateForm" method="post" action="updateappointment.php">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="idnumber">NRIC/Passport.No</label>
                                            <input type="text" class="form-control" id="idnumber" name="idnumber" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gender">Gender</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender_female" value="Female" disabled>
                                                <label class="form-check-label" for="gender_female">Female</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender_male" value="Male" disabled>
                                                <label class="form-check-label" for="gender_male">Male</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="age">Age</label>
                                            <input type="number" class="form-control" id="age" name="age" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="birth_date">D.O.B</label>
                                            <input type="date" class="form-control" id="birth_date" name="birth_date" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" disabled>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 d-flex align-items-center">
                                            <label for="covid_diagnosis" class="mr-3 mb-0">Have you been diagnosed with COVID-19?</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="covid_diagnosis" id="covid_yes" value="Yes" disabled>
                                                <label class="form-check-label" for="covid_yes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="covid_diagnosis" id="covid_no" value="No" disabled>
                                                <label class="form-check-label" for="covid_no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="moreDetails">If yes, please provide further details (date of diagnosis, were you hospitalized or not, treatment, etc.)</label>
                                        <textarea class="form-control" id="moreDetails" name="moreDetails" disabled></textarea>
                                    </div>
                        
                                    <div class="form-group">
                                        <label for="VaccineType">Prefered Vaccine</label>
                                        <select name="VaccineType" class="form-control" id="VaccineType" >
                                            <option value="">Select Vaccine Type</option>
                                            <?php
                                            $stmt = $conn->prepare("SELECT * FROM vaccinetype");
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['brand'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vaccinationcenter">Prefered Vaccination Center</label>
                                        <select name="vaccinationcenter" class="form-control" id="vaccinationcenter" disabled>
                                            <option value="">Select Vaccine Type</option>
                                            <?php
                                            $stmt = $conn->prepare("SELECT * FROM vaccinationcenter");
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['Name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="vaccinationdate">Preferred Vaccination Date</label>
                                            <input type="date" name="vaccinationdate" class="form-control" id="vaccinationdate" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="vaccinationtime">Preferred Vaccination Time</label>
                                            <input type="time" name="vaccinationtime" class="form-control" id="vaccinationtime" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="vaccinationcenter">Dosage (ml)</label>
                                        <input type="number" name="dosage" class="form-control" id="dosage" >
                                 
                                    </div>
                                   <input type="hidden" id="user_id" name="user_id">
    <!-- Approve and Reject buttons -->
    <button type="submit" class="btn btn-gradient-success btn-rounded btn-fw btn-sm">
        <i class="fas fa-check"></i> Submit
    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php require '../template/footer.php'; ?>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- plugins:js -->
        <script src="../sources/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="../sources/vendors/chart.js/Chart.min.js"></script>
        <script src="../sources/js/jquery.cookie.js" type="text/javascript"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="../sources/js/off-canvas.js"></script>
        <script src="../sources/js/hoverable-collapse.js"></script>
        <script src="../sources/js/misc.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="../sources/js/dashboard.js"></script>
        <script src="../sources/js/todolist.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
$(document).ready(function() {
    console.log('Checking sessionStorage:', sessionStorage.getItem('updateData'));
    var storedData = JSON.parse(sessionStorage.getItem('updateData'));
    console.log('Parsed storedData:', storedData);

    if (storedData && storedData.success) {
        var updateData = storedData.data;
        try {
            // Populate the form fields with the data
            $('#id').val(updateData.id);
            $('#user_id').val(updateData.user_id);
            $('#first_name').val(updateData.first_name);
            $('#last_name').val(updateData.last_name);
            $('#idnumber').val(updateData.idnumber);
            $('#age').val(updateData.age);
            $('#email').val(updateData.email);
            $('#birth_date').val(updateData.birth_date);
            $('#address').val(updateData.address);
            $('#medication').val(updateData.medication);
            $('#allergies').val(updateData.allergies);
            $('#disease').val(updateData.disease);
            $('#moreDetails').val(updateData.moreDetails);

            // Radio buttons
            if (updateData.gender === 'Male') {
                $('#gender_male').prop('checked', true);
            } else {
                $('#gender_female').prop('checked', true);
            }

            if (updateData.covid_diagnosis === 'Yes') {
                $('#covid_yes').prop('checked', true);
            } else {
                $('#covid_no').prop('checked', true);
            }

            // Checkboxes
            $('#symptom1').prop('checked', updateData.symptom1 === 1);
            $('#symptom2').prop('checked', updateData.symptom2 === 1);
            $('#symptom3').prop('checked', updateData.symptom3 === 1);
            $('#symptom4').prop('checked', updateData.symptom4 === 1);
            $('#symptom5').prop('checked', updateData.symptom5 === 1);
            $('#symptom6').prop('checked', updateData.symptom6 === 1);
            $('#symptom7').prop('checked', updateData.symptom7 === 1);
            $('#symptom8').prop('checked', updateData.symptom8 === 1);
            $('#symptom9').prop('checked', updateData.symptom9 === 1);
            $('#symptom10').prop('checked', updateData.symptom10 === 1);
            $('#symptom11').prop('checked', updateData.symptom11 === 1);

            // Select boxes
            $('#VaccineType').val(updateData.VaccineType);
            $('#vaccinationcenter').val(updateData.vaccinationcenter);
            $('#vaccinationdate').val(updateData.vaccinationdate);
            $('#vaccinationtime').val(updateData.vaccinationtime);

            // Display booking number
            if (updateData.booking_no) {
                $('#booking_number').text(`- Booking.No: [${updateData.booking_no}]`);
            } else {
                console.error('Error: booking_number is not defined');
                $('#booking_number').text('');
            }
        } catch (error) {
            console.error('Error populating form fields:', error);
        }
    } else {
        console.error('Error loading data for update');
        alert('Error loading data for update');
    }
});
</script>
<script>
$(document).ready(function() {
    $('#updateForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        $.ajax({
            url: 'insertvaccinationrecord.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json', // Expect JSON response
            success: function(response) {
                // Handle the JSON response
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'vaccineappointment.php'; // Redirect after successful submission
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                // Provide detailed error feedback
                let errorMessage = 'An error occurred while submitting the form.';
                if (xhr.status === 0) {
                    errorMessage = 'Not connected. Please verify your network connection.';
                } else if (xhr.status === 404) {
                    errorMessage = 'The requested page not found. [404]';
                } else if (xhr.status === 500) {
                    errorMessage = 'Internal Server Error [500].';
                } else if (error === 'parsererror') {
                    errorMessage = 'Requested JSON parse failed.';
                } else if (error === 'timeout') {
                    errorMessage = 'Time out error.';
                } else if (error === 'abort') {
                    errorMessage = 'Ajax request aborted.';
                } else {
                    errorMessage = 'Uncaught Error.\n' + xhr.responseText;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    // Approve button click event handler
    $('.btn-gradient-success').on('click', function() {
        var id = $('#id').val();
        console.log('Button clicked with id:', id);
        $('#createModal').modal('show');
        // Set the id value in the modal
        $('#id').val(id);
    });

    // Reject button click event handler
    $('.btn-gradient-danger').on('click', function() {
        var id = $('#id').val();
        console.log('Button clicked with id:', id);
        $('#rejectModal').modal('show');
        // Set the id value in the modal
        $('#id').val(id);
    });

    $('#confirmApprove').click(function(event) {
    event.preventDefault();
    var id = $('#id').val();
    // Set the status to 1 (approved)
    var status = 1;
    $.ajax({
        url: 'updatestatuscontroller.php',
        type: 'POST',
        data: {
            id: id,
            status: status
        },
        success: function(response) {
            if (response.success) {
                console.log(response.message);
                $('#createModal').modal('hide').data('bs.modal', null);
                $('body').removeClass('modal-open');
                // Optionally, refresh the page or redirect the user
                // location.reload();
            } else {
                console.error(response.error);
                if (response.missing_fields) {
                    console.log('Missing fields:', response.missing_fields);
                }
                // alert('An error occurred: ' response.error);
            }
        },
        error: function(xhr, status, error) {
            // Handle any errors
            console.error(error);
            alert('An error occurred while updating the status.');
        }
    });
});

$('#confirmApprove').click(function(event) {
    event.preventDefault();
    var id = $('#id').val();
    // Set the status to 1 (approved)
    var status = 1;
    $.ajax({
        url: 'updatestatuscontroller.php',
        type: 'POST',
        data: {
            id: id,
            status: status
        },
        success: function(response) {
            if (response.success) {
                console.log(response.message);
                $('#createModal').modal('hide').data('bs.modal', null);
                $('body').removeClass('modal-open');
                window.location.href = 'managevaccinerequest.php'; // Redirect to managevaccinerequest.php
            } else {
                console.error(response.error);
                if (response.missing_fields) {
                    console.log('Missing fields:', response.missing_fields);
                }
                // alert('An error occurred: 'esponse.error);
            }
        },
        error: function(xhr, status, error) {
            // Handle any errors
            console.error(error);
            alert('An error occurred while updating the status.');
        }
    });
});

$('#confirmReject').click(function(event) {
    event.preventDefault();
    var id = $('#id').val();
    // Set the status to 2 (rejected)
    var status = 2;
    $.ajax({
        url: 'updatestatuscontroller.php',
        type: 'POST',
        data: {
            id: id,
            status: status
        },
        success: function(response) {
            if (response.success) {
                console.log(response.message);
                $('#rejectModal').modal('hide').data('bs.modal', null);
                $('body').removeClass('modal-open');
                window.location.href = 'managevaccinerequest.php'; // Redirect to managevaccinerequest.php
            } else {
                console.error(response.error);
                if (response.missing_fields) {
                    console.log('Missing fields:', response.missing_fields);
                }
                // alert('An error occurred: 'esponse.error);
            }
        },
        error: function(xhr, status, error) {
            // Handle any errors
            console.error(error);
            alert('An error occurred while updating the status.');
        }
    });
});
});
</script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <!-- End custom js for this page -->
</body>

</html>
