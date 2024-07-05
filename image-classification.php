

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Image Classification</title>

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

    
    <style>
        body {
            zoom: 100%; /* Adjust the zoom level as needed */
        }
    </style>
      
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


      


      <div id="content" class="m-3 bg-white container content text-center border-top border-success border-3 rounded-1">
    
      <?php 
      $user_ip = $_SERVER['REMOTE_ADDR'];

      //echo $user_ip;
      ?>


<!-- 
      <div class="container ">
    <div class="row m-3">
        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="card h-100 bg-primary text-white">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title">Total User/s</h5>
                    <p class="card-text flex-grow-1">23</p>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="card h-100 bg-success text-white">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title">Total Astray Report/s</h5>
                    <p class="card-text flex-grow-1">23</p>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="card h-100 bg-info text-white">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title">Total Pet/s</h5>
                    <p class="card-text flex-grow-1">23</p>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-3 mb-3">
            <div class="card h-100 bg-warning text-dark">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title">Total Adoption Pet/s</h5>
                    <p class="card-text flex-grow-1">23</p>
                </div>
            </div>
        </div>
    </div>
</div>
 -->





    




      <?php
        include 'components/breadcrumb.php'
      ?>



    
        <!-- content start content ahaha -->


        <style>
          .truncated-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        </style>





<div class="container-fluid overflow-auto">
    <div  class="container text-start gx-0">
<div class="row g-2 g-md-3 mt-1 row-cols-2 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xl-4 row-cols-xxl-4">

 


<div class="col">
                         <div id="cards" class="card bg-light">
                          
                           <img src="<?php echo $_GET['report_astray_image']?>" class="card-img-top" alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <p class="card-text truncated-text">Report# <?php echo $_GET['report_id']?></p>
                           <p class="card-text truncated-text"><?php echo $_GET['barangay_taken']?></p>
                           <p class="card-text truncated-text"><?php echo $_GET['type']?></p>
                
                         </div>
                       </div> 
 </div>



<div class="col">
                        <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>
                         <div id="cards" class="card bg-light genko d-none">
                          
                           <img id="img1" src="" class="card-img-top" alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <p class="card-text truncated-text">Top 1</p>
                           <p class="card-text truncated-text" id="confidence1">confidence</p>
                           <p class="card-text truncated-text" id="petname1">pet name</p>
                           <p class="card-text truncated-text"><?php echo $_GET['barangay_taken']?></p>
                           <hr>
                           <p class="card-text truncated-text" id="owner1">owner</p>
                           <p class="card-text truncated-text" id="email1">email</p>
                           <p class="card-text truncated-text" id="phone_number1">phone_number</p>
                           <p class="card-text truncated-text" id="address1">address</p>



                            
                         </div>
                       </div> 
                   </div>



                   <div class="col">
                   <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>
                         <div id="cards" class="card bg-light genko d-none">
                          
                           <img id="img2" src="" class="card-img-top" alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <p class="card-text truncated-text">Top 2</p>
                           <p class="card-text truncated-text" id="confidence2">confidence</p>
                           <p class="card-text truncated-text" id="petname2">pet name</p>
                           
                           <p class="card-text truncated-text"><?php echo $_GET['barangay_taken']?></p>
                           <hr>
                           <p class="card-text truncated-text" id="owner2">owner</p>
                           <p class="card-text truncated-text" id="email2">email</p>
                           <p class="card-text truncated-text" id="phone_number2">phone_number</p>
                           <p class="card-text truncated-text" id="address2">address</p>
                         </div>
                       </div> 
                   </div>

                   <div class="col">
                   <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>
                         <div id="cards" class="card bg-light genko d-none">
                          
                           <img id="img3" src="" class="card-img-top" alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <p class="card-text truncated-text">Top 3</p>
                           <p class="card-text truncated-text" id="confidence3">confidence</p>
                           <p class="card-text truncated-text" id="petname3">pet name</p>
                    
                           <p class="card-text truncated-text"><?php echo $_GET['barangay_taken']?></p>
                           <hr>
                           <p class="card-text truncated-text" id="owner3">owner</p>
                           <p class="card-text truncated-text" id="email3">email</p>
                           <p class="card-text truncated-text" id="phone_number3">phone_number</p>
                           <p class="card-text truncated-text" id="address3">address</p>
                         </div>
                       </div> 
                   </div>


                   <div class="col">
                   <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>
                         <div id="cards" class="card bg-light genko d-none">
                          
                           <img id="img4" src="" class="card-img-top " alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <p class="card-text truncated-text">Top 4</p>
                           <p class="card-text truncated-text" id="confidence4">confidence</p>
                           <p class="card-text truncated-text" id="petname4">pet name</p>
                       
                           <p class="card-text truncated-text"><?php echo $_GET['barangay_taken']?></p>
                           <hr>
                           <p class="card-text truncated-text" id="owner4">owner</p>
                           <p class="card-text truncated-text" id="email4">email</p>
                           <p class="card-text truncated-text" id="phone_number4">phone_number</p>
                           <p class="card-text truncated-text" id="address4">address</p>
                         </div>
                       </div> 
                   </div>



                   <div class="col">
                        <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>

                         <div id="cards" class="card bg-light genko d-none">
                          
                           <img id="img5" src="" class="card-img-top" alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <p class="card-text truncated-text">Top 5</p>
                           <p class="card-text truncated-text" id="confidence5">confidence</p>
                           <p class="card-text truncated-text" id="petname5">pet name</p>
                     
                           <p class="card-text truncated-text"><?php echo $_GET['barangay_taken']?></p>
                           <hr>
                           <p class="card-text truncated-text" id="owner5">owner</p>
                           <p class="card-text truncated-text" id="email5">email</p>
                           <p class="card-text truncated-text" id="phone_number5">phone_number</p>
                           <p class="card-text truncated-text" id="address5">address</p>
                         </div>
                       </div> 
                   </div>


                   </div>

  

<!-- 
                  <div class="col">
                         <div id="cards" class="card bg-light">
                          
                           <img src="/assets/cat2.jpg" class="card-img-top" alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <p class="card-text truncated-text">Pet #4</p>
                           <p class="card-text truncated-text">whity</p>
                           <p class="card-text truncated-text">Genasky Jr. tableza pinlac</p>
                           
                           <a  href="view-adoption-pet.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
                           
                         </div>
                       </div> 
                   </div> -->

                  
              
    </div>
    </div>
</div>




        <!-- content start content ahaha -->
      </div>
      <!-- content end -->



      </div>
      <!-- content end -->




  </div>


<?php 
include 'components/footer.php'

?>

<script>
  
  
// Parse the URL parameters and extract the values
function getUrlParameter(name) {
    name = name.replace(/[[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

// Call getImage function with parameters from the URL
window.onload = function() {
    var report_astray_image = getUrlParameter('report_astray_image');
    var barangay_taken = getUrlParameter('barangay_taken');
    var type = getUrlParameter('type');
    var report_id = getUrlParameter('report_id');

    getImage(report_astray_image, barangay_taken, type, report_id);
};

function getImage(report_astray_image, barangay_taken, type, report_id) {

    doImageClassification(report_astray_image, barangay_taken, type, report_id);
}


function doImageClassification(report_astray_image, barangay_taken, type, report_id) {
    console.log(report_astray_image, barangay_taken, type, report_id);




 
    //do image classification
    var xhr = new XMLHttpRequest();

    var url = 'backend/intonaGENHAHA.php?' +
        'image=' + encodeURIComponent(report_astray_image) +
        '&taken=' + encodeURIComponent(barangay_taken) +
        '&type=' + encodeURIComponent(type);


        
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                console.log(response);

                if(response===null){
                    // alert('we dont have more than 5 data on that location.');
                    Swal.fire({
  title: "No more than 5 pets registered in " + barangay_taken,
  text: "We don't have more than 5 datasets in " + barangay_taken,
  icon: "warning",
  confirmButtonText: "Back to Report List"
}).then(() => {
  window.location.href = "report-list.php"; // Redirect to report-list.php
});

                }

                var classNamesAndConfidences = [];

                var index = 0;

                // Extracting class_name and confidence and handling them
                response.forEach(function(item) {
                    console.log('Class Name:', item.class_name);
                    console.log('Confidence:', item.confidence);

                   
                     // Since index starts from 0, add 1 to match your ID numbering
                    console.log(index);
                   
                    let confidenceElement = document.getElementById('confidence' + index);
                    if (confidenceElement) {
                        confidenceElement.textContent = 'Confidence: ' + item.confidence + '%';
                    }

                    // Push class_name and confidence as an object into the array
                    classNamesAndConfidences.push({
                        class_name: item.class_name,
                        confidence: item.confidence
                    });

                    index = index + 1;

                });


            


                // Save the array classNamesAndConfidences for further use
              
                let petname1 = classNamesAndConfidences[0].class_name;
                let petname2 = classNamesAndConfidences[1].class_name;
                let petname3 = classNamesAndConfidences[2].class_name;
                let petname4 = classNamesAndConfidences[3].class_name;
                let petname5 = classNamesAndConfidences[4].class_name;

                var url = 'backend/intonaGENHAHAjson.php?' +
                    'pet_name1=' + encodeURIComponent(petname1) +
                    '&pet_name2=' + encodeURIComponent(petname2) +
                    '&pet_name3=' + encodeURIComponent(petname3) +
                    '&pet_name4=' + encodeURIComponent(petname4) +
                    '&pet_name5=' + encodeURIComponent(petname5);

                console.log(url);
                fetch(url)
                    .then(function(response) {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    
                    })
                    .then(function(data) {
                        // Process the data here
                        console.log(data);

document.querySelectorAll('div.spinner-border.text-success[role="status"]').forEach(elem => elem.classList.add('d-none'));
document.querySelectorAll('.genko.d-none').forEach(elem => elem.classList.remove('d-none'));



                

                        // Loop through the data array
                        for (let i = 0; i < data.length; i++) {
                            let imgElement = document.getElementById('img' + (i + 1));
                            let petnameElement = document.getElementById('petname' + (i + 1));
                            let ownerElement = document.getElementById('owner' + (i + 1));

                            let email = document.getElementById('email' + (i + 1));
                            let phone_number = document.getElementById('phone_number' + (i + 1));
                            let address = document.getElementById('address' + (i + 1));

                            if (data.length > i) {
                                let pet = data[i]; // Accessing the current pet's data from the array

                                // Update the image source
                                imgElement.src = pet.pet_img;

                                // Update the content of paragraphs

                                petnameElement.textContent = "Pet Name: " + pet.pet_name;
                                ownerElement.textContent = "Owner: " + pet.pet_owner_fullname;

                                email.textContent = "" + pet.email;
                                phone_number.textContent = "" + pet.phone_number;
                                address.textContent = "" + pet.address;

                            
                            }

                

                           
                        }


                        
                    })
                    .catch(function(error) {
                        console.error('There has been a problem with your fetch operation:', error.message);
                        // Handle errors
                 
                    });




                
            } else {
                console.error('Error:', xhr.status, xhr.statusText);
                // Handle errors
                
            }

           
        }

    
    };

    xhr.open('GET', url, true);
    xhr.send();
    console.log(url);
}

</script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
