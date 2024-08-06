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

    .btn-primary.btn-sm,
    .btn-danger.btn-sm {
      background: none;
      border: black;
      padding: 0;
      margin: 0;

    }

    .container {
      width: 30%;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      margin-right: 5px;
    }

    .search-bar {
      width: 100%;
      height: 20%;
      max-width: 700px;
      display: flex;
      justify-content: flex-end;
      border-radius: 20px;
      border: 1px solid rgba(129, 96, 221);
      padding: 5px 20px;
      /* Add some space between the search bar and the right edge */
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
              </span>Vaccination Appointment
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
                <h4 class="card-title">Vaccination Appointment</h4>
                <p class="card-description" style="display: flex; align-items: center; justify-content: space-between;">
                  <span>Easily add, update, and remove vaccine type.</span>
                <div class="container">
                  <input type="text" class="search-bar" id="search-input" placeholder="Search by appointment number">
                </div>
                </p>


                <?php
                include '../backend/connection.php';

                // Restrict access based on role
                if (!isset($_SESSION['role_id']) || ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2)) {
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
                <div class="input-group mb-3">
                  <div class="input-group-append">
                  </div>
                </div>
                <table id="usertable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Booking No </th>
                      <th> First Name </th>
                      <th> Last Name </th>
                      <th> Expiry Date </th>
                      <th> Registered On </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include 'vaccinationslotcontroller.php';
                    $limit = 5; // limit the number of rows per page
                    $offset = 0; // initial offset
                    $total_rows = 0; // total number of rows
                    $total_pages = 0; // total number of pages

                    // query to get the total number of rows
                    $query = "SELECT * FROM vaccinationslot";
                    $result = $conn->query($query);
                    $total_rows = $result->num_rows;

                    // calculate the total number of pages
                    $total_pages = ceil($total_rows / $limit);

                    // get the current page number
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($current_page - 1) * $limit;

                    // query with limit and offset
                    $query = "SELECT * FROM vaccinationslot WHERE status = 1 LIMIT $offset, $limit";
                    $result = $conn->query($query);

                    ?>
                    <?php
                    $counter = 1; // initialize the counter
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $counter . "</td>"; // incremental number
                      echo "<td>" . $row["booking_no"] . "</td>";
                      echo "<td>" . $row["first_name"] . "</td>";
                      echo "<td>" . $row["last_name"] . "</td>";
                      echo "<td>" . $row["vaccinationdate"] . "</td>";
                      echo "<td>" . date("g:i a", strtotime($row["vaccinationtime"])) . "</td>";
                      echo "<td>";
                      echo "<button class='btn btn-primary btn-sm' data-id='" . $row["id"] . "'><i class='mdi mdi-pencil' style='color: blue; font-size: 24px;'></i></button>";
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
                  <h5 class="modal-title" id="createModalLabel">Create Vaccine Type</h5>
                  <button type="button" class="close custom-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- Form will be generated dynamically here -->
                  <form id="edit-form">
                    <div class="form-group">
                      <label for="brand">Brand</label>
                      <input type="text" class="form-control" id="brand" name="brand">
                    </div>
                    <div class="form-group">
                      <label for="manufacturer">Manufacturer</label>
                      <input type="text" class="form-control" id="manufacturer" name="manufacturer">
                    </div>
                    <div class="form-group">
                      <label for="manufacturing_date">Manufacturing Date</label>
                      <input type="date" class="form-control" id="manufacturing_date" name="manufacturing_date">
                    </div>
                    <div class="form-group">
                      <label for="last_name">Expiry Date</label>
                      <input type="date" class="form-control" id="expiry_date" name="expiry_date">
                    </div>
                    <div class="form-group">
                      <label for="batch_no">Batch No</label>
                      <input type="text" class="form-control" id="batch_no" name="batch_no">
                    </div>
                    <!-- Add more form fields as needed -->
                    <button type="submit" class="btn btn-primary">Create</button>
                  </form>
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
    <script>
      $(document).ready(function() {
        $('#search-input').on('keyup', function() {
          var searchQuery = $(this).val();
          $.ajax({
            type: 'GET',
            url: 'vaccinationslotcontroller.php',
            data: {
              search: searchQuery
            },
            success: function(data) {
              var response = JSON.parse(data);
              if (response.success) {
                var tableBody = '';
                let counter = 1;
                $.each(response.data, function(index, item) {
                  tableBody += '<tr>';
                  tableBody += '<td>' + counter + '</td>';
                  tableBody += '<td>' + item.booking_no + '</td>';
                  tableBody += '<td>' + item.first_name + '</td>';
                  tableBody += '<td>' + item.last_name + '</td>';
                  tableBody += '<td>' + item.vaccinationdate + '</td>';
                  tableBody += '<td>' + item.vaccinationtime + '</td>';
                  tableBody += '<td>' + item.created_at + '</td>';
                  tableBody += '<td>';
                  tableBody += "<button class='btn btn-primary btn-sm' data-id='" + item.id + "'><i class='mdi mdi-pencil' style='color: blue; font-size: 24px;'></i></button>";
                  tableBody += '</td>';
                  tableBody += '</tr>';
                });
                $('#usertable tbody').html(tableBody);
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Error searching booking number',
                  // text: 'Error: ' response.error,
                  confirmButtonText: 'OK'
                });
              }
            }
          });
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        $('.btn-primary').on('click', function(event) {
          event.preventDefault();
          var id = $(this).attr('data-id');
          console.log('Button clicked with ID:', id);

          if (typeof id === 'undefined' || id === '') {
            console.error('ID is empty or undefined');
            return;
          }

          $.ajax({
            type: 'POST',
            url: 'fetchdata.php',
            data: {
              id: id
            },
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            dataType: 'json',
            beforeSend: function(xhr) {
              console.log('Sending request with ID:', id);
            },
            success: function(data) {
              if (data.success) {
                sessionStorage.setItem('updateData', JSON.stringify(data));
                window.location.href = 'updateappointment.php';
              } else {
                console.error('Error:', data.message);
                // alert('Error fetching data: ' data.message);
              }
            },
            error: function(xhr, status, error) {
              console.error('Error:', error);
              alert('An unexpected error occurred. Please try again.');
            }
          });
        });
      });
    </script>
    <script>
      $(document).ready(function() {
  $('.delete-btn').on('click', function(event) {
    event.preventDefault();
    var id = $(this).attr('data-id');
    console.log('Delete button clicked with ID:', id);

    if (typeof id === 'undefined' || id === '') {
      console.error('ID is empty or undefined');
      return;
    }

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: 'POST',
          url: 'deletevaccinerequest.php',
          data: {
            id: id
          },
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          success: function(data) {
            try {
              var response = JSON.parse(data);
              if (response.success) {
                Swal.fire({
                  icon: 'success',
                  title: 'Vaccination slot deleted successfully!',
                  text: 'The vaccination slot has been deleted successfully.',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Error deleting vaccination slot',
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
      }
    });
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