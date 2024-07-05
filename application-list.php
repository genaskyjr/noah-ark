<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Application List</title>

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


        <style>
          .truncated-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        </style>


<div class="container-fluid overflow-auto">
    <div  class="container text-start gx-0">
<div class="row g-2 g-md-3 mt-1 row-cols-2 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xl-5 row-cols-xxl-6">


        <?php


include 'backend/dbconnect.php';


if(isset($_GET['search'])){
  $keyword = '%' . $_GET['search'] . '%';
  $stmt = $conn->prepare("SELECT 
  adopt_application.adoption_number AS petnumber,
  adopt_application.id AS id,
  users.fullname AS fullname,
  adoption_pets.adoption_nickname as nickname,
  adoption_pets.adoption_image AS image
FROM 
  adopt_application
JOIN 
  adoption_pets ON adopt_application.adoption_number = adoption_pets.adoption_number
JOIN 
  users ON adopt_application.user_id = users.id
WHERE 
  CAST(adopt_application.adoption_number AS CHAR) LIKE '%$keyword%'
  OR CAST(adopt_application.id AS CHAR) LIKE '%$keyword%'
  OR adoption_pets.adoption_nickname LIKE '%$keyword%'
  OR fullname LIKE '%$keyword%'
");
  $stmt->execute(); // Execute the statement first.
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

}else{
  $stmt = $conn->prepare("SELECT 
  adopt_application.adoption_number AS petnumber,
  adopt_application.id AS id,
  users.fullname AS fullname,
  adoption_pets.adoption_nickname as nickname,
  adoption_pets.adoption_image AS image
FROM 
  adopt_application
JOIN 
  adoption_pets ON adopt_application.adoption_number = adoption_pets.adoption_number
JOIN 
  users ON adopt_application.user_id = users.id

");
  $stmt->execute(); // Execute the statement first.
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

foreach ($result as $row) {

    ?>


<div class="col">
                         <div id="cards" class="card bg-light">
                          
                           <img src="<?php echo $row['image']?>" class="card-img-top" alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <p class="card-text truncated-text">Application #<?php echo $row['id']?></p>
                           <p class="card-text truncated-text"><?php echo $row['nickname']?></p>
                           <p class="card-text truncated-text"><?php echo $row['fullname']?></p>
                           
                           <a  href="view-application.php?application_number=<?php echo $row['id'] ?>" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
                           
                         </div>
                       </div> 
                   </div>

<?php

}
?>  

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


<?php 
include 'components/footer.php'

?>


<script>
function delete_event(delete_event) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Archive Event #" + delete_event + "?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Archive it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Send an AJAX request to delete the user
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "backend/delete_event.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                    
                        Swal.fire({
                            title: 'Archived!',
                            text: 'Event has been Archived.',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload(true);
                            }
                        });


                    } else {
                        Swal.fire('Error', 'There was an error deleting the user.', 'error');
                    }
                }
            };
            xhr.send("event_id=" + delete_event);
        }
    })
}
</script>








    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
