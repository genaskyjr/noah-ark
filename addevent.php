<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Add Event</title>

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

    

    <script src="js/addeventValidation.js"></script>
    

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

      
       <form id="add_event_form" enctype="multipart/form-data" method="post">
                  
                        
            <label for="event_name">Event Name<span class="text-danger">*<span></label>
						<input type="text" name="event_name" id="event_name" class="form-control my-1 mb-3 py-2" placeholder="Enter Event Name" required/>
						
            <label for="event_desc">Event Description<span class="text-danger">*<span></label>
						<input type="text" name="event_desc" id="event_desc" class="form-control my-1 mb-3 py-2" placeholder="Enter Event Desciption" required/>
						
						
		
						
						<label for="event_date">Date of Event<span class="text-danger">*<span></label>
						<input type="date" name="event_date" id="event_date" class="form-control my-1 mb-3 py-2" placeholder="Select date" required min="<?php echo date('Y-m-d'); ?>" />



            <label for="event_time">Time of the Event<span class="text-danger">*<span></label>
            <select id="event_time" name="event_time" class="form-select form-control my-1 mb-3 py-2" aria-label="Default select example">
              <option selected disabled>Select Time</option>
              <option value="12:00 AM">12:00 AM</option>
              <option value="01:00 AM">01:00 AM</option>
              <option value="02:00 AM">02:00 AM</option>
              <option value="03:00 AM">03:00 AM</option>
              <option value="04:00 AM">04:00 AM</option>
              <option value="05:00 AM">05:00 AM</option>
              <option value="06:00 AM">06:00 AM</option>
              <option value="07:00 AM">07:00 AM</option>
              <option value="08:00 AM">08:00 AM</option>
              <option value="09:00 AM">09:00 AM</option>
              <option value="10:00 AM">10:00 AM</option>
              <option value="11:00 AM">11:00 AM</option>
              <option value="12:00 PM">12:00 PM</option>
              <option value="01:00 PM">01:00 PM</option>
              <option value="02:00 PM">02:00 PM</option>
              <option value="03:00 PM">03:00 PM</option>
              <option value="04:00 PM">04:00 PM</option>
              <option value="05:00 PM">05:00 PM</option>
              <option value="06:00 PM">06:00 PM</option>
              <option value="07:00 PM">07:00 PM</option>
              <option value="08:00 PM">08:00 PM</option>
              <option value="09:00 PM">09:00 PM</option>
              <option value="10:00 PM">10:00 PM</option>
              <option value="11:00 PM">11:00 PM</option>
            </select>






            <label for="event_location">Location of Event<span class="text-danger">*<span></label>
            <input type="text" name="event_location" id="event_location" class="form-control my-1 mb-3 py-2" placeholder="Enter event location" required/>




    <label>Choose Event Image<span class="text-danger">*<span></label>
    <input name="event_image" type="file" class="form-control mb-3 py-2 my-1" id="event_image" accept="image/*" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
  
    <img id="preview" src="#" alt="" width="150" class="my-1 mb-3 py-2" height="150" style="display:none;">


    <!-- <div class="alert mt-3" role="alert" id="error-alert" style="display:none;">
        <span id="alert-message"></span>
    </div> -->

    <div class="text-start mt-3">
        <button type="submit" class="btn btn-success">Add Event</button>
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
            $('#add_event_form').on('submit', function(e) {
            
                e.preventDefault();


                var formData = new FormData(this);

                console.log(formData);

                $.ajax({
                    url: 'backend/add-event.php', // Replace with the URL to your upload script
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);  
                        if(response.status===1){
                          Swal.fire({
                              title: 'Add Event',
                              text: 'Added event Successfully',
                              icon: 'success',
                              confirmButtonText: 'Ok'
                          }).then((result) => {
                              if (result.isConfirmed) {
                                window.location.reload(true);
                              }
                          });
                        }else{
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
                        

                    },
                    error: function(error) {
                      console.log('Error uploading file: ' + error.statusText);
                    }
                });
            });
        });
    </script>


<script> 
document.getElementById('event_image').addEventListener('change', function(evt) {
  const [file] = evt.target.files;
  const preview = document.getElementById('preview');

  if (file) {
    preview.style.display = 'block';
    preview.src = URL.createObjectURL(file);
  }
});
</script>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
