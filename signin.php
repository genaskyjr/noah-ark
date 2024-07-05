<?php

session_start();

if(isset($_SESSION['email'])){
  header("Location: profile.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Sign In</title>

    <!--bootstrap 5.2.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!--homepage css -->
    <link rel="stylesheet" href="css/signin.css">
    
    <!--jquery cdn -->
    <script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>


<link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css " rel="stylesheet">

<script src="js/signinValidation.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
  /* Apply these styles to center the section */
  body, html {
    height: 100%;
    margin: 20;
    display: flex;
    align-items: center;
    justify-content: center;
  } 

  section {
    width: 500%; /* Ensure the section takes full width */
    max-width: 1500px; /* Adjust this value as needed */
    padding: 20px; /* Add padding to the section */
    box-sizing: border-box; /* Include padding in the width */
  }
</style>



  </head>
  <body>
      <script src="js/zoom.js"></script>

    <section>
        <div class="container mt-3 pt-3">
          <div class="row">
            <div class="col-12 col-sm-7 col-md-6 m-auto">
              <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <img src="/assets/logo.png" class="rounded mx-auto d-block w-25" alt="...">
                    <h1 class="text-center">Sign In</h1>
                    <p class="text-center">Sign in to start your Session.</p>


                    <form id="login_form" method="post" autocomplete="off">

                      
                    <label>Email</label>
                    <input required type="email" name="email" id="email" class="form-control my-1 mb-3 py-2" autocomplete="off" placeholder="Enter your email" />
                    
                    <!-- Ensure you have Font Awesome linked properly -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Your password field HTML -->
<label for="password">Password</label>
<div class="input-group mb-3">
  <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
  <button class="btn btn-outline-secondary" type="button" id="password-toggle">
    <i class="fas fa-eye"></i>
  </button>
</div>

<!-- The provided JavaScript code -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const togglePassword = (inputId, buttonId) => {
    const passwordInput = document.getElementById(inputId);
    const toggleButton = document.getElementById(buttonId);
    
    toggleButton.addEventListener('click', () => {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      
      // Change icon based on password visibility state
      toggleButton.querySelector('i').classList.toggle('fa-eye-slash');
      toggleButton.querySelector('i').classList.toggle('fa-eye');
    });
  };

  togglePassword('password', 'password-toggle');
});
</script>

        
                    <a href="/forgot.php" class="text-start text-primary" style="text-decoration: none;">Forgot password</a>


                    <div class="text-center mt-3">
                            <button type="submit"  class="btn btn-primary">Sign In</button>                          
                    </div>

                    <a href="/register.php" class="text-start text-primary" style="text-decoration: none;">Dont have account yet?</a>

      
                  </form>


                </div>
              </div>
            </div>
          </div>
        </div>
      </section>







      <script> 
$("#login_form").submit(function(event) {
    event.preventDefault();

    var hasInvalidField = $('.is-invalid').length > 0;

    if (hasInvalidField) {
        Swal.fire({
            title: 'Info',
            text: 'Please fill out all required fields correctly.',
            icon: 'info',
            confirmButtonText: 'Ok'
        });
        return;
    }

    $.ajax({
        url: "backend/signin.php",
        data: $(this).serialize(),
        type: "POST",
        dataType: 'json',
        success: function(result) {
            console.log(result.status + " " + result.message);

            var glo_email = result.email;
            var glo_fullname = result.fullnamemo;

            
            if (result.status === 1) {
                Swal.fire({
                    title: 'Logged In Successfully!',
                    text: 'Welcome back to Noah’s Ark',
                    icon: 'success',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.replace("/");
                    }
                });
            } else if (result.status === 4) {
              Swal.fire({
                title: 'Resend Verification Link?',
                text: 'Hi! ' + result.fullnamemo + ' we noticed that you haven’t verified your account yet. Resend verification link to  ' + result.email + '?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Resend',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Handle Resend action
                    // You can put the logic to resend the verification link here
                    // For example: window.location.href = 'resend_verification.php';
                    Swal.fire({
                      title: 'Verification link',
                      text: 'Resending...',
                      icon: 'info',
                      showConfirmButton: false
                  });
            
                    console.log('backend/resend_verification.php?email=' + glo_email +'&fullnamemo='+ glo_fullname);

                    
                    fetch('backend/resend_verification.php?email=' + glo_email +'&fullnamemo='+ glo_fullname)
                    .then(response => {
                        // Handle the response from the server
                        if (response.ok) {
                            return response.text();

                        } else {
                            throw new Error('Network response was not ok.');
                        }
                    })
                    .then(data => {
                        // Handle the data received from the server
                        console.log('Server response:', data);
                        // Perform further actions as needed with the data
                    })
                    .catch(error => {
                        // Handle errors that occurred during the fetch request
                        console.error('Fetch error:', error);
                    });


                    setTimeout(function() {
                        Swal.fire('Verification Link Sent!', 'Noah’s Ark has resent your email verification successfully. Please check your email', 'success');
                    }, 1500); // 2000 milliseconds = 2 seconds

                } else {
                    // Handle Cancel action
                    Swal.fire('Cancelled', 'You chose to cancel.', 'error');
                }
            });

            } else if (result.status === 2) {
                Swal.fire({
                    title: 'Invalid Account',
                    text: 'Invalid Email or Password!',
                    icon: 'warning'
                });
            } else {
                Swal.fire({
                    title: 'No Action',
                    text: 'Something went wrong!',
                    icon: 'error'
                });
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            Swal.fire({
                title: 'Error',
                text: 'An error occurred while processing your request. Please try again later.',
                icon: 'error'
            });
        }
    });

    console.log('clicked');
});
</script>


    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
