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
  /* Add some basic styling to the form */
  #date-range-form {
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  /* Style the labels and inputs */
  label {
    margin-right: 10px;
  }

  input[type="date"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
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
              </span> B/W Reports
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
  <h4 class="card-title">B/W Reports</h4>
  <p class="card-description" style="display: flex; align-items: center; justify-content: space-between;">
  <span>Summarise reports between date</span>
  <form id="date-range-form">
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date">
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date">
    <button type="button" class="btn btn-success" id="generate-csv-btn" style="margin-left: auto;">
      <i class="mdi mdi-download"></i> Generate CSV Report
    </button>
  </form>
</p>

  <!-- Add the table element here -->
  <table id="usertable" class="table table-bordered">
    <thead>
      <tr>
        <th> # </th>
        <th> Booking No </th>
        <th> First Name </th>
        <th> Last Name </th>
        <th> Vaccination Date </th>
        <th> Registered On </th>
      </tr>
    </thead>
    <tbody>
      <!-- Table rows will be inserted here by JavaScript -->
    </tbody>
  </table>

  <!-- pagination links -->
  <ul class='pagination'>
    <!-- Pagination links will be inserted here by JavaScript -->
  </ul>
  
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    function fetchTableData(page = 1) {
      const startDate = document.getElementById('start_date').value;
      const endDate = document.getElementById('end_date').value;

      $.ajax({
        url: 'fetch_table_data.php',
        type: 'GET',
        data: {
          start_date: startDate,
          end_date: endDate,
          page: page
        },
        success: function(response) {
          $('#usertable tbody').html(response);
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Unable to fetch data.',
            confirmButtonText: 'OK'
          });
        }
      });
    }

    document.getElementById('generate-csv-btn').addEventListener('click', function () {
      const startDate = document.getElementById('start_date').value;
      const endDate = document.getElementById('end_date').value;

      if (startDate && endDate) {
          window.location.href = 'generate_csv.php?start_date=' + startDate + '&end_date=' + endDate;
      } else {
          Swal.fire({
              icon: 'error',
              title: 'Date Range Required',
              text: 'Please select both start and end dates.',
              confirmButtonText: 'OK'
          });
      }
    });

    document.getElementById('date-range-form').addEventListener('change', function () {
      fetchTableData(); // Fetch and update the table on date change
    });
  </script>
</body>

</html>
