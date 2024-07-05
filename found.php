
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Report Stray</title>
    

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
                    <img src="/assets/logo.png" class="rounded mx-auto d-block" alt="..." width="130" height="130">

                    <div class="text-center">
  
                    <h4 class="text-center">Report Stray?</h4>
                    <p class="text-center">Send us your details with the form below, and lets find them a new home! &hearts; </p>
                  
                  
                    <form id="report_form" enctype="multipart/form-data" method='post' >
					
                        <label>Reporter's Full Name</label>
                        <input readonly  value="<?php echo $_SESSION['fullname']?>" type="text" name="reporter_fullname" id="fullname" class="bg-light form-control my-1 mb-3 py-2" placeholder="Enter your full name" required/>
                        
                        <label>Reporter's Email</label>
                        <input readonly  value="<?php echo $_SESSION['email']?>" type="text" name="reporter_email" id="email" class="bg-light form-control my-1 mb-3 py-2" placeholder="Enter your full name" required/>
                        
                  
                        
                        <label>Reporter's Barangay</label>
                        <input readonly  value="<?php echo $_SESSION['address']?>" type="text" name="reporter_address" id="address" class=" bg-light  form-control my-1 mb-3 py-2" placeholder="Enter your Address" required/>
                        
                        <label>Reporter's Phone Number</label>
                        <input readonly  value="<?php echo $_SESSION['phone_number']?>" type="text" name="reporter_phonenumber" id="phonenumber" class="bg-light form-control my-1 mb-3 py-2" placeholder="Enter phone number (11 digits)" required/>
                        
                           

<label>Current barangay</label>
<input readonly  value="getting your location.." type="text" name="barangay_taken" id="barangay_taken" class="bg-light form-control my-1 mb-3 py-2" placeholder="" required/>
                        
    
<label>Reporter's Notes<span class="text-danger">*<span></label> 
                
<textarea required name="reporter_notes" class="form-control my-1 mb-3 py-2" id="message" rows="3" placeholder="Reporter notes" ></textarea>
            



  
  
  <label>My Location<span class="text-danger">*<span><span class="text-muted"></span></label>

 


 
  <input readonly  type="text" name="location_link" id="location_link" class="bg-light form-control my-1 mb-3 py-2" placeholder="" required/>
                        

  
  <div id="map" style="width: 100%; height: 350px;" class="my-1 mb-3 py-1"></div>

  
  
  
        <label for="file">Picture of Stray<span class="text-danger">*<span></label>
						
						<!-- Button trigger modal -->
<button onclick="setupCamera()" type="button" class="btn btn-primary my-1 mb-3 py-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Open Camera
</button>


<input name="file" type="file" class="form-control mb-3 py-2 my-1" id="file" accept="image/*" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>


    <img id="blah" src="#" alt="Preview" width="150" class="my-1 mb-3 py-2" height="150" style="display:none;">

            
 </div>
 
 
 

        
            
 <!--
    <div class="alert" role="alert" id="error-alert" style="display:none;">
        <span id="alert-message"></span>
    </div>
	-->


                <div class="text-center mt-3">
                            <button type="submit"  class="btn btn-primary" id="submitmona">Submit Report</button>                          
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

<script src="https://maps.googleapis.com/maps/api/js?key=""&callback=initMap" async defer></script>


<script>

  const geoJson = {
    "barangays": [
      {
        "barangay_name": "Dapdap",
        "coordinates": [
          {"latitude": 15.221520, "longitude": 120.601496, "altitude": 0},
          {"latitude": 15.228828, "longitude": 120.612575, "altitude": 0},
          {"latitude": 15.230316, "longitude": 120.620604, "altitude": 0},
          {"latitude": 15.218577, "longitude": 120.622392, "altitude": 0},
          {"latitude": 15.214434, "longitude": 120.610232, "altitude": 0},
          {"latitude": 15.214874, "longitude": 120.606656, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Atlu-Bola",
        "coordinates": [
          {"latitude": 15.248202, "longitude": 120.588695, "altitude": 0},
          {"latitude": 15.244454, "longitude": 120.591184, "altitude": 0},
          {"latitude": 15.239624, "longitude": 120.583992, "altitude": 0},
          {"latitude": 15.232657, "longitude": 120.584128, "altitude": 0},
          {"latitude": 15.232335, "longitude": 120.578635, "altitude": 0},
          {"latitude": 15.242026, "longitude": 120.577452, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Bical",
        "coordinates": [
          {"latitude": 15.192841, "longitude": 120.608216, "altitude": 0},
          {"latitude": 15.189371, "longitude": 120.609237, "altitude": 0},
          {"latitude": 15.188053, "longitude": 120.613610, "altitude": 0},
          {"latitude": 15.191979, "longitude": 120.627273, "altitude": 0},
          {"latitude": 15.196242, "longitude": 120.627729, "altitude": 0},
          {"latitude": 15.199047, "longitude": 120.624679, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Bundagul",
        "coordinates": [
          {"latitude": 15.244092, "longitude": 120.618520, "altitude": 0},
          {"latitude": 15.243009, "longitude": 120.617551, "altitude": 0},
          {"latitude": 15.238183, "longitude": 120.620919, "altitude": 0},
          {"latitude": 15.232800, "longitude": 120.613085, "altitude": 0},
          {"latitude": 15.232883, "longitude": 120.613386, "altitude": 0},
          {"latitude": 15.231110, "longitude": 120.614418, "altitude": 0},
          {"latitude": 15.230535, "longitude": 120.613696, "altitude": 0},
          {"latitude": 15.228742, "longitude": 120.614166, "altitude": 0},
          {"latitude": 15.217711, "longitude": 120.593170, "altitude": 0},
          {"latitude": 15.230780, "longitude": 120.584804, "altitude": 0},
          {"latitude": 15.234771, "longitude": 120.591095, "altitude": 0},
          {"latitude": 15.250348, "longitude": 120.610300, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Cacutud",
        "coordinates": [
          {"latitude": 15.240771, "longitude": 120.568718, "altitude": 0},
          {"latitude": 15.236407, "longitude": 120.569813, "altitude": 0},
          {"latitude": 15.240665, "longitude": 120.576981, "altitude": 0},
          {"latitude": 15.243150, "longitude": 120.575608, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Calumpang",
        "coordinates": [
          {"latitude": 15.209512, "longitude": 120.497987, "altitude": 0},
          {"latitude": 15.212671, "longitude": 120.497318, "altitude": 0},
          {"latitude": 15.215624, "longitude": 120.498525, "altitude": 0},
          {"latitude": 15.218030, "longitude": 120.501661, "altitude": 0},
          {"latitude": 15.219688, "longitude": 120.514212, "altitude": 0},
          {"latitude": 15.226962, "longitude": 120.526121, "altitude": 0},
          {"latitude": 15.223478, "longitude": 120.525875, "altitude": 0},
          {"latitude": 15.219487, "longitude": 120.527401, "altitude": 0},
          {"latitude": 15.217707, "longitude": 120.526119, "altitude": 0},
          {"latitude": 15.205677, "longitude": 120.502743, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Camachiles",
        "coordinates": [
          {"latitude": 15.188538, "longitude": 120.580139, "altitude": 0},
          {"latitude": 15.188828, "longitude": 120.584262, "altitude": 0},
          {"latitude": 15.187646, "longitude": 120.584589, "altitude": 0},
          {"latitude": 15.192709, "longitude": 120.579550, "altitude": 0},
          {"latitude": 15.192760, "longitude": 120.583404, "altitude": 0},
          {"latitude": 15.193866, "longitude": 120.586749, "altitude": 0},
          {"latitude": 15.194525, "longitude":  120.586727, "altitude": 0},
          {"latitude": 15.194971, "longitude": 120.587508, "altitude": 0},
          {"latitude": 15.195496, "longitude": 120.587542, "altitude": 0},
          {"latitude": 15.196729, "longitude": 120.588887, "altitude": 0},
          {"latitude": 15.197163, "longitude": 120.589136, "altitude": 0},
          {"latitude": 15.190491, "longitude": 120.599164, "altitude": 0},
          {"latitude": 15.188430, "longitude": 120.591167, "altitude": 0},
          {"latitude": 15.188246, "longitude": 120.590318, "altitude": 0},
          {"latitude": 15.188111, "longitude": 120.590273, "altitude": 0},
          {"latitude": 15.187765, "longitude": 120.590115, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Dau",
        "coordinates": [
          {"latitude": 15.189538, "longitude": 120.599264, "altitude": 0},
          {"latitude": 15.188337, "longitude": 120.596229, "altitude": 0},
          {"latitude": 15.189333, "longitude": 120.595319, "altitude": 0},
          {"latitude": 15.186226, "longitude": 120.579634, "altitude": 0},
          {"latitude": 15.183849, "longitude": 120.579824, "altitude": 0},
          {"latitude": 15.183108, "longitude": 120.579478, "altitude": 0},
          {"latitude": 15.182717, "longitude": 120.579501, "altitude": 0},
          {"latitude": 15.182301, "longitude": 120.580426, "altitude": 0},
          {"latitude": 15.181700, "longitude": 120.580852, "altitude": 0},
          {"latitude": 15.177499, "longitude": 120.581626, "altitude": 0},
          {"latitude": 15.177090, "longitude": 120.585524, "altitude": 0},
          {"latitude": 15.175975, "longitude": 120.584509, "altitude": 0},
          {"latitude": 15.175800, "longitude": 120.584511, "altitude": 0},
          {"latitude": 15.175478, "longitude": 120.584264, "altitude": 0},
          {"latitude": 15.173503, "longitude": 120.585554, "altitude": 0},
          {"latitude": 15.174133, "longitude": 120.586914, "altitude": 0},
          {"latitude": 15.174118, "longitude": 120.587941, "altitude": 0},
          {"latitude": 15.171556, "longitude": 120.588756, "altitude": 0},
          {"latitude": 15.175286, "longitude": 120.598438, "altitude": 0},
          {"latitude": 15.174554, "longitude": 120.606172, "altitude": 0},
          {"latitude": 15.189548, "longitude": 120.599285, "altitude": 0},
          {"latitude": 15.188342, "longitude": 120.596204, "altitude": 0},
          {"latitude": 15.189340, "longitude": 120.595318, "altitude": 0},
          {"latitude": 15.187650, "longitude": 120.583144, "altitude": 0},
          {"latitude": 15.186498, "longitude": 120.581263, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Dolores",
        "coordinates": [
          {"latitude": 15.243690, "longitude": 120.567050, "altitude": 0},
          {"latitude": 15.241537, "longitude": 120.565119, "altitude": 0},
          {"latitude": 15.232888, "longitude": 120.568291, "altitude": 0},
          {"latitude": 15.233636, "longitude": 120.571027, "altitude": 0},
          {"latitude": 15.243671, "longitude": 120.567091, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Duquit",
        "coordinates": [
          {"latitude": 15.180233, "longitude": 120.608653, "altitude": 0},
          {"latitude": 15.178597, "longitude": 120.608696, "altitude": 0},
          {"latitude": 15.174669, "longitude": 120.613531, "altitude": 0},
          {"latitude": 15.174042, "longitude": 120.616481, "altitude": 0},
          {"latitude": 15.175835, "longitude": 120.623637, "altitude": 0},
          {"latitude": 15.177482, "longitude": 120.624402, "altitude": 0},
          {"latitude": 15.181876, "longitude": 120.620778, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Lakandula",
        "coordinates": [
          {"latitude": 15.177192, "longitude": 120.581806, "altitude": 0},
          {"latitude": 15.170420, "longitude": 120.582723, "altitude": 0},
          {"latitude": 15.171804, "longitude": 120.588586, "altitude": 0},
          {"latitude": 15.173982, "longitude": 120.587995, "altitude": 0},
          {"latitude": 15.174080, "longitude": 120.587783, "altitude": 0},
          {"latitude": 15.174080, "longitude": 120.587091, "altitude": 0},
          {"latitude": 15.173370, "longitude": 120.585507, "altitude": 0},
          {"latitude": 15.174424, "longitude": 120.585162, "altitude": 0},
          {"latitude": 15.175423, "longitude": 120.584169, "altitude": 0},
          {"latitude": 15.175815, "longitude": 120.584451, "altitude": 0},
          {"latitude": 15.175937,  "longitude": 120.584352, "altitude": 0},
          {"latitude": 15.177054, "longitude": 120.585373, "altitude": 0},
          {"latitude": 15.177282, "longitude": 120.583715, "altitude": 0},
          {"latitude": 15.177390, "longitude": 120.582155, "altitude": 0},
          {"latitude": 15.177296, "longitude": 120.581910, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Mabiga",
        "coordinates": [
          {"latitude": 15.212774, "longitude": 120.574335, "altitude": 0},
          {"latitude": 15.198461, "longitude": 120.578260, "altitude": 0},
          {"latitude": 15.198432, "longitude": 120.595638, "altitude": 0},
          {"latitude": 15.215893, "longitude": 120.589680, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Macapagal Village",
        "coordinates": [
          {"latitude": 15.209851, "longitude": 120.533367, "altitude": 0},
          {"latitude": 15.208433, "longitude": 120.533716, "altitude": 0},
          {"latitude": 15.208422, "longitude": 120.535196, "altitude": 0},
          {"latitude": 15.208681, "longitude": 120.535293, "altitude": 0},
          {"latitude": 15.208510, "longitude": 120.536344, "altitude": 0},
          {"latitude": 15.209271, "longitude": 120.536918, "altitude": 0},
          {"latitude": 15.209649, "longitude": 120.538640, "altitude": 0},
          {"latitude": 15.210058, "longitude": 120.538694,  "altitude": 0},
          {"latitude": 15.210731, "longitude": 120.541167, "altitude": 0},
          {"latitude": 15.211557, "longitude": 120.541199, "altitude": 0},
          {"latitude": 15.210682, "longitude": 120.535125, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Mamatitang",
        "coordinates": [
          {"latitude": 15.236299, "longitude": 120.569951, "altitude": 0},
          {"latitude": 15.227077, "longitude": 120.572985, "altitude": 0},
          {"latitude": 15.227059, "longitude": 120.573385, "altitude": 0},
          {"latitude": 15.226966, "longitude": 120.573665, "altitude": 0},
          {"latitude": 15.228664, "longitude": 120.579358, "altitude": 0},
          {"latitude": 15.239320, "longitude": 120.574767, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Mangalit",
        "coordinates": [
          {"latitude": 15.208081, "longitude": 120.579798, "altitude": 0},
          {"latitude": 15.203791, "longitude": 120.580973, "altitude": 0},
          {"latitude": 15.204084, "longitude": 120.592225, "altitude": 0},
          {"latitude": 15.208723, "longitude": 120.591097, "altitude": 0},
          {"latitude": 15.216367, "longitude": 120.590180, "altitude": 0},
          {"latitude": 15.215765, "longitude": 120.585833, "altitude": 0},
          {"latitude": 15.212395, "longitude": 120.587015, "altitude": 0},
          {"latitude": 15.209162, "longitude": 120.582767, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Marcos Village",
        "coordinates": [
          {"latitude": 15.207300, "longitude": 120.524540, "altitude": 0},
          {"latitude": 15.210861, "longitude": 120.532327, "altitude": 0},
          {"latitude": 15.212331, "longitude": 120.534518, "altitude": 0},
          {"latitude": 15.209307, "longitude": 120.532206, "altitude": 0},
          {"latitude": 15.207754, "longitude": 120.526339, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Mawaque",
        "coordinates": [
          {"latitude": 15.225615, "longitude": 120.609766, "altitude": 0},
          {"latitude": 15.220706, "longitude": 120.592893, "altitude": 0},
          {"latitude": 15.219484, "longitude": 120.590205, "altitude": 0},
          {"latitude": 15.217058, "longitude": 120.590060, "altitude": 0},
          {"latitude": 15.210611, "longitude": 120.591318, "altitude": 0},
          {"latitude": 15.213133, "longitude": 120.606984, "altitude": 0},
          {"latitude": 15.222800, "longitude": 120.609639, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Paralayunan",
        "coordinates": [
          {"latitude": 15.233473, "longitude": 120.613113, "altitude": 0},
          {"latitude": 15.232775, "longitude": 120.613079, "altitude": 0},
          {"latitude": 15.232866, "longitude": 120.613352, "altitude": 0},
          {"latitude": 15.231062, "longitude": 120.614457, "altitude": 0},
          {"latitude": 15.230664, "longitude": 120.613968, "altitude": 0},
          {"latitude": 15.230525, "longitude": 120.613712, "altitude": 0},
          {"latitude": 15.228754, "longitude": 120.614171, "altitude": 0},
          {"latitude": 15.228610, "longitude": 120.615767, "altitude": 0},
          {"latitude": 15.228677, "longitude": 120.616196, "altitude": 0},
          {"latitude": 15.230987, "longitude": 120.622129, "altitude": 0},
          {"latitude": 15.236704, "longitude": 120.621710, "altitude": 0},
          {"latitude": 15.238189, "longitude": 120.620969, "altitude": 0}
          
        ]
      },
      {
        "barangay_name": "Poblacion",
        "coordinates": [
          {"latitude": 15.227140, "longitude": 120.569692, "altitude": 0},
          {"latitude": 15.227181, "longitude": 120.569586, "altitude": 0},
          {"latitude": 15.222652, "longitude": 120.571067, "altitude": 0},
          {"latitude": 15.223540, "longitude": 120.573654, "altitude": 0},
          {"latitude": 15.223623, "longitude": 120.574220, "altitude": 0},
          {"latitude": 15.224700, "longitude": 120.574941, "altitude": 0},
          {"latitude": 15.225133, "longitude": 120.575455, "altitude": 0},
          {"latitude": 15.225066, "longitude": 120.580044, "altitude": 0},
          {"latitude": 15.225095, "longitude": 120.581254, "altitude": 0},
          {"latitude": 15.229267, "longitude": 120.582564, "altitude": 0},
          {"latitude": 15.226931, "longitude": 120.572932, "altitude": 0},
          {"latitude": 15.227863, "longitude": 120.572729, "altitude": 0}
        ]
      },
      {
        "barangay_name": "San Francisco",
        "coordinates": [
          {"latitude": 15.219477, "longitude": 120.590158, "altitude": 0},
          {"latitude": 15.217048, "longitude": 120.590042, "altitude": 0},
          {"latitude": 15.216419, "longitude": 120.590207, "altitude": 0},
          {"latitude": 15.215791, "longitude": 120.587160, "altitude": 0},
          {"latitude": 15.215009, "longitude": 120.580733, "altitude": 0},
          {"latitude": 15.212883, "longitude": 120.571179, "altitude": 0},
          {"latitude": 15.210304, "longitude": 120.567383, "altitude": 0},
          {"latitude": 15.213658, "longitude": 120.568537, "altitude": 0},
          {"latitude": 15.213645, "longitude": 120.567619, "altitude": 0},
          {"latitude": 15.213900, "longitude": 120.567037, "altitude": 0},
          {"latitude": 15.213746, "longitude": 120.564964, "altitude": 0},
          {"latitude": 15.213083, "longitude": 120.563190, "altitude": 0},
          {"latitude": 15.213665, "longitude": 120.561383, "altitude": 0},
          {"latitude": 15.214338, "longitude": 120.561332, "altitude": 0},
          {"latitude": 15.214790, "longitude": 120.559526, "altitude": 0},
          {"latitude": 15.215288, "longitude": 120.558709, "altitude": 0},
          {"latitude": 15.215968, "longitude": 120.558806, "altitude": 0},
          {"latitude": 15.216088, "longitude": 120.558934, "altitude": 0},
          {"latitude": 15.216815, "longitude": 120.563819, "altitude": 0},
          {"latitude": 15.216933, "longitude": 120.563733, "altitude": 0},
          {"latitude": 15.216210, "longitude": 120.559055, "altitude": 0},
          {"latitude": 15.220505, "longitude": 120.563085, "altitude": 0},
          {"latitude": 15.221205, "longitude": 120.564300, "altitude": 0},
          {"latitude": 15.224125, "longitude": 120.566846, "altitude": 0},
          {"latitude": 15.224427, "longitude": 120.567909, "altitude": 0},
          {"latitude": 15.225183, "longitude": 120.568590, "altitude": 0},
          {"latitude": 15.225672, "longitude": 120.569436, "altitude": 0},
          {"latitude": 15.225737, "longitude": 120.570295, "altitude": 0},
          {"latitude": 15.225499, "longitude": 120.571022, "altitude": 0}
        ]
      },
      {
        "barangay_name": "San Joaquin",
        "coordinates": [
          {"latitude": 15.232811, "longitude": 120.568278, "altitude": 0},
          {"latitude": 15.227174, "longitude": 120.569481, "altitude": 0},
          {"latitude": 15.228132, "longitude": 120.572665, "altitude": 0},
          {"latitude": 15.233806, "longitude": 120.570922, "altitude": 0},
          {"latitude": 15.233538, "longitude": 120.570971, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Santa Ines",
        "coordinates": [
          {"latitude":  15.223557, "longitude":120.574076, "altitude": 0},
          {"latitude": 15.221743, "longitude": 120.576479, "altitude": 0},
          {"latitude": 15.221379, "longitude": 120.577887, "altitude": 0},
          {"latitude": 15.222819, "longitude": 120.584313, "altitude": 0},
          {"latitude": 15.224759, "longitude": 120.584466, "altitude": 0},
          {"latitude": 15.225339, "longitude": 120.577734, "altitude": 0},
          {"latitude": 15.224862, "longitude": 120.575755, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Santa Maria",
        "coordinates": [
          {"latitude": 15.225756, "longitude": 120.574320, "altitude": 0},
          {"latitude": 15.218112, "longitude": 120.577163, "altitude": 0},
          {"latitude": 15.218325, "longitude": 120.579387, "altitude": 0},
          {"latitude": 15.218037, "longitude": 120.581789, "altitude": 0},
          {"latitude": 15.218638, "longitude": 120.582831, "altitude": 0},
          {"latitude": 15.218852, "longitude": 120.583975,  "altitude": 0},
          {"latitude": 15.218438, "longitude": 120.585954, "altitude": 0},
          {"latitude": 15.219353, "longitude": 120.588639, "altitude": 0},
          {"latitude": 15.219524, "longitude": 120.590202, "altitude": 0},
          {"latitude": 15.220714, "longitude": 120.592883, "altitude": 0},
          {"latitude": 15.224419, "longitude": 120.598725, "altitude": 0},
          {"latitude": 15.226499, "longitude": 120.597500, "altitude": 0},
          {"latitude": 15.227574, "longitude": 120.590953, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Santa Rosario",
        "coordinates": [
          {"latitude": 15.203656, "longitude": 120.580908, "altitude": 0},
          {"latitude": 15.191915, "longitude": 120.583948, "altitude": 0},
          {"latitude": 15.194596, "longitude": 120.593061, "altitude": 0},
          {"latitude": 15.196414, "longitude": 120.592523, "altitude": 0},
          {"latitude": 15.201535, "longitude": 120.592827, "altitude": 0},
          {"latitude": 15.204006, "longitude": 120.592237, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Sapang Balen",
        "coordinates": [
          {"latitude": 15.247838, "longitude": 120.593229, "altitude": 0},
          {"latitude": 15.244564, "longitude": 120.587527, "altitude": 0},
          {"latitude": 15.256774, "longitude": 120.584561, "altitude": 0},
          {"latitude": 15.265561, "longitude": 120.592450, "altitude": 0},
          {"latitude": 15.267065, "longitude": 120.592009, "altitude": 0},
          {"latitude": 15.267291, "longitude": 120.592819, "altitude": 0},
          {"latitude": 15.263272, "longitude": 120.625805, "altitude": 0},
          {"latitude": 15.245272, "longitude": 120.617661, "altitude": 0},
          {"latitude": 15.239769, "longitude": 120.621708, "altitude": 0},
          {"latitude": 15.238171, "longitude": 120.606227, "altitude": 0},
          {"latitude": 15.237787, "longitude": 120.595879, "altitude": 0},
          {"latitude": 15.238630, "longitude": 120.596276, "altitude": 0},
          {"latitude": 15.243982, "longitude": 120.593702, "altitude": 0},
          {"latitude": 15.247813, "longitude": 120.593229, "altitude": 0},
          {"latitude": 15.244674, "longitude": 120.587576, "altitude": 0},
          {"latitude": 15.256789, "longitude": 120.584557, "altitude": 0},
          {"latitude": 15.265522, "longitude": 120.592471, "altitude": 0},
          {"latitude": 15.267073, "longitude": 120.592007, "altitude": 0},
          {"latitude": 15.267296, "longitude": 120.592818, "altitude": 0}]
      },
      {
        "barangay_name": "Sapang Biabas",
        "coordinates": [
          {"latitude": 15.194589, "longitude": 120.593637, "altitude": 0},
          {"latitude": 15.188584, "longitude": 120.596298, "altitude": 0},
          {"latitude": 15.196195, "longitude": 120.617084, "altitude": 0},
          {"latitude": 15.203352, "longitude": 120.612491, "altitude": 0}
        ]
      },
      {
        "barangay_name": "Tabun",
        "coordinates": [
          {"latitude": 15.235880, "longitude": 120.542105, "altitude": 0},
          {"latitude": 15.232614, "longitude": 120.551451, "altitude": 0},
          {"latitude": 15.232240, "longitude": 120.552516, "altitude": 0},
          {"latitude": 15.232086, "longitude": 120.552952, "altitude": 0},
          {"latitude": 15.260454, "longitude": 120.579039, "altitude": 0},
          {"latitude": 15.265013, "longitude": 120.574869, "altitude": 0},
          {"latitude": 15.258087, "longitude": 120.555564, "altitude": 0},
          {"latitude": 15.256046, "longitude": 120.555268, "altitude": 0},
          {"latitude": 15.254606, "longitude": 120.552874, "altitude": 0}

        ]
      }
      
    ]
  };

console.log(geoJson);
  

let map;
let userMarker;

let lololo;
let lalala;



function isPointInsidePolygon(point, polygon) {
  const x = point.latitude;
  const y = point.longitude;

  let inside = false;
  for (let i = 0, j = polygon.length - 1; i < polygon.length; j = i++) {
    const xi = polygon[i].latitude;
    const yi = polygon[i].longitude;
    const xj = polygon[j].latitude;
    const yj = polygon[j].longitude;

    const intersect = ((yi > y) !== (yj > y)) &&
      (x < ((xj - xi) * (y - yi)) / (yj - yi) + xi);
    if (intersect) inside = !inside;
  }

  return inside;

}




function findBarangay(testPoint, geoJson) {
  for (const barangay of geoJson.barangays) {
    const isInside = isPointInsidePolygon(testPoint, barangay.coordinates);
    if (isInside) {
      return barangay.barangay_name;
    }
  }
  return "you are not in mabalacat"; 
}



function ReloadMaps() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showMap);
    } else {
      console.log('Geolocation is not supported by this browser.');
    }

    function showMap(position) {
      const latitude = position.coords.latitude;
      const longitude = position.coords.longitude;

      // Call a function to display the map using Google Maps API
      initializeMap(latitude, longitude);
    }

    function initializeMap(latitude, longitude) {
      const mapOptions = {
        center: { lat: latitude, lng: longitude },
        zoom: 16, // Adjust zoom level as needed
      };

      map = new google.maps.Map(document.getElementById('map'), mapOptions);

      // Drop a pin at the user's location
      userMarker = new google.maps.Marker({
        position: { lat: latitude, lng: longitude },
        map: map,
        title: 'Your Location',
        draggable: true, // Make the marker draggable
      });

      // Add a dragend event listener to the marker
      userMarker.addListener('dragend', function () {
        const newLatitude = userMarker.getPosition().lat();
        const newLongitude = userMarker.getPosition().lng();

        //for location link
        const locationLink = `https://maps.google.com/?q=${newLatitude},${newLongitude}`;

        document.getElementById('location_link').value = locationLink;
        //for current barangay
        const currentBarangay = { "latitude": newLatitude, "longitude": newLongitude };
        const barangayOfCurrentPoint = findBarangay(currentBarangay, geoJson);
        document.getElementById("barangay_taken").value = barangayOfCurrentPoint;
        
        //15.2260457,120.6099402

      });

      //for location link
      const locationLink = `https://maps.google.com/?q=${latitude},${longitude}`;
      document.getElementById('location_link').value = locationLink;

      //for current barangay
      const currentBarangay = { "latitude": latitude, "longitude": longitude };
      const barangayOfCurrentPoint = findBarangay(currentBarangay, geoJson);
      document.getElementById("barangay_taken").value = barangayOfCurrentPoint;

    }
  }

  // Call the ReloadMaps function to start the geolocation and mapping process
  ReloadMaps();

</script>




   

<script>
$(document).ready(function() {
    $('#report_form').on('submit', function(e) {




      const barangay = document.getElementById('barangay_taken').value;

      if(barangay==='you are not in mabalacat' || barangay ==='getting your location..'){
           alert('we cant proceed, you are not in mabalcat');
           return;
      
      }







      Swal.fire({
  title: 'Uploading Image, Please Wait!',
  icon: 'info',
  showConfirmButton: false
});
        e.preventDefault();

        // document.getElementById("submitmona").disabled = true;

        var formData = new FormData(this);

        console.log(formData);



        $.ajax({
            url: 'backend/found.php', // Replace with the URL to your upload script
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response.message);

                if (response.status === 1) {
                    Swal.fire({
                        title: 'Report submitted',
                        text: 'Thank you for your concern, Noah’s Ark will review your report shortly! ',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(true);
                        }
                    });

                    document.getElementById("submitmona").disabled = false;

                }else if(response.status === 2){

                  Swal.fire({
                        title: 'No detected for or cat.',
                        text: 'choose photo or retake thank you!',
                        icon: 'info',
                        confirmButtonText: 'Ok'
                    });

                    document.getElementById("submitmona").disabled = false;


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

                    document.getElementById("submitmona").disabled = false;

                    
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
