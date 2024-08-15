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
              </span> Manage Vaccination Center
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
                <h4 class="card-title">Vaccination Center</h4>
                <p class="card-description" style="display: flex; align-items: center; justify-content: space-between;">
                  Easily add, update, and remove vaccination Center.
                  <button type="button" class="btn btn-gradient-success btn-rounded btn-fw btn-sm" data-toggle="modal" data-target="#createModal">
                    <i class="mdi mdi-account-plus"></i> Create New Vaccination Center
                  </button>
                </p>
                <?php
                include '../backend/connection.php';

                // Restrict access based on role
                if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
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
                <table id="usertable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Address </th>
                      <th> Email </th>
                      <th> Capacity </th>
                      <th> Vaccine </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include 'vaccinecentermodalcontroller.php';
                    $limit = 5; // limit the number of rows per page
                    $offset = 0; // initial offset
                    $total_rows = 0; // total number of rows
                    $total_pages = 0; // total number of pages

                    // query to get the total number of rows
                    $query = "SELECT vc.id AS vc_id, vc.Name, vc.Address, vc.PhoneNumber, vc.Email, vc.Capacity, vt.brand AS VaccineType
    FROM vaccinationcenter vc
    JOIN vaccinetype vt ON vc.VaccineType = vt.id";
                    $result = $conn->query($query);
                    $total_rows = $result->num_rows;

                    // calculate the total number of pages
                    $total_pages = ceil($total_rows / $limit);

                    // get the current page number
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($current_page - 1) * $limit;

                    // query with limit and offset
                    $query = "SELECT vc.id AS vc_id, vc.Name, vc.Address, vc.PhoneNumber, vc.Email, vc.Capacity, vt.brand AS VaccineType
    FROM vaccinationcenter vc
    JOIN vaccinetype vt ON vc.VaccineType = vt.id LIMIT $offset, $limit";
                    $result = $conn->query($query);

                    ?>
                    <?php
                    $counter = 1; // initialize the counter
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $counter . "</td>"; // incremental number
                      echo "<td>" . $row["Name"] . "</td>";
                      echo "<td>" . $row["Address"] . "</td>";
                      echo "<td>" . $row["Email"] . "</td>";
                      echo "<td>" . $row["Capacity"] . "</td>";
                      echo "<td>" . $row["VaccineType"] . "</td>";
                      echo "<td>";
                      echo "<a href='#' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal' data-id='" . htmlspecialchars($row["vc_id"]) . "'><i class='mdi mdi-pencil'></i> Edit</a>";
                      echo " ";
                      echo "<a href='#' class='btn btn-danger btn-sm delete-btn' data-id='" . htmlspecialchars($row["vc_id"]) . "'><i class='mdi mdi-delete'></i> Delete</a>";
                      echo "</td>";
                      echo "</tr>";
                      $counter++; // increment the counter
                    }
                    ?>
                  </tbody>
                </table>

                <!-- pagination links -->
                <ul class='pagination'>
                  <?php
                  // previous link
                  if ($current_page > 1) {
                    echo "<li><a href='?page=" . ($current_page - 1) . "'>Previous</a></li>";
                  }

                  // page numbers
                  for ($i = 1; $i <= $total_pages; $i++) {
                    $class = ($i == $current_page) ? 'active' : '';
                    echo "<li class='$class'><a href='?page=$i'>$i</a></li>";
                  }

                  // next link
                  if ($current_page < $total_pages) {
                    echo "<li><a href='?page=" . ($current_page + 1) . "'>Next</a></li>";
                  }

                  ?>
                </ul>
                </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- ... (rest of the code remains the same) ... -->

          <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="createModalLabel">Create New Vaccination Center</h5>
                  <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- Form will be generated dynamically here -->
                  <form id="create-form">
                    <div class="form-group">
                      <label for="Name">Name</label>
                      <input type="text" class="form-control" id="Name" name="Name" required>
                    </div>
                    <div class="form-group">
                      <label for="Address">Address</label>
                      <textarea class="form-control" id="Address" name="Address" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="PhoneNumber">Phone No</label>
                      <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" required>
                    </div>
                    <div class="form-group">
                      <label for="Email">Email</label>
                      <input type="email" class="form-control" id="Email" name="Email" required>
                    </div>
                    <div class="form-group">
                      <label for="Capacity">Capacity</label>
                      <input type="number" class="form-control" id="Capacity" name="Capacity" required>
                    </div>
                    <div class="form-group">
                      <label for="VaccineType">Vaccine</label>
                      <select name="VaccineType" class="form-control" id="VaccineType" required>
                        <option value="">Select Vaccine Type</option>
                        <?php
                        $query = "SELECT * FROM vaccinetype";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo "<option value='" . $row['id'] . "'>" . $row['brand'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <!-- Add more form fields as needed -->
                    <button type="submit" class="btn btn-primary">Create</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Add a modal dialog box to the same page -->
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Vaccination Center</h5>
                  <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- Form will be generated dynamically here -->
                  <form id="edit-form">
                    <div class="form-group">
                      <label for="Name">Name</label>
                      <input type="text" class="form-control" id="Name" name="Name" required>
                    </div>
                    <div class="form-group">
                      <label for="Address">Address</label>
                      <textarea class="form-control" id="Address" name="Address" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="PhoneNumber">Phone No</label>
                      <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" required>
                    </div>
                    <div class="form-group">
                      <label for="Email">Email</label>
                      <input type="email" class="form-control" id="Email" name="Email" required>
                    </div>
                    <div class="form-group">
                      <label for="Capacity">Capacity</label>
                      <input type="number" class="form-control" id="Capacity" name="Capacity" required>
                    </div>
                    <div class="form-group">
                      <label for="VaccineType">Vaccine</label>
                      <select name="VaccineType" class="form-control" id="VaccineType" required>
                        <option value="">Select Vaccine Type</option>
                        <?php
                        $query = "SELECT * FROM vaccinetype";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo "<option value='" . $row['id'] . "'>" . $row['brand'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <!-- Add more form fields as needed -->
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- ... (rest of the code remains the same) ... -->


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
        //...

        $('#create-form').on('submit', function(event) {
          event.preventDefault(); // Prevent default form submission
          var formData = $(this).serialize(); // Serialize the form data



          $.ajax({
            type: 'POST',
            url: 'vaccinecentermodalcontroller.php',
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
                    title: 'Vaccination Center created successfully!',
                    text: 'The Vaccination Center has been created successfully.',
                    confirmButtonText: 'OK'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      $('#createModal').modal('hide');
                      location.reload();
                    }
                  });
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error creating vaccination center',
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
            url: 'vaccinecentermodalcontroller.php?id=' + id, // Pass the id parameter in the URL
            success: function(data) {
              var formData = JSON.parse(data);
              $('#edit-form').find('input[name="Name"]').val(formData.Name);
              $('#edit-form').find('textarea[name="Address"]').val(formData.Address);
              $('#edit-form').find('input[name="PhoneNumber"]').val(formData.PhoneNumber);
              $('#edit-form').find('input[name="Email"]').val(formData.Email);
              $('#edit-form').find('input[name="Capacity"]').val(formData.Capacity);
              $('#edit-form').find('select[name="VaccineType"]').val(formData.VaccineType);
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
                url: 'vaccinecentermodalcontroller.php?id=' + id, // Pass the id parameter in the URL
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
          url: 'vaccinecentermodalcontroller.php',
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
                  title: 'Vaccination Center updated successfully!',
                  text: 'The Vaccination Center has been updated successfully.',
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
                  title: 'Error updating vaccination center',
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