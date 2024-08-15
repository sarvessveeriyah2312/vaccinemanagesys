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
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>

  <!-- End layout styles -->
  <link rel="shortcut icon" href="../sources/images/favicon.ico" />
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
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
              </span> Dashboard
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <?php
                $sql = "SELECT COUNT(*) as admin_count FROM users WHERE role_id= '1'";
                $result = $conn->query($sql);

                $admin_count = 0;
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $admin_count = $row['admin_count'];
                } else {
                  echo "0 results";
                }


                ?>

                <div class="card-body">
                  <img src="../sources/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Administrators <i class="mdi mdi-lock mdi-24px float-right"></i></h4>
                  <h2 class="mb-5"><?php echo $admin_count; ?> users</h2>
                </div>

              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <?php
                $sql = "SELECT COUNT(*) as admin_count2 FROM users WHERE role_id= '2'";
                $result = $conn->query($sql);

                $admin_count = 0;
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $admin_count = $row['admin_count2'];
                } else {
                  echo "0 results";
                }
                ?>
                <div class="card-body">
                  <img src="../sources/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Vaccinator Staffs<i class="mdi mdi-needle mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo $admin_count; ?> users</h2>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <?php
                $sql = "SELECT COUNT(*) as admin_count3 FROM users WHERE role_id= '3'";
                $result = $conn->query($sql);

                $admin_count = 0;
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $admin_count = $row['admin_count3'];
                } else {
                  echo "0 results";
                }
                ?>
                <div class="card-body">
                  <img src="../sources/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Registered Users<i class="mdi mdi-hospital mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo $admin_count; ?> users</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <?php
                $sql = "SELECT COUNT(DISTINCT brand) AS num_vaccine_types
FROM vaccinetype;";
                $result = $conn->query($sql);

                $type = 0;
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $type = $row['num_vaccine_types'];
                } else {
                  echo "0 results";
                }


                ?>

                <div class="card-body">
                  <img src="../sources/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Vaccine Types <i class="mdi mdi-lock mdi-24px float-right"></i></h4>
                  <h2 class="mb-5"><?php echo $type; ?> types</h2>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <?php
                $sql = "SELECT COUNT(DISTINCT Name) AS vaccination_center
FROM vaccinationcenter;";
                $result = $conn->query($sql);

                $center = 0;
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $center = $row['vaccination_center'];
                } else {
                  echo "0 results";
                }
                ?>
                <div class="card-body">
                  <img src="../sources/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Vaccination Center<i class="mdi mdi-hospital-marker mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo $center; ?> users</h2>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <?php
                $sql = "SELECT COUNT(*) as fullyvacci FROM vaccinationslot WHERE status= '4'";
                $result = $conn->query($sql);

                $fullyvacci = 0;
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $fullyvacci = $row['fullyvacci'];
                } else {
                  echo "0 results";
                }
                ?>
                <div class="card-body">
                  <img src="../sources/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Fully Vaccinated<i class="mdi mdi-check mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo $fullyvacci; ?> users</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-15 grid-margin stretch-card">

              <div class="card">
                <div class="card-body">
                  <div class="clearfix">
                    <h4 class="card-title float-left">Upcoming Schedules</h4>
                    <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                  </div>
                  <div id='calendar' class="mt-4"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
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
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      fetch('fetchdate.php')
        .then(response => response.json())
        .then(data => {
          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: data
          });

          calendar.render();
        });
    });
  </script>



  <!-- End custom js for this page -->
</body>

</html>