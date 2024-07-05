

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>My Pets</title>

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
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0; /* Reset default margin */
    }

    .container {
      flex: 1;
    }

    #footer {
      flex-shrink: 0;
    }

    @media (max-width: 767px) {
      #footer {
        position: fixed;
        bottom: 0;
        width: 100%;
      }
    }
  </style>

  </head>
  <body>
<script src="js/zoom.js"></script>


<?php 
  include 'components/nav.php';
  include 'components/navbar.php';
  $_SESSION['last_visited_page'] = $_SERVER['REQUEST_URI'];

?>


    <?php 
    include 'components/sidebar.php'
    ?>
     

      <!-- content start -->
      <div id="content" class="m-3 bg-white container content text-center border-top border-success border-3 rounded-1">
          

      
      <?php
      include 'components/breadcrumb.php'
      ?>


      <div class="container-fluid gx-0">
      <div  class="container text-start gx-0 p-1">
               
              <div class="row g-2 g-md-3 mt-1 row-cols-2 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xl-5 row-cols-xxl-6">

              <style>
          .truncated-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        </style>


              <?php


//echo $_SESSION['fullname'];
$current_user = $_SESSION['id'];

include 'backend/dbconnect.php';

$stmt = $conn->prepare("SELECT * FROM `pets` WHERE `pet_owner` = :current_user");

$stmt->bindParam(':current_user', $current_user);

$stmt->execute(); // Execute the statement first.

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);



foreach ($result as $row) {
  

  $birthday = $row['pet_birthday'];
  $today = new DateTime();
  $birthdate = new DateTime($birthday);
  $age = $today->diff($birthdate)->y;


    ?>

    

               <div class="col">
                         <div id="cards" class="card bg-light">
                           <img src="<?php echo $row['pet_img'];?>" class="card-img-top" alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <h5 class="card-title truncated-text"><?php echo $row['pet_name'];?></h5>
                          
                           <a href="view-pet.php?pet_name=<?php echo $row['pet_name'] . '&pet_birthday=' . $row['pet_birthday'] . '&pet_age=' . $age . '&pet_last_vaccine=' . $row['pet_last_vaccine'] . '&pet_next_vaccine=' . $row['pet_next_vaccine'] . '&pet_img=' . $row['pet_img'] . '&pet_gender=' . $row['pet_gender'] . '&pet_type=' . $row['pet_type']; ?>" class="btn btn-primary btn-md my-1 mb-1 py-2"><i class="fa-solid fa-eye"></i> View</a> 
                            <a href="update-pet.php?pet_id=<?php echo $row['pet_id'] ?>" class="btn btn-success btn-md my-1 mb-1 py-2"><i class="fa-solid fa-pen-to-square "></i> Edit  </a>
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
                           <h5 class="card-title">Shernan</h5>
                           <a  href="view-pet.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View  </a>
                      

                            <a href="update-pet.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit  </a>
                         </div>
                       </div> 
                   </div>

                   <div class="col">
                         <div id="cards" class="card bg-light">
                           <img src="/assets/cat2.jpg" class="card-img-top" alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <h5 class="card-title">Shernan</h5>
                           <a  href="view-pet.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View  </a>
                      

                            <a href="update-pet.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit  </a>
                         </div>
                       </div> 
                   </div>

                   <div class="col">
                         <div id="cards" class="card bg-light">
                           <img src="/assets/cat2.jpg" class="card-img-top" alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <h5 class="card-title">Shernan</h5>
                           <a  href="view-pet.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View  </a>
                      

                            <a href="update-pet.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit  </a>
                         </div>
                       </div> 
                   </div>

                   <div class="col">
                         <div id="cards" class="card bg-light">
                           <img src="/assets/cat2.jpg" class="card-img-top" alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <h5 class="card-title">Shernan</h5>
                           <a  href="view-pet.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View  </a>
                      

                            <a href="update-pet.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit  </a>
                         </div>
                       </div> 
                   </div>

                   <div class="col">
                         <div id="cards" class="card bg-light">
                           <img src="/assets/cat2.jpg" class="card-img-top" alt="..." height="150px" width="150px">
                           <div class="card-body">
                           <h5 class="card-title">Shernan</h5>
                           <a  href="view-pet.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View  </a>
                      

                            <a href="update-pet.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit  </a>
                         </div>
                       </div> 
                   </div>

              -->



                 


       </div>
</div>

      </div>
      <!-- content end -->
  </div>

 </div>


<?php 
include 'components/footer.php';
?>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
