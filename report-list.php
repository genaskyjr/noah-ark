<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Astray Report List</title>

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

    

  </head>
  <body>
<script src="js/zoom.js"></script>




<style>
.modal-backdrop {
     background-color: transparent;
}
</style>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Image Classification</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


      <div class="row">

          <div class="col-6">
              <div class="card p-3">
                  <img id="img1" src="assets/logo.png" class="card-img-top" alt="..." height="150" width="150">
                  <div class="card-body">
                      <h5 class="card-title">Report #<span id="reportNumberSpan"></span></h5>
                      <!-- <p class="card-text">Location : </p> -->
                  </div>
              </div>
          </div>

          <div class="col-6">
              
              <div class="card p-3" id="loading">
                  <div class="spinner-border text-primary" role="status">
                      <span class="visually-hidden">Loading...</span>
                  </div>
              </div>
              
              <div class="card p-3 d-none" id="resultimg">
                  <img id="img2" src="" class="card-img-top" alt="..." height="150" width="150">
                  <div class="card-body">
                  <h5 class="card-text">
                    <span id="percentkohaha"></span> match to</span> <small id="matchpetname"></small>
                  </h5>

                      <p class="card-text">Pet owner: <span id="ownerhaha"><span></p>
                   
                  </div>
              </div>
          </div>




</div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





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
        include 'components/breadcrumb.php'
      ?>

    
        <!-- content start content ahaha -->

      
        <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand"></a>
            <form class="d-flex" method="get">
              <input value="<?php 
              
              if(isset($_GET['search'])){
                echo $_GET['search'];
              }
              
              ?>" name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        </nav>



        <div class="container-fluid overflow-auto">
<table class="table table-bordered text-start text-nowrap overflow-auto">
  <thead>
    <tr>
     
      <th scope="col">Report #</th>
      <th scope="col">Reported Date</th>
      <th scope="col">Stray Image</th>

      <th scope="col">Reporter Notes</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>




<!-- <script>
  function doImageClassification(imagePath) {
    // Your image classification code here
    //console.log('Performing image classification for:', imagePath);

    var xhr = new XMLHttpRequest();
    var parameter = imagePath; // Replace with your parameter value
    var url = 'backend/classify_image.php?path=' + encodeURIComponent(parameter);

    console.log('Performing image classification for:', url);



    xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {

      
    document.getElementById('loading').classList.remove('d-none');

    document.getElementById('resultimg').classList.add('d-none');


        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);


            // Parse the 'bestmatch' string into a JSON object
            var bestMatchObj = JSON.parse(response.bestmatch);

            // Access properties 'bestmatch' and 'distance' from the parsed object
            var bestMatchValue = bestMatchObj.bestmatch;
            var distanceValue = bestMatchObj.distance;
            var fullnameValue = bestMatchObj.fullname;
            var petnameValue = bestMatchObj.pet_name;

            // Log or use these values as needed
            console.log("Best Match:", bestMatchValue);
            console.log("Distance:", distanceValue);
            console.log("Fullname:", fullnameValue);
            console.log("petname:", petnameValue);

            document.getElementById("matchpetname").textContent = petnameValue;


            document.getElementById("percentkohaha").textContent = distanceValue;


            document.getElementById("ownerhaha").textContent = fullnameValue;




          
            var img2Path = bestMatchValue;
            document.getElementById('img2').src = img2Path;



            document.getElementById('loading').classList.add('d-none');

            document.getElementById('resultimg').classList.remove('d-none');

        } else {
            console.error('Error:', xhr.status, xhr.statusText);
            // Handle errors
        }
    }
};


    xhr.open('GET', url, true);
    xhr.send();

    
  }

  function getImage(report_astray_image, barangay_taken, type) {




    var decodedImagePath = decodeURIComponent(imagePath);

    console.log('Report Number:', reportNumber);

    document.getElementById('img1').src = decodedImagePath;

    var spanElement = document.getElementById('reportNumberSpan');
    spanElement.textContent = reportNumber;

    doImageClassification(decodedImagePath);





  }
</script> -->





  <?php


//echo $_SESSION['fullname'];
$current_user = $_SESSION['fullname'];

include 'backend/dbconnect.php';


if(isset($_GET['search'])){
  $keyword = '%' . $_GET['search'] . '%';
  $stmt = $conn->prepare("SELECT `report_id`, `report_daytime`, `report_astray_image`, `report_astray_location`, `reporter_notes`, `reporter_name`, `reporter_email`, `reporter_number`, `type` ,barangay_taken
  FROM `astray_reports` 
  WHERE 
      (`report_id` LIKE :keyword OR
      `report_daytime` LIKE :keyword OR
      `report_astray_image` LIKE :keyword OR
      `report_astray_location` LIKE :keyword OR
      `reporter_notes` LIKE :keyword OR
      `reporter_name` LIKE :keyword OR
      `reporter_email` LIKE :keyword OR
      `reporter_number` LIKE :keyword) AND is_archive = 0 AND is_claim = 0;
  ");

$stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR); // Bind the parameter

}else {
  $stmt = $conn->prepare("SELECT * FROM `astray_reports` WHERE is_archive = 0  AND is_claim = 0");
}


$stmt->execute(); // Execute the statement first.

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {

  
    ?>

    
  
<tr>
 
      <td><?php echo $row['report_id'];  ?></td>
      <td><?php echo $row['report_daytime'];  ?></td>
      <td><img  src="<?php echo $row['report_astray_image'];  ?>" alt="Logo" width="50" height="50" class="d-inline-block align-text-top"></td>
     
      <td><?php echo $row['reporter_notes'];  ?></td>

      <td>

<a  href="view-report.php?reportnumber=<?php echo $row['report_id'] . '&reportdaytime=' . $row['report_daytime'] . '&image=' . $row['report_astray_image']  . '&location=' . $row['report_astray_location'] . '&notes=' . $row['reporter_notes'] . '&reporter_name=' . $row['reporter_name'] . '&reporter_email=' . $row['reporter_email']  . '&reporter_number=' . $row['reporter_number']?>" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> See More info</a>




<a href="javascript:void(0);" class="btn btn-success btn-md" onclick="redirectImageClassification('<?php echo $row['report_astray_image'] ?>', '<?php echo $row['barangay_taken'] ?>', '<?php echo $row['type'] ?>', '<?php echo $row['report_id']; ?>')">
<i class="fa-solid fa-eye"></i> Image Classification
</a>



<button type="button" onClick="mark_rescued(<?php echo $row['report_id'] ?>, '<?php echo $row['report_astray_image'] ?>')" class="btn btn-primary btn-md text-white"><i class="fa-solid fa-check"></i> Rescued</button>
<button type="button" onClick="mark_claim_pet(<?php echo $row['report_id'] ?>)" class="btn btn-success btn-md text-white"><i class="fa-solid fa-check"></i> Claimed Pet</button>


</td>


</tr>




<?php
}
?>  


  
  </tbody>
</table>
</div>




        <!-- content start content ahaha -->
      </div>
      <!-- content end -->




  </div>


<?php 
include 'components/footer.php'

?>


<script>
    function redirectImageClassification(report_astray_image, barangay_taken, type, report_id) {
        // Construct the URL with parameters
        var url = `image-classification.php?report_astray_image=${encodeURIComponent(report_astray_image)}&barangay_taken=${encodeURIComponent(barangay_taken)}&type=${encodeURIComponent(type)}&report_id=${encodeURIComponent(report_id)}`;

        // Redirect to image-classification.php with parameters
        window.location.href = url;
    }
</script>




<script>
function mark_claim_pet(report_id) {
    console.log(report_id);
    event.preventDefault();

    Swal.fire({
        title: 'Who claimed the pet?',
        html: `
            <input type="text" id="claimerName" class="swal2-input" placeholder="Enter claimer's name">
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Mark as claimed',
        cancelButtonText: 'Cancel',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            const claimerName = document.getElementById('claimerName').value;
            if (!claimerName) {
                Swal.showValidationMessage('Enter the claimer\'s name');
            }
            return claimerName;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const claimerName = result.value;
            if (claimerName) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "backend/mark-claimed.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText); // Log the response text

                            var response = JSON.parse(xhr.responseText);
                            if (response && response.status === 1) {
                                Swal.fire({
                                    title: 'Marked Claimed!',
                                    text: `Report #${report_id} has been marked as claimed by ${claimerName}!`,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload(true);
                                    }
                                });
                            } else {
                                Swal.fire('Error', 'Failed to mark the report as claimed.', 'error');
                            }
                        } else {
                            Swal.fire('Error', 'There was an error while processing your request.', 'error');
                        }
                    }
                };

                var data = "report_id=" + encodeURIComponent(report_id) + "&claimerName=" + encodeURIComponent(claimerName);

                console.log(data);
                xhr.send(data);
            }
        }
    });
}
</script>


<script>
function mark_rescued(report_id, report_astray_image) {
    console.log(report_astray_image);
    console.log(report_id);

    Swal.fire({
        title: 'Are you sure?',
        text: "Mark as Rescued report #" + report_id + "?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Mark it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "backend/mark-report.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Change content type

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 1) {
                            Swal.fire({
                                title: 'Marked rescued!',
                                text: 'report #' + report_id + ' Marked rescued!',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload(true);
                                }
                            });
                        } else {
                            Swal.fire('Error', 'There was an error marking the report as rescued.', 'error');
                        }
                    } else {
                        Swal.fire('Error', 'There was an error marking the report as rescued.', 'error');
                    }
                }
            };
            
            var data = "report_id=" + encodeURIComponent(report_id) + "&report_astray_image=" + encodeURIComponent(report_astray_image);

            xhr.send(data);
        }
    });
}
</script>



<script>


function getImage(report_astray_image, barangay_taken, type, report_id) {
    console.log(report_astray_image, barangay_taken, type, report_id);

    var decodedImagePath = decodeURIComponent(report_astray_image);
    console.log('Report Number:', report_id);

    document.getElementById('img1').src = decodedImagePath;
    var spanElement = document.getElementById('reportNumberSpan');
    spanElement.textContent = report_id;

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
                
                var classNamesAndConfidences = [];

                // Extracting class_name and confidence and handling them
                response.forEach(function(item) {
                    console.log('Class Name:', item.class_name);
                    console.log('Confidence:', item.confidence);

                    // Push class_name and confidence as an object into the array
                    classNamesAndConfidences.push({
                        class_name: item.class_name,
                        confidence: item.confidence
                    });
                });

                // Save the array classNamesAndConfidences for further use
                console.log(classNamesAndConfidences[0]);

                let petname = classNamesAndConfidences[0].class_name;

                console.log(petname);


                var url = 'backend/intonaGENHAHAjson.php?pet_name=' + encodeURIComponent(petname);

                fetch(url)
                    .then(function(response) {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();

                        //gave the image
                        

                    })
                    .then(function(data) {
                        // Process the data here
                        console.log(data);
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
