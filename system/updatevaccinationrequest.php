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
                                <form id="updateForm" method="post" action="updatevaccinationrequest.php">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="idnumber">NRIC/Passport.No</label>
                                            <input type="text" class="form-control" id="idnumber" name="idnumber" disabled>
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
                                            <input type="date" class="form-control" id="birth_date" name="birth_date" disabled>
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
                                        <label for="disease">Do you have any chronic health condition?</label>
                                        <textarea class="form-control" id="disease" name="disease" disabled></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="medication">Please list your current medication</label>
                                            <input type="text" class="form-control" id="medication" name="medication" value="" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="allergies">Please list down your allergies</label>
                                            <input type="text" class="form-control" id="allergies" name="allergies" value="" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="moreDetails">If yes, please provide further details (date of diagnosis, were you hospitalized or not, treatment, etc.)</label>
                                        <textarea class="form-control" id="moreDetails" name="moreDetails" disabled></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>Please check the symptoms that apply</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom1" name="symptom1" disabled>
                                                <label class="form-check-label" for="symptom1">Loss of taste or smell</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom2" name="symptom2" disabled>
                                                <label class="form-check-label" for="symptom2">Difficulty in breathing</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom3" name="symptom3" disabled>
                                                <label class="form-check-label" for="symptom3">Runny nose</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom4" name="symptom4" disabled>
                                                <label class="form-check-label" for="symptom4">Cough</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom5" name="symptom5" disabled>
                                                <label class="form-check-label" for="symptom5">Nasal congestion</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom6" name="symptom6" disabled>
                                                <label class="form-check-label" for="symptom6">Other</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom7" name="symptom7" disabled>
                                                <label class="form-check-label" for="symptom7">High fever</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom8" name="symptom8" disabled>
                                                <label class="form-check-label" for="symptom8">Body aches</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom9" name="symptom9" disabled>
                                                <label class="form-check-label" for="symptom9">Diarrhea</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom10" name="symptom10" disabled>
                                                <label class="form-check-label" for="symptom10">Persistent pain or pressure on chest</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom11" name="symptom11" disabled>
                                                <label class="form-check-label" for="symptom11">Sore throat</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="VaccineType">Prefered Vaccine</label>
                                        <select name="VaccineType" class="form-control" id="VaccineType" disabled>
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
                                            <input type="date" name="vaccinationdate" class="form-control" id="vaccinationdate" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="vaccinationtime">Preferred Vaccination Time</label>
                                            <input type="time" name="vaccinationtime" class="form-control" id="vaccinationtime" disabled>
                                        </div>
                                    </div>
                                   <input type="hidden" id="id" name="id">
    <!-- Approve and Reject buttons -->
    <button type="button" class="btn btn-gradient-success btn-rounded btn-fw btn-sm" data-toggle="modal" data-target="#createModal" id="approveButton">
        <i class="fas fa-check"></i> Approve 
    </button>

    <button type="button" class="btn btn-gradient-danger btn-rounded btn-fw btn-sm" data-toggle="modal" data-target="#rejectModal" id="rejectButton">
        <i class="fas fa-times"></i> Reject 
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

        <!-- Approve Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Approve Vaccination Booking</h5>
                        <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to approve this booking?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="confirmApprove">Approve</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reject Modal -->
        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">Reject Vaccination Booking</h5>
                        <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to reject this booking?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="confirmReject">Reject</button>
                    </div>
                </div>
            </div>
        </div>

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
