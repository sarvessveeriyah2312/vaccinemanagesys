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
                </span> Manage Vaccinator
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
                <h4 class="card-title">Vaccinators</h4>
                <p class="card-description" style="display: flex; align-items: center; justify-content: space-between;">
                  Easily add, update, and remove vaccinators users.
                  <button type="button" class="btn btn-gradient-success btn-rounded btn-fw btn-sm">
                    <i class="mdi mdi-account-plus"></i> Add Vaccinators
                  </button>
                </p>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> First name </th>
                      <th> Progress </th>
                      <th> Amount </th>
                      <th> Deadline </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td> 1 </td>
                      <td> Herman Beck </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $ 77.99 </td>
                      <td> May 15, 2015 </td>
                    </tr>
                    <tr>
                      <td> 2 </td>
                      <td> Messsy Adam </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $245.30 </td>
                      <td> July 1, 2015 </td>
                    </tr>
                    <tr>
                      <td> 3 </td>
                      <td> John Richards </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $138.00 </td>
                      <td> Apr 12, 2015 </td>
                    </tr>
                    <tr>
                      <td> 4 </td>
                      <td> Peter Meggik </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $ 77.99 </td>
                      <td> May 15, 2015 </td>
                    </tr>
                    <tr>
                      <td> 5 </td>
                      <td> Edward </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $ 160.25 </td>
                      <td> May 03, 2015 </td>
                    </tr>
                    <tr>
                      <td> 6 </td>
                      <td> John Doe </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $ 123.21 </td>
                      <td> April 05, 2015 </td>
                    </tr>
                    <tr>
                      <td> 7 </td>
                      <td> Henry Tom </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $ 150.00 </td>
                      <td> June 16, 2015 </td>
                    </tr>
                  </tbody>
                </table>
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
    <!-- End custom js for this page -->
  </body>
</html>