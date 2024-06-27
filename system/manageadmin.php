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
              </span> Manage Administrator
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
                <h4 class="card-title">Administrators</h4>
                <p class="card-description" style="display: flex; align-items: center; justify-content: space-between;">
                  Easily add, update, and remove administrative users.
                  <button type="button" class="btn btn-gradient-success btn-rounded btn-fw btn-sm">
                    <i class="mdi mdi-account-plus"></i> Add Administrator
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
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> First name </th>
                      <th> Last name </th>
                      <th> Email </th>
                      <th> Created At </th>
                      <th> Status </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include 'updateadmin.php';
                    $limit = 5; // limit the number of rows per page
                    $offset = 0; // initial offset
                    $total_rows = 0; // total number of rows
                    $total_pages = 0; // total number of pages

                    // query to get the total number of rows
                    $query = "SELECT * FROM users WHERE role_id = 1";
                    $result = $conn->query($query);
                    $total_rows = $result->num_rows;

                    // calculate the total number of pages
                    $total_pages = ceil($total_rows / $limit);

                    // get the current page number
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($current_page - 1) * $limit;

                    // query with limit and offset
                    $query = "SELECT * FROM users WHERE role_id = 1 LIMIT $offset, $limit";
                    $result = $conn->query($query);

                    ?>
                    <?php
                    $counter = 1; // initialize the counter
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $counter . "</td>"; // incremental number
                      echo "<td>" . $row["first_name"] . "</td>";
                      echo "<td>" . $row["last_name"] . "</td>";
                      echo "<td>" . $row["email"] . "</td>";
                      echo "<td>" . $row["created_at"] . "</td>";
                      echo "<td>";
                      if ($row["status"] == 1) {
                        echo "<label class='badge badge-success'>Active</label>";
                      } else {
                        echo "<label class='badge badge-danger'>Inactive</label>";
                      }
                      echo "</td>";
                      echo "<td>";
                      echo "<a href='#' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal' data-id='". $row["id"]. "'><i class='mdi mdi-pencil'></i> Edit</a>";
                      echo " ";
                      echo "<a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'><i class='mdi mdi-delete'></i> Delete</a>";
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

          <!-- Add a modal dialog box to the same page -->
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Administrator</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- Form will be generated dynamically here -->
                  <form id="edit-form">
                    <div class="form-group">
                      <label for="first_name">First Name</label>
                      <input type="text" class="form-control" id="first_name" name="first_name">
                    </div>
                    <div class="form-group">
                      <label for="last_name">Last Name</label>
                      <input type="text" class="form-control" id="last_name" name="last_name">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email">
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
    <script>
      $(document).ready(function() {
        $('a[data-toggle="modal"]').on('click', function() {
          var id = $(this).attr('data-id'); // Use attr() instead of data()
          $.ajax({
            type: 'GET',
            url: 'updateadmin.php?id=' + id, // Pass the id parameter in the URL
            success: function(data) {
              var formData = JSON.parse(data);
              $('#edit-form').find('input[name="first_name"]').val(formData.first_name);
              $('#edit-form').find('input[name="last_name"]').val(formData.last_name);
              $('#edit-form').find('input[name="email"]').val(formData.email);
              // Populate other form fields as needed
              $('#editModal').modal('show');
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