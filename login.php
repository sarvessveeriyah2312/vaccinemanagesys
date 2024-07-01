<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Login and Registration Form in HTML & CSS | CodingLab</title>
  <link rel="stylesheet" href="sources/css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="sources/css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css">
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
          <div class="title">Login</div>
          <form action="backend/loginbackend.php" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-id-card"></i>
                <input type="text" name="username" id="username" placeholder="Enter your Username" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
              </div>
              <div class="text"><a href="#">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" name="login" value="Login">
              </div>
              <div class="text sign-up-text"> <a href="registration.php">Signup Now</a> | <a href="index.php">Main Page</a></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Add SweetAlert 2 JavaScript file -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.js"></script>

  <!-- Add JavaScript code to trigger SweetAlert 2 -->
  <script>
    document.querySelector('form[action="backend/loginbackend.php"]').addEventListener('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(this);
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'backend/loginbackend.php', true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          try {
            var response = JSON.parse(xhr.responseText);
            console.log('Response:', response); // Log the full response for debugging
            if (response.success) {
              var role = response.role;
              var successMessage = 'Login Successful!';

              if (role === 1) {
                successMessage = 'You have successfully logged in as an Admin.';
              } else if (role === 3) {
                successMessage = 'You have successfully logged in as a User.';
              } else if (role === 2) {
                successMessage = 'You have successfully logged in as a Vaccinator.';
              }

              Swal.fire({
                title: 'Login Successful!',
                text: successMessage,
                icon: 'success',
                confirmButtonText: 'OK'
              }).then(function() {
                window.location.href = response.redirect;
              });
            } else {
              Swal.fire({
                title: 'Error!',
                text: response.message,
                icon: 'error',
                confirmButtonText: 'OK'
              }).then(function() {
                location.reload(); // Reload the page after the user presses OK
              });
            }
          } catch (e) {
            console.error('Error parsing JSON response:', e);
            console.log('Response:', xhr.responseText); // Log the full response
            Swal.fire({
              title: 'Error!',
              text: 'An error occurred. Please try again.',
              icon: 'error',
              confirmButtonText: 'OK'
            }).then(function() {
              location.reload(); // Reload the page after the user presses OK
            });
          }
        } else {
          Swal.fire({
            title: 'Error!',
            text: 'An error occurred. Please try again.',
            icon: 'error',
            confirmButtonText: 'OK'
          }).then(function() {
            location.reload(); // Reload the page after the user presses OK
          });
        }
      };
      xhr.send(formData);
    });

    // Example: Show an error alert when the signup form is submitted
    document.querySelector('form[action="register.php"]').addEventListener('submit', function(event) {
      event.preventDefault();
      Swal.fire({
        title: 'Error!',
        text: 'Something went wrong. Please try again.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    });
  </script>

</body>

</html>