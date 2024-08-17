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
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../sources/css/style2.css">
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
$currentUserId = $_SESSION['user_id'];
$statusSql = "SELECT status FROM vaccinationslot WHERE user_id = '$currentUserId'";
$statusResult = $conn->query($statusSql);

$statusMessage = "Not Registered"; // Default message
if ($statusResult->num_rows > 0) {
    $statusRow = $statusResult->fetch_assoc();
    switch ($statusRow['status']) {
        case 1:
            $statusMessage = "Registration Approved";
            break;
        case 0:
            $statusMessage = "Registered";
            break;
        case 2:
            $statusMessage = "Registration Rejected";
            break;
        case 3:
            $statusMessage = "Dose 1 Completed";
            break;
        case 4:
            $statusMessage = "Dose 2 Completed";
            break;
        default:
            $statusMessage = "Inactive";
            break;
    }
}
?>

                  <div class="card-body">
                    <img src="../sources/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Vaccination Status <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $statusMessage; ?></h2>
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
    <!-- End custom js for this page -->
  </body>
</html>