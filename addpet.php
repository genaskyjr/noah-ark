<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Add pet</title>

    <!--bootstrap 5.2.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!--font -->
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-55" rel="stylesheet">
    <!--homepage css -->
    <link rel="stylesheet" href="css/custom.css">
    <!--icon -->
    <script src="https://kit.fontawesome.com/c3cf7a82ce.js" crossorigin="anonymous"></script>
    <!--jquery cdn -->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    
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

        // Check if the last vaccine date is valid and add a check symbol
        var lastVaccineValidity = new Date($(this).val());
        var isValid = lastVaccineValidity <= today;

        if (isValid) {
            // Add a checkmark symbol after the input field
            $('#last_vaccine').addClass('is-valid');
        } else {
            // Add a different symbol or indicator for an invalid date
            $('#last_vaccine').removeClass('is-valid');
        }
    });

    // Rest of your validations...
});

















    </script>


  </head>
  <body>


  
  <script src="js/addPetValidation.js"></script>
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


   

      
                <!-- start -->
<form id="fileUploadForm" enctype="multipart/form-data" method="post">
  
    <label for="petname">Name of Pet<span class="text-danger">*<span></label>
    <input type="text" name="pet_name" id="petname" class="form-control my-1 mb-3 py-2" placeholder="Enter Pet’s Name" required/>

    <label for="pet_gender">Sex<span class="text-danger">*<span></label>
    <select class="form-select form-control my-1 mb-3 py-2" id="pet_gender" name="pet_gender" aria-label="Default select example" required>
        <option selected disabled>Select Sex</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>

    <label for="pet_birthday">Birthday<span class="text-danger">*<span></label>
    <input type="date" name="pet_birthday" id="pet_birthday" class="form-control my-1 mb-3 py-2" placeholder="Select your pet's birthday" required/>





    <label for="pet_type"> Type<span class="text-danger">*<span></label>
    <select class="form-select form-control my-1 mb-3 py-2" id="pet_type" name="pet_type" aria-label="Default select example" required>
        <option selected disabled>Select Type</option>
        <option value="Dog">Dog</option>
        <option value="Cat">Cat</option>
    </select>


    <!-- <label for="pet_type">Pet’s Color</label>
    <select class="form-select form-control my-1 mb-3 py-2" id="pet_type" name="pet_type" aria-label="Default select example" required>
        <option selected disabled>Select Color</option>
        <option value="Dog">White / near White</option>
        <option value="Cat">Black / near Black</option>
        <option value="Cat">Brown / near Brown</option>
    </select> -->

  


    <label for="last_vaccine">Last Vaccine</label>
    <input type="date" name="pet_last_vaccine" id="last_vaccine" class="form-control my-1 mb-3 py-2" placeholder="Select Pet’s last vaccine" />


    <label for="next_vaccine">Next Vaccine</label>
    <input readonly type="date" name="pet_next_vaccine" id="next_vaccine" class="bg-light form-control my-1 mb-3 py-2" placeholder="Select Pet’s next vaccine" />



    <label for="file">Insert Pet's Picture<span class="text-danger">*</span></label>

    						<!-- Button trigger modal -->
<button onclick="setupCamera()" type="button" class="btn btn-primary my-1 mb-3 py-1" data-bs-toggle="modal" data-bs-target="#exampleModal" required>
  Open Camera
</button>

    <input name="file" type="file" class="form-control mb-3 py-2 my-1" id="file" accept="image/*" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
   

    <img id="blah" src="#" alt="Preview" width="150" class="my-1 mb-3 py-2" height="150" style="display:none;">

    <!-- <div class="alert mt-3" role="alert" id="error-alert" style="display:none;">
        <span id="alert-message"></span>
    </div> -->

    <div class="text-start mt-3">
        <button type="submit" class="btn btn-success" id="addpet">Add Pet</button>
    </div>
    <div class="text-start mt-3">
    <p class="fs-6"><span class="text-danger">*</span> Required Fields</p>
    </div>
</form>

                <!-- start -->
           
     

                </div>

  </div>


  <script>


    $(document).ready(function() {
        $('#fileUploadForm').on('submit', function(e) {
            e.preventDefault();

            //document.getElementById("addpet").disabled = true;

            Swal.fire({
                title: 'Detecting dog or cat, Please Wait!',
                icon: 'info',
                showConfirmButton: false
            });

            var hasInvalidField = $('.is-invalid').length > 0;

            if (hasInvalidField) {
                Swal.fire({
                    title: 'Info',
                    text: 'Please fill out all required fields correctly.',
                    icon: 'info',
                    confirmButtonText: 'Ok'
                });
                document.getElementById("addpet").disabled = false;
                return;
            }

            var formData = new FormData(this);

            $.ajax({
                url: 'backend/upload-addpet.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json', // Ensure expecting JSON data
                success: function(response) {
                    console.log(response.message);
                    // Check the response and handle accordingly
                    if (response.status === 1) {
                        document.getElementById("addpet").disabled = false;

                        Swal.fire({
                            title: 'Success',
                            text: 'Added Pet Successfully',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload(true);
                            }
                        });
                    } else if (response.status === 2) {

                      Swal.fire({
                          title: 'No dog or cat detected',
                          text: 'Please retake or choose the photo.',
                          icon: 'info',
                          confirmButtonText: 'Ok',
                          showCancelButton: false,
                          timer: 3000, // Timer set to 1000 milliseconds (1 second)
                          timerProgressBar: true, // Show progress bar for the timer
                          didOpen: () => {
                              Swal.showLoading(); // Show a loading indicator while the timer is running
                          }
                      });


                    }else if(response.status === 3){

                        Swal.fire({
    title: `We Detected ${response.type}`,
    text: 'Please check pet type*.',
    icon: 'info',
    confirmButtonText: 'Ok',
    showCancelButton: false,
    timer: 5000, // Timer set to 3000 milliseconds (3 seconds)
    timerProgressBar: true, // Show progress bar for the timer
    didOpen: () => {
        Swal.showLoading(); // Show a loading indicator while the timer is running
    }
});


                    }else if(response.status === 4){
                      
                      Swal.fire({
                          title: 'Image looks good?',
                          html: `<img src="${response.image}" class="img-thumbnail" alt="...">`,
                          icon: 'info',
                          showCancelButton: true,
                          confirmButtonText: 'Yes',
                          cancelButtonText: 'No',
                          showLoaderOnConfirm: true,
                          preConfirm: (choice) => {
                              if (choice === 'Yes') {
                                  // Handle 'Yes' button click
                                  // Perform actions when the user selects 'Yes'
                              } else if (choice === 'No') {
                                  // Handle 'No' button click
                                  // Perform actions when the user selects 'No'
                              }
                          }
                      });



} else if (response.status == 0) {
                      Swal.fire({
                            title: 'Error',
                            text: response.message || 'An error occurred',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorMessage) {
                    console.log('Error uploading file: ' + errorMessage);
                    // Handle upload errors
                    document.getElementById("addpet").disabled = false;
                    // Display an appropriate message or take necessary actions
                }
            });
        });
    });
</script>










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
document.getElementById('file').onchange = evt => {
  document.getElementById('blah').style.display = 'block';

  const [file] = evt.target.files;
  if (file) {
    const blah = document.getElementById('blah');
    blah.src = URL.createObjectURL(file);
  }
}
</script>



<script>


// function submitPetForm() {
//     remove_alert_bg();
//     $('#error-alert').addClass("bg-primary");
//     $('#alert-message').addClass("text-dark");
//     $('#error-alert').fadeIn();
//     $('#alert-message').text("Please wait...");

//     var formData = $("#fileUploadForm").serialize();

//     //alert(formData);


//     $.ajax({
//         url: "backend/addpet.php",
//         data: $("#fileUploadForm").serialize(), // Changed this line
//         type: "POST",
//         dataType: 'json',
//         success: function(result) {

          
//             console.log(result.status + " " + result.message);


//             remove_alert_bg();
//             if (result.status === 1) {
//                 // remove_alert_bg();
//                 // $('#error-alert').addClass("bg-success");
//                 // $('#alert-message').addClass("text-white");
//                 // $('#alert-message').text(result.message);
//                 // setTimeout(function() { $('#error-alert').fadeOut() }, 4000);
//                 // $("#fileUploadForm")[0].reset();
//                 // document.getElementById('blah').style.display = 'none';

//                 Swal.fire({
//             title: 'Success',
//             text: 'Added Pet Successfully',
//             icon: 'success',
//             confirmButtonText: 'Ok'
//         }).then((result) => {
//             if (result.isConfirmed) {
//               window.location.reload(true);
//             }
//         });


//         document.getElementById("addpet").disabled = false;

//         //image to cut


//         // const url = new URL('https://api.example.com/users');
//         // url.pathname = '/users/12345';

//         // const path = url.toString();

//         // const xhr = new XMLHttpRequest();

//         // xhr.open('GET', path);
//         // xhr.setRequestHeader('Accept', 'application/json');

//         // xhr.onload = function() {
//         //   if (xhr.status === 200) {
//         //     // Success!
//         //     const user = JSON.parse(xhr.responseText);

//         //     // Do something with the user data
//         //     console.log(user);
//         //   } else {
//         //     // Error!
//         //     console.log(xhr.statusText);
//         //   }
//         // };

//         // xhr.send();






//             } else {

//               Swal.fire({
//             title: 'Error',
//             text: 'No Action',
//             icon: 'error',
//             confirmButtonText: 'Ok'
//         }).then((result) => {
//             if (result.isConfirmed) {
//               window.location.reload(true);
//             }
//         });


//             }
//         },
//         error: function(error) {
//                       console.log('Error uploading file: ' + error.statusText);
//          }
        
//     });

//     console.log('clicked');
// }




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
