<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Update Event Pet</title>

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

    
<script src="js/updateEventValidation.js"></script>

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


        <?php
          try {

              $event_id = $_GET['event_id'];

              $stmt = $conn->prepare("SELECT * FROM `events` WHERE `event_id` = $event_id");
              $stmt->execute();
              
              // Fetch all rows as associative arrays
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              
              foreach ($result as $row) {
                  // Access columns like $row['column_name']
                  //echo $row['pet_id'] . " " . $row['pet_name'] . "<br>";
              }
          }
          catch(PDOException $e) {
              echo "Error: " . $e->getMessage();
          }
          ?>



        <div class="container text-center">
            <img id="logo" src="<?php echo $row['event_img'] ?>" alt="Logo" width="150" height="150" class="mt-3 d-inline-block align-text-top rounded-circle">

        </div>
        

                  <!-- start -->
                  <form id="update_event_form" method='post' enctype=multipart/form-data>
                  <label for="event_name">Event name<span class="text-danger">*<span></label>

                  <input value="<?php echo $row['event_id'] ?>" type="text" name="event_id" id="event_id" class=" d-none form-control my-1 mb-3 py-2" placeholder="Enter Event Name" required/>
						


						<input value="<?php echo $row['event_name'] ?>" type="text" name="event_name" id="event_name" class="form-control my-1 mb-3 py-2" placeholder="Enter Event Name" required/>
						
                        <label for="event_desc">Event description<span class="text-danger">*<span></label>
						<input value="<?php echo $row['event_desc'] ?>" type="text" name="event_desc" id="event_desc" class="form-control my-1 mb-3 py-2" placeholder="Enter Event Desciption" required/>
						
						
		
						
						<label for="event_date">Event date<span class="text-danger">*<span></label>
						<input  value="<?php echo $row['event_date'] ?>" type="date" name="event_date" id="event_date" class="form-control my-1 mb-3 py-2" placeholder="Select event date" required/>




                        <label for="event_time">Event Time<span class="text-danger">*<span></label>
    <select name="event_time" id="event_time" class="form-select form-control my-1 mb-3 py-2" aria-label="Default select example">
        <option value="" disabled>Select time</option>
        <option value="12:00 AM" <?php echo ($row['event_time'] == '12:00 AM') ? 'selected' : ''; ?>>12:00 AM</option>
        <option value="01:00 AM" <?php echo ($row['event_time'] == '01:00 AM') ? 'selected' : ''; ?>>01:00 AM</option>
        <option value="02:00 AM" <?php echo ($row['event_time'] == '02:00 AM') ? 'selected' : ''; ?>>02:00 AM</option>
        <option value="03:00 AM" <?php echo ($row['event_time'] == '03:00 AM') ? 'selected' : ''; ?>>03:00 AM</option>
        <option value="04:00 AM" <?php echo ($row['event_time'] == '04:00 AM') ? 'selected' : ''; ?>>04:00 AM</option>
        <option value="05:00 AM" <?php echo ($row['event_time'] == '05:00 AM') ? 'selected' : ''; ?>>05:00 AM</option>
        <option value="06:00 AM" <?php echo ($row['event_time'] == '06:00 AM') ? 'selected' : ''; ?>>06:00 AM</option>
        <option value="07:00 AM" <?php echo ($row['event_time'] == '07:00 AM') ? 'selected' : ''; ?>>07:00 AM</option>
        <option value="08:00 AM" <?php echo ($row['event_time'] == '08:00 AM') ? 'selected' : ''; ?>>08:00 AM</option>
        <option value="09:00 AM" <?php echo ($row['event_time'] == '09:00 AM') ? 'selected' : ''; ?>>09:00 AM</option>
        <option value="10:00 AM" <?php echo ($row['event_time'] == '10:00 AM') ? 'selected' : ''; ?>>10:00 AM</option>
        <option value="11:00 AM" <?php echo ($row['event_time'] == '11:00 AM') ? 'selected' : ''; ?>>11:00 AM</option>
        <option value="12:00 PM" <?php echo ($row['event_time'] == '12:00 PM') ? 'selected' : ''; ?>>12:00 PM</option>
        <option value="01:00 PM" <?php echo ($row['event_time'] == '01:00 PM') ? 'selected' : ''; ?>>01:00 PM</option>
        <option value="02:00 PM" <?php echo ($row['event_time'] == '02:00 PM') ? 'selected' : ''; ?>>02:00 PM</option>
        <option value="03:00 PM" <?php echo ($row['event_time'] == '03:00 PM') ? 'selected' : ''; ?>>03:00 PM</option>
        <option value="04:00 PM" <?php echo ($row['event_time'] == '04:00 PM') ? 'selected' : ''; ?>>04:00 PM</option>
        <option value="05:00 PM" <?php echo ($row['event_time'] == '05:00 PM') ? 'selected' : ''; ?>>05:00 PM</option>
        <option value="06:00 PM" <?php echo ($row['event_time'] == '06:00 PM') ? 'selected' : ''; ?>>06:00 PM</option>
        <option value="07:00 PM" <?php echo ($row['event_time'] == '07:00 PM') ? 'selected' : ''; ?>>07:00 PM</option>
        <option value="08:00 PM" <?php echo ($row['event_time'] == '08:00 PM') ? 'selected' : ''; ?>>08:00 PM</option>
        <option value="09:00 PM" <?php echo ($row['event_time'] == '09:00 PM') ? 'selected' : ''; ?>>09:00 PM</option>
        <option value="10:00 PM" <?php echo ($row['event_time'] == '10:00 PM') ? 'selected' : ''; ?>>10:00 PM</option>
        <option value="11:00 PM" <?php echo ($row['event_time'] == '11:00 PM') ? 'selected' : ''; ?>>11:00 PM</option>
    </select>






            <label for="event_location">Event location<span class="text-danger">*<span></label>
            <input value="<?php echo $row['event_location'] ?>" type="text" name="event_location" id="event_location" class="form-control my-1 mb-3 py-2" placeholder="Enter event location" required/>




    <label>Event Image<span class="text-danger">*<span></label>
    <input name="event_image" type="file" class="form-control mb-3 py-2 my-1" id="event_image" accept="image/*" aria-describedby="inputGroupFileAddon04" 
    aria-label="Upload" >
  
    <img id="preview" src="#" alt="" width="150" class="my-1 mb-3 py-2" height="150" style="display:none;">


    <!-- <div class="alert mt-3" role="alert" id="error-alert" style="display:none;">
        <span id="alert-message"></span>
    </div> -->

    <div class="text-start mt-3">
        <button type="submit" class="btn btn-success">Update Event</button>
    </div>

    <div class="text-start mt-3">
    <p class="fs-6"><span class="text-danger">*</span> Required Fields</p>
    </div>


                  </form>
                <!-- start -->

        




     
      </div>
      <!-- content end -->




  </div>


<?php 
include 'components/footer.php'

?>



<script>
$(document).ready(function() {
    $('#update_event_form').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        console.log(formData);

        $.ajax({
            url: 'backend/update-event.php', // Replace with the URL to your upload script
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response.message);

                if (response.status === 1) {
                    Swal.fire({
                        title: 'Update event',
                        text: 'Event update successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(true);
                        }
                    });
                } else {
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
                console.log(error.statusText);
            }
        });
    });
});
</script>






<script> 
document.getElementById('event_image').onchange = evt => {

  document.getElementById('preview').style.display = 'block';
  const [file] = evt.target.files;
  if (file) {
    const previewImage = document.getElementById('preview');
    previewImage.src = URL.createObjectURL(file);
  }
}
</script>





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
