<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Change Password</title>

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

    <script src="js/resetValidation.js"></script>


  </head>
  <body>
<script src="js/zoom.js"></script>
    <section>
        <div class="container mt-4 pt-4">
          <div class="row">
            <div class="col-12 col-sm-7 col-md-6 m-auto">
              <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <img src="/assets/logo.png" class="rounded mx-auto d-block w-25" alt="...">
                    <h1 class="text-center">Change Password</h1>
                    <p class="text-center">Fill out all forms</p>

                    <form id="setpassword_form" method="post">
					
                    <label for="password">Code</label>
                    <input type="text" name="code" value="<?php echo $_GET['code'];?>" id="code" class="form-control my-1 mb-3 py-2" required readonly />


                    <label for="password">Password<span class="text-danger">*</span></label>
<div class="input-group mb-3">
  <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
  <button class="btn btn-outline-secondary" type="button" id="password-toggle">
    <i id="password-icon" class="fas fa-eye"></i>
  </button>
</div>

<!-- HTML for Confirm Password Field -->
<label for="confirm_password">Confirm Password<span class="text-danger">*</span></label>
<div class="input-group mb-3">
  <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm password" required>
  <button class="btn btn-outline-secondary" type="button" id="confirm-password-toggle">
    <i id="confirm-password-icon" class="fas fa-eye"></i>
  </button>
</div>



<!-- CSS and JavaScript -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<!-- Place this script at the bottom of your HTML, just before the closing </body> tag -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>




                    <!-- Add this element near the confirmed password input -->
                  <div id="password1-error" class="alert alert-danger mt-2" style="display:none;"></div>


    <!-- <div class="alert mt-3" role="alert" id="error-alert" style="display:none;">
        <span id="alert-message"></span>
    </div> -->
    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Change Password</button>
    </div>
	
    <a href="/signin.php" class="nav-link text-end text-primary mt-3">Remember your password?</a>
                       
                  </form>


                  


                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      
<script> 




$("#setpassword_form").submit(function(event) {
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
        url: "backend/reset.php",
        data: $(this).serialize(), // Changed this line
        type: "POST",
        dataType: 'json',
        success: function(result) {
            console.log(result.status + " " + result.message);
          
            if (result.status === 1) { // Changed = to ===
                
         
                
              Swal.fire({
    title: 'Password changed Successfully!',
    text: 'Your password has been change.',
    icon: 'success',
    confirmButtonText: 'Confirm'
}).then((result) => {
    if (result.isConfirmed) {
        window.location.href = 'signin.php';
    }
});




            } else if(result.status ===2){


              Swal.fire({
            title: 'Link Expired.',
            text: 'Link Already Expired!',
            icon: 'info'
                });



            } else {
                // remove_alert_bg();
                // $('#error-alert').addClass("bg-danger");
                // $('#alert-message').addClass("text-white");
                // $('#alert-message').text(result.message); // 0 no action
                // setTimeout(function() { $('#error-alert').fadeOut() }, 999999);
                // $("#login_form")[0].reset();
                Swal.fire({
            title: 'No Action',
            text: 'Something went wrong!',
            icon: 'error'
                });
                
            }
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
