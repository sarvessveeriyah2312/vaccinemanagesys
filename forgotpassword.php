<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="sources/css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="sources/css/login.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css">
  <style>
  .dialogue {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1050;
  display: none;
  overflow: hidden;
  outline: 0;
}

.dialogue-content {
  position: relative;
  display: flex;
  flex-direction: column;
  width: 50%; /* adjust the width as needed */
  max-width: 500px; /* add a max-width property */
  margin: 0 auto;
  pointer-events: auto;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 0.3rem; /* add a border-radius property */
  outline: 0;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.dialogue-header {
  display: flex;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid #dee2e6;
}

.dialogue-title {
  margin-bottom: 0;
  line-height: 1.5;
}

.dialogue-body {
  position: relative;
  flex: 1 1 auto;
  padding: 1rem; /* add a padding property */
}

.close {
  float: right;
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1;
  color: #000;
  text-shadow: 0 1px 0 #fff;
  opacity: .5;
}

.close:hover {
  color: #000;
  text-decoration: none;
  opacity: .75;
}

.close:focus {
  box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.125);
}

.button {
  cursor: pointer; /* add a cursor property */
  transition: background-color 0.2s ease-in-out; /* add a transition property */

}



  </style>
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
          <div class="title">Forgot Password</div>
          <form id="emailForm">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email" required>
              </div>
              <div class="button input-box">
                <button type="submit" class="btn btn-primary">Reset Password</button>
              </div>
              <div class="text sign-up-text"><a href="registration.php">Signup Now</a> | <a href="login.php">Login Now</a></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<!-- Dialogue -->
<div class="dialogue" id="resetPasswordDialogue">
  <div class="dialogue-content">
    <div class="dialogue-header">
      <h5 class="dialogue-title">Reset Password</h5>
      <button type="button" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="dialogue-body">
      <form id="resetPasswordForm">
        <input type="hidden" name="email" id="resetEmail">
        <div class="form-group">
          <label for="newPassword">New Password</label>
          <input type="password" class="form-control" id="newPassword" name="new_password" placeholder="Enter your new password" required>
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm your new password" required>
        </div>
        <div class="button input-box">
            <button type="submit" class="btn btn-primary">Reset Password</button>
          </div>
      </form>
    </div>
  </div>
</div>

  <!-- Include jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- Include SweetAlert2 JavaScript file -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>

  <script>
$('#emailForm').on('submit', function (e) {
  e.preventDefault();
  var email = $('#email').val();

  $.ajax({
    type: 'POST',
    url: 'backend/forgotpasswordbackend.php',
    data: { email: email },
    success: function (response) {
      var res = JSON.parse(response);
      if (res.success) {
        // Set the email in the hidden input field of the dialogue
        $('#resetEmail').val(email);

        // Show the reset password dialogue
        $('#resetPasswordDialogue').fadeIn();
      } else {
        // Show error message using SweetAlert2
        Swal.fire({
          title: 'Error!',
          text: res.message,
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    },
    error: function () {
      // Show error message using SweetAlert2
      Swal.fire({
        title: 'Error!',
        text: 'An error occurred. Please try again.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    }
  });
});

$('#resetPasswordForm').on('submit', function (e) {
  e.preventDefault();
  var formData = $(this).serialize();

  $.ajax({
    type: 'POST',
    url: 'backend/resetpasswordbackend.php',
    data: formData,
    success: function (response) {
      var res = JSON.parse(response);
      if (res.success) {
        // Show success message and hide dialogue
        Swal.fire({
          title: 'Success!',
          text: 'Password has been reset successfully.',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then(() => {
          $('#resetPasswordDialogue').fadeOut();
          // Optionally, redirect to the login page
          window.location.href = 'login.php';
        });
      } else {
        // Show error message using SweetAlert2
        Swal.fire({
          title: 'Error!',
          text: res.message,
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    },
    error: function () {
      // Show error message using SweetAlert2
      Swal.fire({
        title: 'Error!',
        text: 'An error occurred. Please try again.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    }
  });
});

$('.close').on('click', function() {
  $('#resetPasswordDialogue').fadeOut();
});
  </script>
</body>

</html>
