<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Update Pet</title>

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

    <script src="js/updatePetValidation.js"></script>
    <script>

document.addEventListener('DOMContentLoaded', function() {
    var lastVaccineInput = document.getElementById('last_vaccine');
    var nextVaccineInput = document.getElementById('next_vaccine');

    lastVaccineInput.addEventListener('change', function() {
        var lastVaccineDate = new Date(lastVaccineInput.value);
        var nextVaccineDate = new Date(lastVaccineDate.getFullYear() + 1, lastVaccineDate.getMonth(), lastVaccineDate.getDate());

        var formattedDate = nextVaccineDate.toISOString().split('T')[0]; // Format as 'yyyy-mm-dd'

        nextVaccineInput.value = formattedDate;

    });
});



$(document).ready(function(){
    // Set max date for last_vaccine to today's date
    var today = new Date().toISOString().split('T')[0];
    $('#last_vaccine').attr('max', today);
    $('#next_vaccine').prop('readonly', true); // Make next_vaccine uneditable by default

    $('#pet_birthday').on('change', function() {
        var petBirthdayValue = new Date($(this).val());
        var maxDate = new Date();

        if (petBirthdayValue <= maxDate) {
            $('#last_vaccine').attr('min', petBirthdayValue.toISOString().split('T')[0]);
        } else {
            $('#last_vaccine').attr('min', today);
        }
    });

    $('#pet_birthday').attr('max', today); // Restrict pet birth date to today

    $('#pet_birthday').on('input', function() {
        var selectedDate = new Date($(this).val());
        var today = new Date();

        if (selectedDate <= today) {
            // Valid date (today or in the past)
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
            console.log('valid');
        } else {
            // Remove the invalid class, but do not add is-invalid
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            console.log('invalid');
        }
    });

    $('#last_vaccine').on('change', function() {
        var selectedDate = new Date($(this).val());
        var nextVaccineDate = new Date(selectedDate);
        nextVaccineDate.setFullYear(nextVaccineDate.getFullYear() + 1);
        $('#next_vaccine').val(nextVaccineDate.toISOString().split('T')[0]);
    });

    // Rest of your validations...
});



    </script>

    
  </head>
  <body>
<script src="js/zoom.js"></script>


<?php 
  include 'components/nav.php';
  include 'components/navbar.php';
?>


  
<style>
.modal-backdrop {
     background-color: transparent;
}
</style>

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Added 'modal-lg' class for larger size -->
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Camera</h1>
        <button onclick="closeSnapshot()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  
	  
        <div class="embed-responsive embed-responsive-16by9"> <!-- Added 'embed-responsive' class for flexible video container -->
          <video id="video" class="embed-responsive-item container" autoplay></video> <!-- Added 'embed-responsive-item' class for video -->
        </div>
        <canvas id="canvas" class="container" style="display:none "></canvas>
		
		
      </div>
      <div class="modal-footer">
		<button onclick="takeSnapshot()" id="snapshotButton" class="btn btn-success">Take Snapshot</button> <!-- Added Bootstrap classes for styling -->
   
        <button onclick="saveSnapshot()" id="saveButton" type="button" class="btn btn-primary" disabled data-bs-dismiss="modal">Save</button>
		
		
		<button onclick="closeSnapshot()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




      
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

              $id = $_GET['pet_id'];

              $stmt = $conn->prepare("SELECT * FROM `pets` WHERE `pet_id` = $id");
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
            <img id="logo" src="<?php echo $row['pet_img']  ?>" alt="Logo" width="150" height="150" class="mt-3 d-inline-block align-text-top rounded-circle">

        </div>
        

                  <!-- start -->
                  <form id="fileUploadForm" method='post'>





                  <label style="display:none;" >Pet’s ID</label>
                  <input style="display:none;" type="text" value="<?php echo $row['pet_id']  ?>" name="pet_id" id="pet_id" class="form-control my-1 mb-3 py-2" placeholder="Enter Pet’s Name"/>
                        
                  <label style="display:none;">Pet’s img</label>
                  <input style="display:none;" type="text" value="<?php echo $row['pet_img']; ?>" name="pet_img" id="pet_img" class="form-control my-1 mb-3 py-2" placeholder="Enter Pet’s Name"/>



<p class="d-inline-flex gap-1">

</p>


<Br>
<?php

if (isset($_SESSION['is_role']) && $_SESSION['is_role'] == 'admin') {


  // echo '<p class="fs-6">1-11-2023 new pet owner Bea donasco (Current owner)</p>';
  // echo '<p class="fs-6">2-10-2022 new pet owner Maan isabela</p>';
  // echo '<p class="fs-6">3-9-2021 pet owner Genasky</p>';

  // echo $_GET['pet_id'];

  $pet_id = $_GET['pet_id'];


  $stmt = $conn->prepare("SELECT `id`, `pet_id`, `old_owner`, `new_owner`, `date_change` FROM `change_owner` WHERE `pet_id` = :pet_id");
          $stmt->bindParam(':pet_id', $pet_id, PDO::PARAM_INT);
          $stmt->execute();
          
          $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

          //echo $stmt->rowCount() . 'count';

          

          echo '<div class="collapse" id="collapseExample">';
          echo '<div class="card card-body">';

          // if( $stmt->rowCount() == 1){
          //   echo 'dapat wala';
          // }

          
          
          if ($result1) {
            $counter = 0;
            foreach ($result1 as $row1) {
              $counter++;
            //echo $counter;


 
            $date_change = new DateTime($row1['date_change']);
            // Format date and time
            $date_change_formatted = $date_change->format('n-j-Y');


            // id to full name new
            $sql = "SELECT u.fullname
            FROM users u
            JOIN pets p ON u.id = p.pet_owner
            JOIN change_owner c ON p.pet_id = c.pet_id
            WHERE u.id = :pet_owner
            ORDER BY c.date_change DESC
            LIMIT 1";
            $pet_owner_id = $row1['new_owner']; 
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pet_owner', $pet_owner_id, PDO::PARAM_INT);
            $stmt->execute();
            // Fetch the result
            $ownerResult = $stmt->fetch(PDO::FETCH_ASSOC);
           

            // Output in the desired format
            echo '<p class="fs-6 mb-2" id="haha">' . $date_change_formatted . ' to ' . $ownerResult['fullname'] . '</p>';
            
      

            if($counter==1){
               
              echo '
  <script>
      var hahaElement = document.getElementById("haha");
      if (hahaElement) {
          hahaElement.textContent = "' . $date_change_formatted . ' ' . $ownerResult['fullname'] . ' added this pet";
      }
  </script>';

            }
            
            
            }

            
        }









  echo '</div>';
  echo '</div>';

  // Only show the label for admins
  echo '<label style="display:none;">Pet’s current owner id</label>';

  echo '<input style="display:none;" type="text" value="' . $row['pet_owner'] . '" name="pet_owner_current" id="pet_owner_current" class="form-control my-1 mb-3 py-2" placeholder="" required/>';
    

    $currentOwnerId = $row['pet_owner'];

    include_once 'backend/dbconnect.php';
    echo '<label class="my-1 mb-3 py-2">Pet’s Owner<span class="text-danger">* </span></label>';

    echo '<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">';
    echo 'History';
    echo '</button>';


    echo '<select name="pet_owner" class="form-select my-1 mb-3 py-2" aria-label="Default select example">';

    $sql = "SELECT `id`, `fullname` FROM `users` WHERE is_role != 'admin'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Find the current owner's information
    $currentOwner = null;
    foreach ($result as $userRow) {
        if ($userRow['id'] == $currentOwnerId) {
            $currentOwner = $userRow;
            break;
        }
    }

    // Output the current owner's option first
    if ($currentOwner) {
        $selected = ($currentOwner['id'] == $currentOwnerId) ? 'selected' : '';
        echo "<option value='" . $currentOwner['id'] . "' $selected>" . $currentOwner['fullname'] . "</option>";
    }

    // Output the other options
    foreach ($result as $userRow) {
        if ($userRow['id'] != $currentOwnerId) {
            $selected = ($userRow['id'] == $currentOwnerId) ? 'selected' : '';
            echo "<option value='" . $userRow['id'] . "' $selected>" . $userRow['fullname'] ."</option>";
        }
    }

    echo '</select>';
}
?>




<label>Pet’s Name<span class="text-danger">*</span></label>
<input id="pet_name" type="text" value="<?php echo $row['pet_name']; ?>" name="pet_name" class="form-control my-1 mb-3 py-2" placeholder="Enter Pet’s Name" required/>

                        
                        <label>Sex<span class="text-danger">*<span></label>
                        <select id="pet_gender" class="form-select form-control my-1 mb-3 py-2" aria-label="Default select example" name="pet_gender">
                          <?php
                          $genderOptions = ['Male', 'Female']; // Define the available gender options

                          foreach ($genderOptions as $option) {
                            $isSelected = ($option == $row['pet_gender']) ? 'selected' : ''; // Check if option matches pet's gender
                            echo "<option value='$option' $isSelected>$option</option>";
                          }
                          ?>
                        </select>


                      
   <label>Birthday<span class="text-danger">*<span></label>
   <input value="<?php echo $row['pet_birthday']; ?>" id="pet_birthday" type="date" name="pet_birthday" class="form-control my-1 mb-3 py-2" placeholder="Enter your pet's birthday" required max="<?php echo date('Y-m-d'); ?>"/>

                        
                

                        <label>Type<span class="text-danger">*<span></label>
                        <select id="pet_type" class="form-select form-control my-1 mb-3 py-2" aria-label="Default select example" name="pet_type">
                            <?php
                            $genderOptions = ['Dog', 'Cat']; // Define the available gender options

                            foreach ($genderOptions as $option) {
                                $isSelected = ($option == $row['pet_type']) ? 'selected' : ''; // Check if option matches pet's gender
                                echo "<option value='$option' $isSelected>$option</option>";
                            }
                            ?>
                        </select>


<label for="last_vaccine">Last vaccine<span class="text-danger">*<span></label>
    <input id="last_vaccine" value="<?php echo $row['pet_last_vaccine']; ?>" type="date" name="pet_last_vaccine" id="last_vaccine" class="form-control my-1 mb-3 py-2" placeholder="Select Pet’s last vaccine" required/>


    <label for="next_vaccine">Next vaccine<span class="text-danger">*<span></label>
    <input readyonly id="next_vaccine" value="<?php echo $row['pet_next_vaccine']; ?>"  type="date" name="pet_next_vaccine" id="next_vaccine" class="bg-light form-control my-1 mb-3 py-2" placeholder="Select Pet’s next vaccine" required/>



                             <label for="file">Insert Pet's Picture<span class="text-danger"><span></label>

                             <button onclick="setupCamera()" type="button" class="btn btn-primary my-1 mb-3 py-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Open Camera
</button>


<input name="file" type="file" class="form-control mb-3 py-2 my-1" id="file" accept="image/*" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>

<script>
    // Get the file input element by its ID
    const fileInput = document.getElementById('file');

    // Disable the 'required' attribute
    fileInput.removeAttribute('required');
</script>
   

    <img id="blah" src="#" alt="Preview" width="150" class="my-1 mb-3 py-2" height="150" style="display:none;">

    <!-- <div class="alert mt-3" role="alert" id="error-alert" style="display:none;">
        <span id="alert-message"></span>
    </div> -->


                        <div class="text-left mt-3">
                            <button type="submit" class="btn btn-success" id="update">Update Information</button>
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



let videoStream; // Variable to hold the video stream



function stopCamera() {
    if (videoStream) {
        videoStream.getTracks().forEach(track => track.stop());
        video.srcObject = null; // Clear the video source object
    }
}



function closeSnapshot() {
	stopCamera();
	var mySnapImage = document.getElementById('mySnap');
    mySnapImage.remove();
	

	
}



  const video = document.getElementById('video');
  const canvas = document.getElementById('canvas');
  const ctx = canvas.getContext('2d');


 
 




function takeSnapshot() {
	
	//eanbled save button
	var saveButton = document.getElementById('saveButton');
    saveButton.disabled = false;
	
	
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    var snapshot = canvas.toDataURL('image/png');

    // Display the snapshot in the same window, replacing the video
    video.style.display = 'none'; // Hide the video element
	
	//display the canvas
	canvas.style.display = 'block';

    var img = document.createElement('img');
	img.id = 'mySnap';
    img.src = snapshot;
    document.body.appendChild(img);

    // Change the button text and onclick function to "Retake"
    var button = document.getElementById('snapshotButton');
    button.textContent = 'Retake';
	
    button.onclick = function() {
        video.style.display = 'block'; // Show the video element again
        img.remove(); // Remove the snapshot from the DOM
		canvas.style.display = 'none';
        button.textContent = 'Take Snapshot'; // Change button text back to "Take Snapshot"	
        button.onclick = takeSnapshot; // Restore original onclick function
		var saveButton = document.getElementById('saveButton');
		saveButton.disabled = true;
		

    };
}


function saveSnapshot() {
	
    var img = document.getElementById('mySnap');
    if (img) {
        var canvas = document.createElement('canvas');
        canvas.width = img.width;
        canvas.height = img.height;
        var ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

        canvas.toBlob(function(blob) {
            var url = URL.createObjectURL(blob);

            var fileInput = document.getElementById('file');
            fileInput.value = ''; // Reset the input (clear any previously selected file)
            
            var file = new File([blob], 'snapshot.png', { type: 'image/png' }); // Create a new file object
            var files = new DataTransfer(); // Create a data transfer object
            files.items.add(file); // Add the file to the data transfer object
            fileInput.files = files.files; // Assign the files to the input

            // Trigger the change event on the input (to update its value)
            var event = new Event('change');
            fileInput.dispatchEvent(event);
        });
    }
	
	closeSnapshot();
	stopCamera();
	
	
}



async function setupCamera() {
	

	
	
    try {
        const videoStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
        const videoElement = document.getElementById('video'); // Assuming you have a video element with the ID 'video'
        videoElement.srcObject = videoStream;
		
    } catch (error) {
        alert('Error accessing the back camera:', error);
    }
}



</script>



<script>
        $(document).ready(function() {
            $('#fileUploadForm').on('submit', function(e) {

              document.getElementById("update").disabled = true;


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
                console.log(formData);

                $.ajax({
                    url: 'backend/update-addpet.php', // Replace with the URL to your upload script
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




function submitPetForm() {


  Swal.fire({
  title: 'Updating Information, Please Wait!',
  icon: 'info',
  showConfirmButton: false
});

    remove_alert_bg();
    $('#error-alert').addClass("bg-primary");
    $('#alert-message').addClass("text-dark");
    $('#error-alert').fadeIn();
    $('#alert-message').text("Please wait...");

    console.log($("#fileUploadForm").serialize());

    $.ajax({



      
        url: "backend/editpet.php",
        data: $("#fileUploadForm").serialize(), // Changed this line
        type: "POST",
        dataType: 'json',
        success: function(result) {
            console.log(result.status + " " + result.message);
            remove_alert_bg();
            if (result.status === 1) {
//                 remove_alert_bg();
//                 $('#error-alert').addClass("bg-success");
//                 $('#alert-message').addClass("text-white");
//                 $('#alert-message').text(result.message);
//                 setTimeout(function() { $('#error-alert').fadeOut() }, 4000);
//                 $("#fileUploadForm")[0].reset();
//                 document.getElementById('blah').style.display = 'none';

//                 setTimeout(function() {
//     window.location.reload(true);
// }, 1000); // Reload after 1 second (1000 milliseconds)

Swal.fire({
            title: 'Success',
            text: 'Pet Updated Successfully',
            icon: 'success',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
              window.location.reload(true);
            }
        });

        document.getElementById("update").disabled = false;

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
        }).then((result) => {
            if (result.isConfirmed) {
              window.location.reload(true);
            }
        });

        document.getElementById("update").disabled = false;
            }

        },
        error: function(error) {
                      console.log('Error uploading file: ' + error.statusText);
                      document.getElementById("update").disabled = false;
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



<script> 
document.getElementById('file').onchange = evt => {
  document.getElementById('blah').style.display = 'block';

  const [file] = evt.target.files;
  if (file) {
    const blah = document.getElementById('blah');
    blah.src = URL.createObjectURL(file);
  }
}
</script>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
