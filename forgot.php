<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Forgot</title>

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

    <script src="js/forgotValidation.js"></script>
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
        <div class="container mt-4 pt-4">
          <div class="row">
            <div class="col-12 col-sm-7 col-md-6 m-auto">
              <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <img src="/assets/logo.png" class="rounded mx-auto d-block w-25" alt="...">
                    <h1 class="text-center">Forgot Password</h1>
                    <p class="text-center">Fill out the form to reset your password</p>

                    <form id="forgot_form" method="post">

                    <label>Email<span class="text-danger">*<span></label>
                    <input required type="email" name="email" id="email" class="form-control my-1 mb-3 py-2" autocomplete="off" placeholder="Enter your email" />
                    
                    <div class="valid-feedback mt-2">
                      Looks good!
                    </div>

                    <div class="text-center">
                            <button type="submit" id="sendcode" class="btn btn-primary">Send Link</button>                          
                    </div>
            
              
                    <div class="text-end">
                      <a href="/signin.php" class="text-end text-primary" style="text-decoration: none;">Sign In</a>                      
                    </div>
                    
                   

                       
                  </form>


                  


                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      
<script> 




$("#forgot_form").submit(function(event) {
  document.getElementById('sendcode').disabled = true;
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


        
        Swal.fire({
    title: 'Reset Link',
    text: 'Sending Reset Link',
    icon: 'info',
    timer: 3000, // Set the timer to 3 seconds (adjust as needed)
    showConfirmButton: false // Hide the confirmation button
});

    
    
    $.ajax({
        url: "backend/forgot.php",
        data: $(this).serialize(), // Changed this line
        type: "POST",
        dataType: 'json',
        success: function(result) {
            console.log(result.status + " " + result.message);
            remove_alert_bg();
            if (result.status === 1) { // Changed = to ===
                // remove_alert_bg();
                // $('#error-alert').addClass("bg-success");
                // $('#alert-message').addClass("text-white");
                // $('#alert-message').text(result.message); //1 login successfully
                // setTimeout(function() { $('#error-alert').fadeOut() }, 9999999999);
                // setTimeout(() => {
                //   location.replace("index.php");
                //  }, 2000);

                document.getElementById('sendcode').disabled = false;
                
                           Swal.fire({
            title: 'Reset Link Sent!',
            text: 'Reset link has been sent to your email.',
            icon: 'success',
            confirmButtonText: 'Confirm'
        });



      


            } else if (result.status === 2) { // Changed = to ===
                // remove_alert_bg();
                // $('#error-alert').addClass("bg-danger");
                // $('#alert-message').addClass("text-white");
                // $('#alert-message').text(result.message); //2 email or pass wrong
                // setTimeout(function() { $('#error-alert').fadeOut() }, 999999);
                document.getElementById('sendcode').disabled = false;
                
            Swal.fire({
            title: 'Email Invalid',
            text: 'Email doesnt Exist!',
            icon: 'warning'
        
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




function remove_alert_bg(){

  $('#error-alert').removeClass("bg-warning");

	$('#error-alert').removeClass("bg-success");

	$('#error-alert').removeClass("bg-primary");

	$('#error-alert').removeClass("bg-danger");

}	





</script>  

  

<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
