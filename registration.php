<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Registration | Covid.19 Vaccination Management System</title>
  <link rel="stylesheet" href="sources/css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="sources/css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="./sources/css/style2.css">
</head>

<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="sources/images/vaccine.webp" alt="">
        <div class="text">
          <span class="text-1">Every new friend is a <br> new adventure</span>
          <span class="text-2">Let's get connected</span>
        </div>
      </div>
      <div class="back">
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Registration</div>
          <br>
          <form id="create-form"">
          <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
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
                    <input type="text" class="form-control" id="role_id" name="role_id" value="3" hidden>
                    <div class="button input-box">
                <input type="submit">
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Add SweetAlert 2 JavaScript file -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.js"></script>
  <!-- Include jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Popper.js (required for Bootstrap 4 and 5) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
  $(document).ready(function() {
    $('#create-form').on('submit', function(event) {
      event.preventDefault(); // Prevent default form submission
      var formData = $(this).serialize(); // Serialize the form data

      $.ajax({
        type: 'POST',
        url: './system/usermodalcontroller.php',
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
                title: 'User created successfully!',
                text: 'The user has been created successfully.',
                confirmButtonText: 'OK'
              }).then((result) => {
                if (result.isConfirmed) {
                  $('#createModal').modal('hide');
                  window.location.href = 'login.php'; // Redirect to login page
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
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('AJAX Error:', textStatus, errorThrown);
          Swal.fire({
            icon: 'error',
            title: 'AJAX Request Failed',
            text: 'An error occurred while processing your request. Please try again.',
            confirmButtonText: 'OK',
            footer: `<pre>Status: ${textStatus}\nError Thrown: ${errorThrown}\nResponse Text: ${jqXHR.responseText}</pre>` 
          });
        }
      });
    });
  });
</script>
</body>
</html>