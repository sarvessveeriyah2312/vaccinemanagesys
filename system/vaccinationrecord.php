<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../sources/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../sources/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../sources/css/style2.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../sources/images/favicon.ico" />
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

        #pdf-modal .modal-dialog {
            width: 80%;
            max-width: 1200px;
        }

        #pdf-modal .modal-body {
            height: 600px;
            overflow-y: auto;
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
                            </span> Vaccination Booking Records
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
                                <h4 class="card-title">Upcoming Bookings</h4>
                                <?php
                                include '../backend/connection.php';

                                // Restrict access based on role
                                if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) {
                                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                                    echo '<script type="text/javascript">';
                                    echo 'Swal.fire({
                          icon: "error",
                          title: "Access Denied",
                          text: "You do not have access to this page.",
                          confirmButtonText: "OK"
                      }).then((result) => {
                          if (result.isConfirmed) {
                              window.location.href = "' . $dashboardLink . '";
                          }
                      });';
                                    echo '</script>';
                                    exit();
                                }
                                ?>
                                <?php
                                include 'usermodalcontroller.php';
                                $user_id = $_SESSION['user_id'];
                                $query = "SELECT vs.*, vt.brand AS vaccinename, vc.name AS centername
          FROM vaccinationslot vs
          JOIN vaccinetype vt ON vs.VaccineType = vt.id
          JOIN vaccinationcenter vc ON vs.vaccinationcenter = vc.id
          WHERE vs.user_id = $user_id AND vs.status != 3";
                                $result = $conn->query($query);

                                ?>
                                <table id="usertable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Booking Slot ID </th>
                                            <th> Vaccination Center </th>
                                            <th> Vaccination Date </th>
                                            <th> Vaccination Time </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1; // initialize the counter
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $counter . "</td>"; // incremental number
                                                echo "<td>" . $row["booking_no"] . "</td>";
                                                echo "<td>" . $row["centername"] . "</td>";
                                                echo "<td>" . $row["vaccinationdate"] . "</td>";
                                                echo "<td>" . date("g:i a", strtotime($row["vaccinationtime"])) . "</td>";
                                                echo "<td>";
                                                if ($row["status"] == 1) {
                                                    echo "<label class='badge badge-success'>Approved</label>";
                                                } elseif ($row["status"] == 0) {
                                                    echo "<label class='badge badge-warning'>Pending</label>";
                                                } elseif ($row["status"] == 2) {
                                                    echo "<label class='badge badge-danger'>Rejected</label>";
                                                } else {
                                                    echo "<label class='badge badge-danger'>Inactive</label>";
                                                }
                                                echo "</td>";
                                                echo "<td>";
                                                // echo "<a href='#' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal' data-id='" . $row["id"] . "'><i class='mdi mdi-pencil'></i> Edit</a>";
                                                echo " ";
                                                if ($row["status"] == 0) {
                                                    echo "<a href='#' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal' data-id='" . $row["id"] . "'><i class='mdi mdi-pencil'></i> Edit</a>";
                                                    echo " ";
                                                    echo "<a href='#' class='btn btn-danger btn-sm delete-btn' data-id='" . $row["id"] . "'><i class='mdi mdi-delete'></i> Delete</a>";
                                                } else if ($row["status"] == 1) {
                                                    echo "<a href='#' class='btn btn-success btn-sm download-btn' data-id='" . $row["id"] . "' data-toggle='modal' data-target='#pdf-modal'><i class='mdi mdi-download'></i> Download</a>";
                                                }
                                                echo "</td>";
                                                echo "</tr>";
                                                $counter++; // increment the counter
                                            }
                                        } else {
                                            echo "<tr><td colspan='8' style='text-align: center'>No upcoming vaccination bookings found.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Completed Bookings</h4>
                                        <?php
                                        include 'usermodalcontroller.php';
                                        // Get the logged-in user's ID
                                        $user_id = $_SESSION['user_id'];
                                        // Query to get the total number of rows for the logged-in user
                                        $query = "SELECT vs.*, vt.brand AS vaccinename, vc.name AS centername
          FROM vaccinationslot vs
          JOIN vaccinetype vt ON vs.VaccineType = vt.id
          JOIN vaccinationcenter vc ON vs.vaccinationcenter = vc.id
          WHERE vs.user_id = $user_id AND (vs.status = 3 OR vs.status = 4)";
                                        $result = $conn->query($query);
                                        ?>
                                        <table id="usertable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> # </th>
                                                    <th> Booking Slot ID </th>
                                                    <th> Vaccination Center </th>
                                                    <th> Vaccine </th>
                                                    <th> Vaccination Date </th>
                                                    <th> Vaccination Time </th>
                                                    <th> Status </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $counter = 1; // initialize the counter
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $counter . "</td>"; // incremental number
                                                        echo "<td>" . $row["booking_no"] . "</td>";
                                                        echo "<td>" . $row["centername"] . "</td>";
                                                        echo "<td>" . $row["vaccinename"] . "</td>";
                                                        echo "<td>" . $row["vaccinationdate"] . "</td>";
                                                        echo "<td>" . date("g:i a", strtotime($row["vaccinationtime"])) . "</td>";
                                                        echo "<td>";
                                                        if ($row["status"] == 1) {
                                                            echo "<label class='badge badge-success'>Approved</label>";
                                                        } elseif ($row["status"] == 0) {
                                                            echo "<label class='badge badge-warning'>Pending</label>";
                                                        } elseif ($row["status"] == 2) {
                                                            echo "<label class='badge badge-danger'>Rejected</label>";
                                                        } elseif ($row["status"] == 3) {
                                                            echo "<label class='badge badge-info'>Vaccination 1 Completed</label>";
                                                        } elseif ($row["status"] == 4) {
                                                            echo "<label class='badge badge-info'>Vaccination 2 Completed</label>";
                                                        } else {
                                                            echo "<label class='badge badge-danger'>Inactive</label>";
                                                        }
                                                        echo "</td>";
                                                        echo "</tr>";
                                                        $counter++; // increment the counter
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='12' style='text-align: center'>No completed vaccination bookings found.</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <!-- ... (rest of the code remains the same) ... -->
                            <div class="modal fade" id="pdf-modal" tabindex="-1" role="dialog" aria-labelledby="pdf-modal-label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pdf-modal-label">Vaccination Confirmation Form</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <embed id="pdf-preview" src="" type="application/pdf" width="100%" height="500px">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="download-pdf">Download PDF</button>
                                            </div>
                                        </div>
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
                <?php
                // Query with limit and offset for the logged-in user
                $query = "SELECT vs.*, vt.brand AS vaccinename, vc.name AS centername
                   FROM vaccinationslot vs
                   JOIN vaccinetype vt ON vs.VaccineType = vt.id
                   JOIN vaccinationcenter vc ON vs.vaccinationcenter = vc.id
                   WHERE vs.user_id = $user_id";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    $bookingNo = $row['booking_no'];
                    $fullName = $row['first_name'] . ' ' . $row['last_name']; // Fix: concatenate first name and last name
                }
                ?>

                <!-- JavaScript code to generate PDF file name -->
                <script>
                    $(document).ready(function() {
                        $('.download-btn').on('click', function() {
                            var id = $(this).data('id');
                            $.ajax({
                                type: 'POST',
                                url: '../backend/generatebookingform.php', // Your PHP script to generate the PDF
                                data: {
                                    id: id
                                },
                                success: function(response) {
                                    $('#pdf-preview').attr('src', 'data:application/pdf;base64,' + response);
                                }
                            });
                        });
                    });
                    $('#download-pdf').on('click', function() {
                        var pdfSrc = $('#pdf-preview').attr('src');
                        var bookingNo = '<?php echo $bookingNo; ?>'; // Retrieve booking number from PHP
                        var fullName = '<?php echo $fullName; ?>'; // Retrieve full name from PHP

                        // Clean up full name to replace spaces with dashes
                        var cleanFullName = fullName.trim().replace(/\s+/g, '-');

                        // Generate the file name with the desired format
                        var fileName = bookingNo + '_' + cleanFullName + '.pdf';

                        var link = document.createElement('a');
                        link.href = pdfSrc;
                        link.download = fileName; // Set the custom file name
                        link.click();
                    });
                </script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                <!-- End custom js for this page -->
</body>

</html>