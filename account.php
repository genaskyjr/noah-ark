
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Account</title>

    <!--bootstrap 5.2.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!--font -->
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-55" rel="stylesheet">
    <!--homepage css -->
    <link rel="stylesheet" href="css/custom.css">
    <!--icon -->
    <script src="https://kit.fontawesome.com/c3cf7a82ce.js" crossorigin="anonymous"></script>
    <!--jquery cdn -->
    <script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

    <script src="js/accountValidation.js"></script>
    

    
  </head>



  <style>
.modal-backdrop {
     background-color: transparent;
}
</style>

  <body>

  <script src="js/zoom.js"></script>

<?php 
  include 'components/nav.php';
  include 'components/navbar.php';
?>


  

  

    <?php 
    include 'components/sidebar.php'
    ?>
     


      <!-- content start -->


      <div id="content" class="m-3 bg-white container content border-top border-success border-3 rounded-1">
    

      <?php
        include 'components/breadcrumb.php'
      ?>

        <!-- content  -->

        <div class="row p-1">
            <div class="col-md-6 mt-3">
                <!-- start -->
                


                <?php 
                include_once('backend/dbconnect.php');

            
                if(isset($_GET['id'])){
                  $id = $_GET['id'];
                }

                if(isset($id)){
                  $stmt = $conn->prepare('SELECT `id`, `is_role`, `reg_date`, `fullname`, `email`, `address`, `phone_number`,
                   `password`, `is_email_verified`, `is_acount_verified`, identification_img FROM `users` WHERE `id` = :id');
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                  $stmt->execute();
  
                  $result = $stmt->fetch(PDO::FETCH_ASSOC);

                  ?>


          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">ID: <?php echo $result['fullname']?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <?php
                                // Check if the identification_img is not empty
                                if (!empty($result['identification_img'])) {
                                  echo '<img src="' . $result['identification_img'] . '" alt="Logo"  class="img-fluid">';
                                } else {
                                  echo 'No image available';
                                }
                                ?>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            
                              </div>
                            </div>
                          </div>
                        </div>


<form id="account_form" method="post" >


    <input type="text" value="<?php echo $result['id']?>" name="id" id="id" class="form-control my-1 mb-3 py-2 d-none" placeholder="Enter your id" required/>

    <label for="fullname">Full Name<span class="text-danger">*</span></label>
    <input type="text" value="<?php echo $result['fullname']?>" name="fullname" id="fullname" class="form-control my-1 mb-3 py-2" placeholder="Enter your full name" required/>
    
    <label for="email">Email</label>
    <input type="email" value="<?php echo $result['email']?>" name="email" id="email" class="form-control my-1 mb-3 py-2" placeholder="Enter your Email" required disabled/>

    <label for="address">Address<span class="text-danger">*</span></label>
    <select id="address" name="address" class="form-control my-1 mb-3 py-2" required>
        <option value="<?php echo $result['address']?>" selected><?php echo $result['address']?></option>
        <!-- Your address options -->
    </select>

    <label for="phone_number">Phone Number<span class="text-danger">*</span></label>
    <input type="text" value="<?php echo $result['phone_number']?>" name="phone_number" id="phone_number" class="form-control my-1 mb-3 py-2" placeholder="Enter phone number (11 digits)" required/>

    <label for="is_email_verified">Email Verification<span class="text-danger">*</span></label>
    <select name="is_email_verified" id="is_email_verified" class="form-select form-control my-1 mb-3 py-2" aria-label="Default select example">
        <?php 
        if ($result['is_email_verified'] == 1) {
            echo '<option value="1" selected>Verified</option>';
            echo '<option value="0">Not Verify</option>';
        } else {
            echo '<option value="1">Verify</option>';
            echo '<option value="0" selected>Not Verify</option>';
        }
        ?>
    </select>

    <label for="is_acount_verified">Address Verification<span class="text-danger">*</span></label>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fa-eye"></i> View ID
    </button>
    <select name="is_acount_verified" id="is_acount_verified" class="form-select form-control my-1 mb-3 py-2" aria-label="Default select example">
        <?php 
        if ($result['is_acount_verified'] == 1) {
            echo '<option value="1" selected>Verified</option>';
            echo '<option value="0">Not Verify</option>';
        } else {
            echo '<option value="1">Verified</option>';
            echo '<option value="0" selected>Not Verify</option>';
        }
        ?>
    </select>



    <div class="text-start mt-3">
    <button type="button" class="btn btn-success" onclick="submitAccountForm()">Update Account</button>                       
    </div>

    <div class="text-start mt-3">
        <p class="fs-6"><span class="text-danger">*</span> Required Fields</p>
    </div>
</form>



                                  <!-- start -->
            </div>
            <div class="col-md-6 mt-3">
                <!-- start -->
                <form id="password_form" method="post">

                <input type="text" value="<?php echo $result['id']?>" name="id" id="id" class="form-control my-1 mb-3 py-2 d-none" placeholder="Enter your id " required/>
                        
                        
                        <label>Current Password</label>
                        <input disabled value="<?php echo $result['password']; ?>" autocomplete="off" type="text" name="currentpassword" id="currentpassword" class="form-control my-1 mb-3 py-2" placeholder="Enter new password" required/>
                        
                    
                        <label>New Password<span class="text-danger">*<span></label>
                        <input autocomplete="off" type="password" name="password" id="password" class="form-control my-1 mb-3 py-2" placeholder="Enter new password" required/>
                        
                        <div id="password-error" class="alert alert-danger mt-2" style="display:none;"></div>

                       

                        <label>Confirmed New Password<span class="text-danger">*<span></label>
                        <input autocomplete="off" type="password" name="password1" id="password1" class="form-control my-1 mb-3 py-2" placeholder="Enter new confirmed password" required/>
                      
                        <div id="password1-error" class="alert alert-danger mt-2" style="display:none;"></div>

                       
<!-- 
                        <div class="alert mt-3" role="alert" id="error-alert-pass" style="display:none;">
                          <span id="alert-message-pass"></span>
                        </div> -->
                        

                    <div class="text-start mt-3">
                            <button type="submit"  class="btn btn-success">Update password</button>                          
                    </div>
                    <div class="text-start mt-3">
    <p class="fs-6"><span class="text-danger">*</span> Required Fields</p>
    </div>

                  </form>
                <!-- start -->
            </div>

                  <?php




                }else{ ?>



                  

                  <form id="account_form">
                        <label>Full Name<span class="text-danger">*<span></label>
                        <input type="text" value="<?php echo $_SESSION['fullname']?>" name="fullname" id="fullname" class="form-control my-1 mb-3 py-2" placeholder="Enter your full name" required/>
                        

                        
                        <label>Email</label>
                        <input type="email" value="<?php echo $_SESSION['email']?>" name="email" id="email" class="form-control my-1 mb-3 py-2" placeholder="Enter your Email" required disabled/>

                        
                        <!-- <label>Address</label>
                        <input type="text" value="<?php echo $_SESSION['address']?>" name="address" id="address" class="form-control my-1 mb-3 py-2" placeholder="Enter your Address" required/>
                         -->

                         <label for="address">Barangay<span class="text-danger">*<span></label>


                        <select id="address" name="address" class="form-control my-1 mb-3 py-2" required>
                        <option value="<?php echo $_SESSION['address']?>" selected><?php echo $_SESSION['address']?></option>


                        <option value="Atlu-Bola">Atlu-Bola</option>
                        <option value="Bical">Bical</option>
                        <option value="Bundagul">Bundagul</option>
                        <option value="Cacutud">Cacutud</option>
                        <option value="Calumpang">Calumpang</option>
                        <option value="Camachiles">Camachiles</option>
                        <option value="Dapdap">Dapdap</option>
                        <option value="Dau">Dau</option>
                        <option value="Dolores">Dolores</option>
                        <option value="Duquit">Duquit</option>
                        <option value="Lakandula">Lakandula</option>
                        <option value="Mabiga">Mabiga</option>
                        <option value="Macapagal Village">Macapagal Village</option>
                        <option value="Mamatitang">Mamatitang</option>
                        <option value="Mangalit">Mangalit</option>
                        <option value="Marcos Village">Marcos Village</option>
                        <option value="Mawaque (Mauaque)">Mawaque (Mauaque)</option>
                        <option value="Paralayunan">Paralayunan</option>
                        <option value="Poblacion">Poblacion</option>
                        <option value="San Francisco">San Francisco</option>
                        <option value="San Joaquin">San Joaquin</option>
                        <option value="Santa Ines">Santa Ines</option>
                        <option value="Santa Maria">Santa Maria</option>
                        <option value="Santo Rosario">Santo Rosario</option>
                        <option value="Sapang Balen">Sapang Balen</option>
                        <option value="Sapang Biabas">Sapang Biabas</option>
                        <option value="Tabun">Tabun</option>
                    </select>


                        <label>Phone Number<span class="text-danger">*<span></label>
                        <input type="text" value="<?php echo $_SESSION['phone_number']?>" name="phone_number" id="phone_number" class="form-control my-1 mb-3 py-2" placeholder="Enter phone number (11 digits)" required/>
                        

                        <?php 
                        if($_SESSION['is_role']=='admin'){
                          echo '<div class="container border my-1 mb-3 py-2 d-none">';
                        }else{
                          echo '<div class="container border my-1 mb-3 py-2">';
                        }
                        ?>
                        
                        


<?php 
if($_SESSION['is_role']=='admin' && isset($_GET['id'])){
    ?>
    <label for="is_email_verified">Email Verification<span class="text-danger">*</span></label>
    <select name="is_email_verified" id="is_email_verified" class="form-select form-control my-1 mb-3 py-2" aria-label="Default select example">
        <?php 
        if ($result['is_email_verified'] == 1 || $_SESSION['is_email_verified'] == 1) {
            echo '<option value="1" selected>Verified</option>';
            echo '<option value="0">Not Verify</option>';
        } else {
            echo '<option value="1">Verify</option>';
            echo '<option value="0" selected>Not Verify</option>';
        }
        ?>
    </select>

    <label for="is_acount_verified">Address Verification<span class="text-danger">*</span></label>
    <select name="is_acount_verified" id="is_acount_verified" class="form-select form-control my-1 mb-3 py-2" aria-label="Default select example">
        <?php 
        if ($result['is_acount_verified'] == 1 || $_SESSION['is_acount_verified'] == 1) {
            echo '<option value="1" selected>Verified</option>';
            echo '<option value="0">Not Verify</option>';
        } else {
            echo '<option value="1">Verified</option>';
            echo '<option value="0" selected>Not Verify</option>';
        }
        ?>
    </select>
    <?php 
} else {
  echo '<p class="text-muted">Account Status: <small>';
  if ($_SESSION['is_acount_verified'] == 1) {
      echo 'Verified';
  } else {
      echo 'Not Verified';
  }
  echo '</small></p>';

  // Modal
  echo '<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
  echo '<div class="modal-dialog">';
  echo '<div class="modal-content">';
  echo '<div class="modal-header">';
  echo '<h1 class="modal-title fs-5" id="exampleModalLabel">ID: ' . $_SESSION['fullname'] . '</h1>';
  echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
  echo '</div>';
  echo '<div class="modal-body">';
  
  // Check if the identification_img is not empty
  if (!empty($_SESSION['identification_img'])) {
      echo '<img src="' . $_SESSION['identification_img'] . '" alt="Logo" class="img-fluid">';
  }

  echo '</div>';
  echo '<div class="modal-footer">';
  
  echo '<form id="updateid" enctype="multipart/form-data" method="post">';
  echo '<input name="file" type="file" class="form-control mb-3 py-2 my-1" id="file" accept="image/*" aria-describedby="inputGroupFileAddon04" aria-label="Upload">';
  echo '<button id="editna" type="button" class="btn btn-success" onclick="submitForm()">Update ID</button>';
  
  echo '</form>';

  echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';


  echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">';
  echo '<i class="fa-solid fa-eye"></i> View  my ID';
  echo '</button>';

}

?>




                  </div>


                          
                        <!-- <div class="alert mt-3" role="alert" id="error-alert" style="display:none;">
                          <span id="alert-message"></span>
                        </div> -->
                        

                        <?php 
                        //echo $_SESSION['is_role'];
                        //echo $_SESSION['id'];
                        ?>
                    <div class="text-start mt-3">
                          
                                      

              <button type="button" class="btn btn-success" onclick="submitAccountForm()">Update Account</button>

                    </div>
            

                    <div class="text-start mt-3">
    <p class="fs-6"><span class="text-danger">*</span> Required Fields</p>
    </div>

                  </form>

                <!-- start -->
                </div>
            <div class="col-md-6 mt-3">
                <!-- start -->
                <form id="password_form" method="post">
                        
                <label>Current Password</label>
                <div class="input-group mb-3">
                    <input type="password" value="<?php echo $_SESSION['password']; ?>" autocomplete="off" name="currentpassword" id="currentpassword" class="form-control my-1 mb-3 py-2" placeholder="Enter new password" disabled />
                </div>

                
                    
               <!-- HTML structure for password and confirm password fields -->
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

<script>
  document.getElementById('password-toggle').addEventListener('click', function() {
    const passwordField = document.getElementById('password');
    passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
  });

  document.getElementById('confirm-password-toggle').addEventListener('click', function() {
    const confirmPasswordField = document.getElementById('confirm_password');
    confirmPasswordField.type = confirmPasswordField.type === 'password' ? 'text' : 'password';
  });
</script>



                       
<!-- 
                        <div class="alert mt-3" role="alert" id="error-alert-pass" style="display:none;">
                          <span id="alert-message-pass"></span>
                        </div> -->

                        <?php 
                        //echo $_SESSION['is_role'];
                        //echo $_SESSION['id'];

                        ?>
                        

                    <div class="text-start mt-3">
                            <button type="submit"  class="btn btn-success">Update password</button>                          
                    </div>


                    <div class="text-start mt-3">
    <p class="fs-6"><span class="text-danger">*</span> Required Fields</p>
    </div>

                  </form>
                <!-- start -->
            </div>

<?php

                }




                ?>

                


            
        
            
        </div>




     
      </div>
      <!-- content end -->




  </div>





<?php 
include 'components/footer.php'

?>



<script>
        function submitForm() {

          console.log('what ?');


          var editnaButton = document.getElementById("editna");
          editnaButton.disabled = true;

          // Get the file input element
          var fileInput = document.getElementById('file');

          // Check if a file has been selected
          if (fileInput.files.length > 0) {
              // Create FormData object
              var formData = new FormData();

              // Append the file to the FormData object
              formData.append('file', fileInput.files[0]);

              // Make an AJAX request using fetch
              fetch('backend/updateID.php', {
                  method: 'POST',
                  body: formData
              })
              .then(response => response.json())
              .then(data => {
                  // Handle the response from the server
                  console.log(data);

                  if(data.success){ // if uploaded
                    Swal.fire({
                    title: 'Success',
                    text: 'ID update successfully',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.reload(true);
                    }
                });

                editnaButton.disabled = false;


                  } else{

                    Swal.fire({
                  title: 'Error',
                  text: 'Sorry, we can’t submit your report right now.',
                  icon: 'error',
                  confirmButtonText: 'Confirm'
              }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.reload(true);
                  }
              });

                  }
       
              })
              .catch(error => {
                  console.error('Error:', error);
              });
          } else {
              //alert('Please select a file before submitting.');
              Swal.fire({
                  title: 'No File Selected',
                  text: 'Please select a file before submitting.',
                  icon: 'info',
                  confirmButtonText: 'Ok'
              })

              editnaButton.disabled = false;

          }
        }
    </script>

    

<script> 


$("#password_form").submit(function(event) {
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


    remove_alert_bg_pass();
    $('#error-alert-pass').addClass("bg-primary");
    $('#alert-message-pass').addClass("text-dark");
    $('#error-alert-pass').fadeIn();
    $('#alert-message-pass').text("Please wait...");

    
    
    $.ajax({
        url: "backend/account.php",
        data: $(this).serialize(), // Changed this line
        type: "POST",
        dataType: 'json',
        success: function(result) {
            console.log(result.status + " " + result.message);
            remove_alert_bg_pass()
            if (result.status === 1) { // Changed = to ===
              // remove_alert_bg_pass();
              //   $('#error-alert-pass').addClass("bg-success");
              //   $('#alert-message-pass').addClass("text-white");
              //   $('#alert-message-pass').text(result.message); //1 update success
              //   setTimeout(function() { $('#error-alert-pass').fadeOut() }, 9999999999);
              Swal.fire({
            title: 'Success',
            text: 'Password Change Successfully',
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
              window.location.reload(true);
            }
        });

            } else {
              // remove_alert_bg_pass();
              //   $('#error-alert-pass').addClass("bg-danger");
              //   $('#alert-message-pass').addClass("text-white");
              //   $('#alert-message-pass').text(result.message); // 0 no action
              //   setTimeout(function() { $('#error-alert-pass').fadeOut() }, 999999);
              //   $("#password_form")[0].reset();
                    Swal.fire({
                  title: 'Error',
                  text: 'No Action',
                  icon: 'error',
                  confirmButtonText: 'Ok'
              }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.reload(true);
                  }
              });
            }
        }
    });

    console.log('clicked');
});



function remove_alert_bg_pass(){

$('#error-alert-pass').removeClass("bg-warning");

$('#error-alert-pass').removeClass("bg-success");

$('#error-alert-pass').removeClass("bg-primary");

$('#error-alert-pass').removeClass("bg-danger");

}	



function submitAccountForm() {
    event.preventDefault();

    console.log($("#account_form").serialize());

    var hasInvalidField = $('.is-invalid').length > 0;

    if (hasInvalidField) {
        Swal.fire({
            title: 'Info',
            text: 'Please fill out all required fields correctly.',
            icon: 'info',
            confirmButtonText: 'Confrim'
        });
        return;
    }

    remove_alert_bg();
    $('#error-alert').addClass("bg-primary");
    $('#alert-message').addClass("text-dark");
    $('#error-alert').fadeIn();
    $('#alert-message').text("Please wait...");

    $.ajax({
        url: "backend/account.php",
        data: $("#account_form").serialize(),
        type: "POST",
        dataType: 'json',
        success: function (result) {
            console.log(result.status + " " + result.message);
            remove_alert_bg();
            if (result.status === 1) {
                Swal.fire({
                    title: 'Profile Updated Successfully!',
                    text: 'Your account has been successfully updated.',
                    icon: 'success',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload(true);
                    }
                });
            } else {
                Swal.fire({
                    title: 'error',
                    text: 'No Action.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload(true);
                    }
                });
            }
        }
    });

    console.log('clicked');
}



    






function remove_alert_bg(){

  $('#error-alert').removeClass("bg-warning");

	$('#error-alert').removeClass("bg-success");

	$('#error-alert').removeClass("bg-primary");

	$('#error-alert').removeClass("bg-danger");

}	





</script>  


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
