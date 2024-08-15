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
                            </span>Profile
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
                                <h4 class="card-title">User Profile</h4>
                                <p class="card-description" style="display: flex; align-items: center; justify-content: space-between;">
                                    Make Changes on your details here.

                                </p>
                                <form id="vaccinationbooking" action="">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>">
                                        </div>
                                        <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>" hidden>
                                        <div class="col-md-6">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="changePasswordCheckbox">
                                                <label class="form-check-label" for="changePasswordCheckbox">Change Password</label>
                                            </div>
                                            <input type="password" class="form-control mt-2" id="password" name="password" placeholder="Enter new password" disabled>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-gradient-success btn-rounded btn-fw btn-sm" data-toggle="modal" data-target="#createModal">
                                        Update Profile
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
            document.getElementById('changePasswordCheckbox').addEventListener('change', function() {
    var passwordField = document.getElementById('password');
    if (this.checked) {
        passwordField.disabled = false;
    } else {
        passwordField.disabled = true;
        passwordField.value = ''; // Clear the password field if disabled
    }
});

        </script>
        <script>
           $(document).ready(function() {
    $('#vaccinationbooking').on('submit', function(event) {
        event.preventDefault();
        
        // Assuming the user ID is stored in a JavaScript variable
        var userId = $('#user_id').val(); // Get user ID from a hidden input field or another element
        
        // Serialize the form data
        var formData = $(this).serialize();
        
        // Append the user ID to the serialized data
        formData += '&user_id=' + encodeURIComponent(userId);

        $.ajax({
            type: 'POST',
            url: 'profileupdatecontroller.php',
            data: formData,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }, // Content type set to x-www-form-urlencoded
            success: function(data) {
                try {
                    console.log('Server response:', data);
                    var response = JSON.parse(data);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'User Profile Successfully Updated',
                            confirmButtonText: 'OK'
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error updating profile',
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
            });
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <!-- End custom js for this page -->
</body>

</html>