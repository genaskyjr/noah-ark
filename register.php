<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Sign Up</title>

    <!--bootstrap 5.2.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!--homepage css -->
    <link rel="stylesheet" href="css/register.css">
    <!--jquery cdn -->
    <script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script src="js/registerValidation.js"></script>


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

        
                    <h4 class="text-center">Sign Up</h4>
                    <p class="text-center">Fill out the form to join us to save dogs and cats!  &hearts; </p>
                 
                    <form id="register_form" autocomplete="off">

    <label for="fullname">Full Name<span class="text-danger">*<span></label>
    <input autocomplete="off" type="text" name="fullname" id="fullname" class="form-control my-1 mb-3 py-2" placeholder="Enter your full name" required/>

    <label for="email">Email<span class="text-danger">*<span></label>
    <input type="email" name="email" id="email" class="form-control my-1 mb-3 py-2" placeholder="Enter your Email" required/>
    <span id="email-feedback" class="invalid-feedback"></span>


    <label for="password">Password<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
      <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
      <button class="btn btn-outline-secondary" type="button" id="password-toggle">
        <i class="fas fa-eye"></i>
      </button>
    </div>

    <label for="confirm_password">Confirm Password<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
      <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm password" required>
      <button class="btn btn-outline-secondary" type="button" id="confirm-password-toggle">
        <i class="fas fa-eye"></i>
      </button>
    </div>

    <div id="password-error" class="alert alert-danger mt-2" style="display:none;"></div>
    
    
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    togglePassword('confirm_password', 'confirm-password-toggle');
  });
</script>




    <!-- <div class="alert mt-3" role="alert" id="error-alert" style="display:none;">
        <span id="alert-message"></span>
    </div> -->
    <div class="text-center my-1 mb-3 py-2">
        <button type="submit" class="btn btn-primary" id="regbutton">Register</button>
    </div>

    <div class="alert alert-success my-1 mb-3 py-2 d-none" id="alert" role="alert">
    <i class="fa-solid fa-circle-info"></i> Check your email inbox for email verification link.
</div>




    <div class="text-start">
                      <a href="/signin.php" class="text-start text-primary" style="text-decoration: none;">Already have an account?</a>                     
                    </div>


</form>

                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


  
<script>


$("#register_form").submit(function(event) {

  document.getElementById('regbutton').textContent = 'Please wait...';

document.getElementById('regbutton').disabled = true;

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
        url: "backend/register.php",
        data: $(this).serialize(), // Changed this line
        type: "POST",
        dataType: 'json',
        success: function(result) {
            console.log(result.status + " " + result.message);
            remove_alert_bg();
            if (result.status === 1) { // Changed = to ===
                // remove_alert_bg();
                // $('#error-alert').addClass("bg-warning");
                // $('#alert-message').addClass("text-dark");
                // $('#alert-message').text(result.message); //1 Email already registered.
                // setTimeout(function() { $('#error-alert').fadeOut() }, 9999999999);
                Swal.fire({
  icon: 'info',
  title: 'Already Registered.',
  text: 'Email Already Registered.'
});

document.getElementById('alert').classList.add('d-none');

document.getElementById('regbutton').textContent = 'Register';

document.getElementById('regbutton').disabled = false;


            } else if (result.status === 2) { // Changed = to ===
                // remove_alert_bg();
                // $('#error-alert').addClass("bg-success");
                // $('#alert-message').addClass("text-white");
                // $('#alert-message').text(result.message); //2 Registered successfully.
                // setTimeout(function() { $('#error-alert').fadeOut() }, 999999);
                Swal.fire({
                icon: 'success',
                title: 'Successfully Registered.',
                text: 'We sent a verification link, please check your email..'
              });

              document.getElementById('alert').classList.remove('d-none');

              document.getElementById('regbutton').textContent = 'Register';

              document.getElementById('regbutton').disabled = false;

            }else if (result.status === 3) { // Changed = to ===
                remove_alert_bg();
                $('#error-alert').addClass("bg-danger");
                $('#alert-message').addClass("text-white");
                $('#alert-message').text(result.message); //3 Error registering user.
                setTimeout(function() { $('#error-alert').fadeOut() }, 999999);
            }else if (result.status === 4) { // Changed = to ===
                // remove_alert_bg();
                // $('#error-alert').addClass("bg-danger");
                // $('#alert-message').addClass("text-white");
                // $('#alert-message').text(result.message); //4 Password and confirmed password not match.
                // setTimeout(function() { $('#error-alert').fadeOut() }, 999999);
                Swal.fire({
  icon: 'error',
  title: 'Password & Confired Password not match!',
  text: 'Password & confirmed password not match.'
});

document.getElementById('alert').classList.add('d-none');

document.getElementById('regbutton').textContent = 'Register';

            } else {
                // remove_alert_bg();
                // $('#error-alert').addClass("bg-danger");
                // $('#alert-message').addClass("text-white");
                // $('#alert-message').text(result.message); // 0 no action
                // setTimeout(function() { $('#error-alert').fadeOut() }, 999999);
                // $("#register_form")[0].reset();
                Swal.fire({
  icon: 'error',
  title: 'No action',
  text: 'No action'
});

document.getElementById('alert').classList.add('d-none');

document.getElementById('regbutton').textContent = 'Register';

            }
        }
    });

    console.log('clicked');
});




function remove_alert_bg(){

  $('#error-alert').removeClass("bg-warning");

	$('#error-alert').removeClass("bg-success");

	$('#error-alert').removeClass("bg-primary");

	$('#error-alert').removeClass("bg-danger");

}	





</script>

<script src="https://kit.fontawesome.com/c3cf7a82ce.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
