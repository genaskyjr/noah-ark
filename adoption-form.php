
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Adoption Form</title>
    

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


<script src="js/foundValidation.js"></script>


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


 


 
    <?php 
    include 'components/sidebar.php'
    ?>
     

      <!-- content start -->
      <div id="content" class="m-3 bg-white container content text-start border-top border-success border-3 rounded-1">
    
      <?php
        include 'components/breadcrumb.php'
      ?>
      



      <section>
      
          <div class="row">
            <div class="col">
              <div class="card border-0 mb-4">
                <div class="card-body">

                    <?php 
                    include 'backend/dbconnect.php';


                     $stmt = $conn->prepare("SELECT `adoption_number`, `adoption_gender`, 
                     `adoption_recued`, `adoption_type`, `adoption_image`, `is_archive`, 
                     `quarantine_day`, `adoption_nickname` FROM `adoption_pets` WHERE `adoption_number` = :adoption_number");

                     // Bind the parameter
                     $stmt->bindParam(':adoption_number', $_GET['adoption_number'], PDO::PARAM_INT);
                 
                     // Execute the query
                     $stmt->execute();
                     $result = $stmt->fetch(PDO::FETCH_ASSOC);

                     if ($result) {
                        // Example: Output the values
                        //echo "Adoption Number: " . $result['adoption_image'] . "<br>";
                    }

                    
                    ?>

                    <img src="<?php echo $result['adoption_image']; ?>" class="rounded mx-auto d-block" alt="..." width="130" height="130">

        
                    <h4 class="text-center">
                    <?php 
                        if(isset($_GET['adoption_nickname'])){
                            echo $_GET['adoption_nickname'];
                        }
                    ?><br>
                    <span class="text-muted">(Pet #<?php 
                        if(isset($_GET['adoption_number'])){
                            echo $_GET['adoption_number'];
                        }
                    ?>)</span>
                  </h4>

                    <p class="text-center">Can't Wait To Be Your Compawnion &hearts; </p>
                  
                  
                  
                    <form id="report_form" enctype="multipart/form-data" method='post' >

                        <label class="d-none">adoption_number</label>
                        <input readonly  value="<?php echo $_GET['adoption_number']?>" type="text" name="adoption_number" id="adoption_number" class="d-none bg-light form-control my-1 mb-3 py-2" placeholder="Enter your full name" required/>
                        
					
                        <label>Full Name</label>
                        <input readonly  value="<?php echo $_SESSION['fullname']?>" type="text" name="reporter_fullname" id="fullname" class="bg-light form-control my-1 mb-3 py-2" placeholder="Enter your full name" required/>
                        
                        <label>Email</label>
                        <input readonly  value="<?php echo $_SESSION['email']?>" type="text" name="reporter_email" id="email" class="bg-light form-control my-1 mb-3 py-2" placeholder="Enter your full name" required/>
                        
                  
                        
                        <label>Address</label>
                        <input readonly  value="<?php echo $_SESSION['address']?>" type="text" name="reporter_address" id="address" class=" bg-light  form-control my-1 mb-3 py-2" placeholder="Enter your Address" required/>
                        
                        <label>Cell Phone Number</label>
                        <input readonly  value="<?php echo $_SESSION['phone_number']?>" type="text" name="reporter_phonenumber" id="phonenumber" class="bg-light form-control my-1 mb-3 py-2" placeholder="Enter phone number (11 digits)" required/>
                        
                           


                    


 
                  

                        
                        
                <label>Reason for Adopting<span class="text-danger">*<span></label> 
                
                <textarea required name="reporter_notes" class="form-control my-1 mb-3 py-2" id="message" rows="3" 
                placeholder="Why do you want to adopt this pet? Please state your answer here." ></textarea>



            

<label>Full Address<span class="text-danger">*<span></label>
<input    type="text" name="full_address" id="full_address" class="form-control my-1 mb-3 py-2" placeholder="Enter your Full Address" required/>
                        

<label>Do you have any other pets?<span class="text-danger">*<span></label>
<select id="yesORno" name="yesORno" class="form-control my-1 mb-3 py-2" required>
           
                        <option selected disabled>Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
        
</select>  


<label class="d-none" id="labelhowmany">How many pets do you currently have?<span class="text-danger">*<span></label>
<input  type="text" name="howmany" id="howmany" class="d-none form-control my-1 mb-3 py-2" placeholder="Enter your pet count" required/>
         


<script>

  const selectElement = document.getElementById('yesORno');
  selectElement.addEventListener('change', function(event) {

    const selectedOption = event.target.value;
    console.log('Selected option:', selectedOption);

    if(selectedOption==='Yes'){
      document.getElementById('labelhowmany').classList.remove('d-none');
      document.getElementById('howmany').classList.remove('d-none');
      document.getElementById('howmany').value = '';
    }else{
      document.getElementById('labelhowmany').classList.add('d-none');
      document.getElementById('howmany').classList.add('d-none');
      document.getElementById('howmany').value = '0';
    }
    
  });
</script>



   


  
  
        <label for="file">Identification Card<span class="text-danger">*<span></label>
						
						<!-- Button trigger modal -->
<button onclick="setupCamera()" type="button" class="btn btn-primary my-1 mb-3 py-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Open Camera
</button>


<input name="file" type="file" class="form-control mb-3 py-2 my-1" id="file" accept="image/*" aria-describedby="inputGroupFileAddon04" aria-label="Upload" >


    <img id="blah" src="#" alt="Preview" width="150" class="my-1 mb-3 py-2" height="150" style="display:none;">






            
 </div>
 
 
 

        
            
 <!--
    <div class="alert" role="alert" id="error-alert" style="display:none;">
        <span id="alert-message"></span>
    </div>
	-->


                <div class="text-center mt-3">
                            <button type="submit"  class="btn btn-primary" id="submitmona">Submit Application</button>                          
                    </div>

                    
                
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
      
      </section>


      </div>
      <!-- content end -->




  </div>
  
  
  




<?php 
include 'components/footer.php'
?>



<script>
        $(document).ready(function() {
            $('#report_form').on('submit', function(e) {
            
                e.preventDefault();


                var formData = new FormData(this);

                console.log(formData);

                $.ajax({
                    url: 'backend/application-form.php', // Replace with the URL to your upload script
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);  
                        if(response.status===1){
                          Swal.fire({
                              title: 'Application Form sent Successfully!',
                              text: 'Your application form has been sent to the admin. Thank you for adopting!',
                              icon: 'success',
                              confirmButtonText: 'Confirm'
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
document.getElementById('file').onchange = evt => {
  document.getElementById('blah').style.display = 'block';

  const [file] = evt.target.files;
  if (file) {
    const blah = document.getElementById('blah');
    blah.src = URL.createObjectURL(file);
  }
}
</script>








	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
