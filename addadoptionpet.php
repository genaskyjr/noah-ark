<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Add Pet for Adoption</title>

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

    <script src="js/addadoptionpetValidation.js"></script>
    

  </head>
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

      
                <!-- start -->
                <form id="add_adoption_form" enctype="multipart/form-data" method="post">
                  

                <label for="adoption_nickname">Pet Nickname<span class="text-danger">*<span></label>
    <input type="text" name="adoption_nickname" id="adoption_nickname" class="form-control my-1 mb-3 py-2" placeholder="Enter Pet’s Nickname" required/>


                        
                        <label>Sex<span class="text-danger">*<span></label>
                        <select required id="adoption_gender" name="adoption_gender"class="form-select form-control my-1 mb-3 py-2" aria-label="Default select example ">
                          <option selected disabled>Select Sex</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>

                      
                        <label>Date of Rescue<span class="text-danger">*<span></label>
                        <input type="date" name="adoption_recued" id="adoption_recued" class="form-control my-1 mb-3 py-2" placeholder="Enter your pet birthday" required max="<?php echo date('Y-m-d'); ?>" />

                        
                
                        <label>Type<span class="text-danger">*<span></label>
                        <select id="adoption_type" name="adoption_type" class="form-select form-control my-1 mb-3 py-2" aria-label="Default select example">
                          <option selected disabled>Select Type</option>
                          <option value="Dog">Dog</option>
                          <option value="Cat">Cat</option>
                        </select>


    <label>Pet Profile Picture<span class="text-danger">*<span></label>
    <input name="adoption_image" type="file" class="form-control mb-3 py-2 my-1" id="adoption_image" accept="image/*" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
  
    <img id="preview" src="#" alt="" width="150" class="my-1 mb-3 py-2" height="150" style="display:none;">


    <!-- <div class="alert mt-3" role="alert" id="error-alert" style="display:none;">
        <span id="alert-message"></span>
    </div> -->

    <div class="text-start mt-3">
        <button type="submit" class="btn btn-success">Add Pet for Adoption</button>
    </div>

    <div class="text-start mt-3">
    <p class="fs-6"><span class="text-danger">*</span> Required Fields</p>
    </div>

                  </form>
                <!-- start -->
           
     

                </div>

  </div>


<?php 
include 'components/footer.php'

?>





<script>
        $(document).ready(function() {
            $('#add_adoption_form').on('submit', function(e) {
            
                e.preventDefault();

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


                var formData = new FormData(this);

                $.ajax({
                    url: 'backend/upload-addadoptionpet.php', // Replace with the URL to your upload script
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log('File uploaded successfully!');                   
                        submitPetForm();
                        console.log('called submit!');
                    },
                    error: function(error) {
                      console.log('Error uploading file: ' + error.statusText);
                    }
                });
            });
        });
    </script>


<script> 
document.getElementById('adoption_image').addEventListener('change', function(evt) {
  const [file] = evt.target.files;
  const preview = document.getElementById('preview');

  if (file) {
    preview.style.display = 'block';
    preview.src = URL.createObjectURL(file);
  }
});
</script>



<script>
function submitPetForm() {

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


        
    remove_alert_bg();
    $('#error-alert').addClass("bg-primary");
    $('#alert-message').addClass("text-dark");
    $('#error-alert').fadeIn();
    $('#alert-message').text("Please wait...");

    $.ajax({
        url: "backend/addadoptionpet.php",
        data: $("#add_adoption_form").serialize(), // Changed this line
        type: "POST",
        dataType: 'json',
        success: function(result) {
            console.log(result.status + " " + result.message);
            remove_alert_bg();
            if (result.status === 1) {
                // remove_alert_bg();
                // $('#error-alert').addClass("bg-success");
                // $('#alert-message').addClass("text-white");
                // $('#alert-message').text(result.message);
                // setTimeout(function() { $('#error-alert').fadeOut() }, 4000);
                // $("#add_adoption_form")[0].reset();
                // document.getElementById('preview').style.display = 'none';

                Swal.fire({
            title: 'Success',
            text: 'Adoption Pet Added Successfully',
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
              window.location.reload(true);
            }
        });

            } else {
              //   remove_alert_bg();
              //   $('#error-alert').addClass("bg-danger");
              //   $('#alert-message').addClass("text-white");
              //   $('#alert-message').text(result.message);
              //   setTimeout(function() { $('#error-alert').fadeOut() }, 4000);
              //  // $("#fileUploadForm")[0].reset();
              Swal.fire({
            title: 'Error',
            text: 'No Action',
            icon: 'error',
            confirmButtonText: 'Ok'
        });
            }
        },
        error: function(error) {
                      console.log('Error uploading file: ' + error.statusText);
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


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
