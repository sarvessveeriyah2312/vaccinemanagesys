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
                                <h4 class="card-title">Vaccination Booking</h4>
                                <p class="card-description" style="display: flex; align-items: center; justify-content: space-between;">
                                    Book your vaccination slot here based on your preferrence.
                                    <!-- <button type="button" class="btn btn-gradient-success btn-rounded btn-fw btn-sm" data-toggle="modal" data-target="#createModal">
                    <i class="mdi mdi-account-plus"></i> Create New Vaccinator
                  </button> -->
                                </p>
                                <form id="vaccinationbooking" action="">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" >
                                        </div>
                                        <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>" hidden>
                                        <div class="col-md-6">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="idnumber">NRIC/Passport.No</label>
                                            <input type="text" class="form-control" id="idnumber" name="idnumber" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gender">Gender</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender_female" value="Female">
                                                <label class="form-check-label" for="gender_female">Female</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender_male" value="Male">
                                                <label class="form-check-label" for="gender_male">Male</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="age">Age</label>
                                            <input type="number" class="form-control" id="age" name="age" value="" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="birth_date">D.O.B</label>
                                            <input type="date" class="form-control" id="birth_date" name="birth_date" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 d-flex align-items-center">
                                            <label for="covid_diagnosis" class="mr-3 mb-0">Have you been diagnosed with COVID-19?</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="covid_diagnosis" id="covid_yes" value="Yes">
                                                <label class="form-check-label" for="covid_yes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="covid_diagnosis" id="covid_no" value="No">
                                                <label class="form-check-label" for="covid_no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="disease">Do you have any chronic health condition?</label>
                                        <textarea class="form-control" id="disease" name="disease"></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="medication">Please list your current medication</label>
                                            <input type="text" class="form-control" id="medication" name="medication" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="allergies">Please list down your allergies</label>
                                            <input type="text" class="form-control" id="allergies" name="allergies" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="moreDetails">If yes, please provide further details (date of diagnosis, were you hospitalized or not, treatment, etc.)</label>
                                        <textarea class="form-control" id="moreDetails" name="moreDetails"></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>Please check the symptoms that apply</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom1" name="symptom1">
                                                <label class="form-check-label" for="symptom1">Loss of taste or smell</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom2" name="symptom2">
                                                <label class="form-check-label" for="symptom2">Difficulty in breathing</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom3" name="symptom3">
                                                <label class="form-check-label" for="symptom3">Runny nose</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom4" name="symptom4">
                                                <label class="form-check-label" for="symptom4">Cough</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom5" name="symptom5">
                                                <label class="form-check-label" for="symptom5">Nasal congestion</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom6" name="symptom6">
                                                <label class="form-check-label" for="symptom6">Other</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom7" name="symptom7">
                                                <label class="form-check-label" for="symptom7">High fever</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom8" name="symptom8">
                                                <label class="form-check-label" for="symptom8">Body aches</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom9" name="symptom9">
                                                <label class="form-check-label" for="symptom9">Diarrhea</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom10" name="symptom10">
                                                <label class="form-check-label" for="symptom10">Persistent pain or pressure on chest</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="symptom11" name="symptom11">
                                                <label class="form-check-label" for="symptom11">Sore throat</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="VaccineType">Prefered Vaccine</label>
                                        <select name="VaccineType" class="form-control" id="VaccineType" required>
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
                                        <select name="vaccinationcenter" class="form-control" id="vaccinationcenter" required>
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
                                        <input type="date" name="vaccinationdate" class="form-control" id="vaccinationdate" required>
                                        </div>
                                        <div class="col-md-6">
                                        <label for="vaccinationtime">Preferred Vaccination Time</label>
                                        <input type="time" name="vaccinationtime" class="form-control" id="vaccinationtime" required>
                                        </div>
                                    </div>

                                   
                                    <button type="submit" class="btn btn-gradient-success btn-rounded btn-fw btn-sm" data-toggle="modal" data-target="#createModal">
                                        Book Vaccination Slot
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
$(window).on('load', function() {
    console.log('Window loaded, checking user ID...');
    var userId = $('#user_id').val(); 
    console.log('User ID:', userId); // Check the value of userId here
    if (userId === undefined || userId === '') {
        console.log('User ID is empty or undefined!');
    } else {
        $.ajax({
            type: 'GET',
            url: 'checkuser.php', 
            data: { userId: userId },
            dataType: 'json', // Ensure the expected response type is JSON
            success: function(data) {
                console.log('Response from checkuser.php:', data);
                if (data.exists === true) { // Check if data.exists is true
                    console.log('User ID exists, showing alert...');
                    Swal.fire({
                        icon: 'info',
                        title: 'You have already registered for vaccination',
                        text: 'Please wait for vaccination approval',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'vaccinationrecord.php'; // Redirect to dashboard
                        }
                    });
                } else {
                    console.log('User ID does not exist, no alert shown.');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error checking user ID:', error);
            }
        });
    }
});


            $(document).ready(function() {
                $('#vaccinationbooking').on('submit', function(event) {
                    event.preventDefault(); 
                    var formData = $(this).serialize(); 
                    $.ajax({
                        type: 'POST',
                        url: 'bookingformcontroller.php',
                        data: formData,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }, // Change the content type to x-www-form-urlencoded
                        success: function(data) {
                            try {
                                console.log('Server response:', data);
                                var response = JSON.parse(data);
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Successfully Booked Vacciantion Slot',
                                        text: 'Please wait for booking approval',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = 'vaccinationrecord.php';
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error creating user',
                                        text: 'Error: ' + response.error,
                                        confirmButtonText: 'OK'
                                    });
                                }
                            } catch (e) {
                                console.error('Error parsing JSON:', e);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Unexpected response from server',
                                    text: 'An unexpected error occurred. Please try again.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                });
            });
            $(document).ready(function() {
                $('a[data-toggle="modal"]').on('click', function() {
                    var id = $(this).attr('data-id');
                    console.log('ID:', id);
                    $('#edit-form').attr('data-id', id); // Set the id on the form

                    $.ajax({
                        type: 'GET',
                        url: 'bookingformcontroller.php?id=' + id, // Pass the id parameter in the URL
                        success: function(data) {
                            var formData = JSON.parse(data);
                            $('#edit-form').find('input[name="first_name"]').val(formData.first_name);
                            $('#edit-form').find('input[name="last_name"]').val(formData.last_name);
                            $('#edit-form').find('input[name="email"]').val(formData.email);
                            $('#edit-form').find('input[name="password"]').val(formData.password);
                            $('#edit-form').find('input[name="status"]').val(formData.status);
                            // Populate other form fields as needed
                            $('#editModal').modal('show');
                        }
                    });
                });



                $(document).on('click', '.delete-btn', function(event) {
                    event.preventDefault(); // Prevent default link behavior
                    var id = $(this).attr('data-id');
                    console.log('ID:', id); // Retrieve the ID from the data attribute
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this data!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, keep it'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'DELETE',
                                url: 'bookingformcontroller.php?id=' + id, // Pass the id parameter in the URL
                                success: function(data) {
                                    var response = JSON.parse(data);
                                    if (response.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Deleted successfully!',
                                            text: 'The data has been deleted successfully.',
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                location.reload();
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error deleting data',
                                            text: 'An error occurred while deleting the data.',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                }
                            });
                        }
                    });
                });
            });
        </script>
        <script>
            $('#edit-form').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission
                var id = $(this).attr('data-id'); // Retrieve the id from the form attribute
                console.log('ID:', id);
                var formData = $(this).serialize(); // Serialize the form data

                // Add the id to the data object
                formData += '&id=' + id;

                $.ajax({
                    type: 'POST',
                    url: 'bookingformcontroller.php',
                    data: formData,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }, // Change the content type to x-www-form-urlencoded
                    success: function(data) {
                        try {
                            console.log('Server response:', data);
                            var response = JSON.parse(data);
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'User updated successfully!',
                                    text: 'The user has been updated successfully.',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#editModal').modal('hide');
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error updating user',
                                    text: 'Error: ' + response.error,
                                    confirmButtonText: 'OK'
                                });
                            }
                        } catch (e) {
                            console.error('Error parsing JSON:', e);
                            Swal.fire({
                                icon: 'error',
                                title: 'Unexpected response from server',
                                text: 'An unexpected error occurred. Please try again.',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            });
        </script>

        <script>
            $('#editModal').on('hidden.bs.modal', function() {
                $(this).removeClass('show');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <!-- End custom js for this page -->
</body>

</html>