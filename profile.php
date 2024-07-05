

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Profile</title>

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

    
      <img id="logo" src="assets/logo.png" alt="Logo" width="130" height="130" class="mt-3 d-inline-block align-text-top">
       
       


       <?php 
      if(isset($_GET['fullname']) && isset($_GET['address']) && isset($_GET['email']) && isset($_GET['phone_number']) && isset($_GET['pet_count'])) {
        $fullname = $_GET['fullname'];
        $address = $_GET['address'];
        $email = $_GET['email'];
        $phone_number = $_GET['phone_number'];
        $pet_count = $_GET['pet_count'];

        ?>

<h4 class="text-center mt-3"><?php echo $fullname;?></h4>
       <p class="text-center">Hi! Thank you for supporting us! </p>
       <!--table -->

<table class="table table-bordered text-start">

<thead>
  <tr>
    <th>Information</th>
    <th>Details</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td>Full name</td>
    <td><?php echo $fullname;?></td>
  </tr>
  <tr>
    <td>Barangay</td>
    <td><?php echo $address;?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $email;?></td>
  </tr>
  <tr>
    <td>Cellphone Number</td>
    <td><?php echo $phone_number;?></td>
  </tr>
  <tr>
    <td>Registered Pet's</td>
    <td><?php echo $pet_count;?></td>


    
  </tr>
</tbody>
</table>


        <?php
       

      }else{ ?>

<h4 class="text-center mt-3"><?php echo $_SESSION['fullname'];?></h4>
       <p class="text-center">Hi! Thank you for supporting us! </p>
       <!--table -->




<table class="table table-bordered text-start">

<thead>
  <tr>
    <th>Information</th>
    <th>Details</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td>Full Name</td>
    <td><?php echo $_SESSION['fullname'];?></td>
  </tr>
  <tr>
    <td>Barangay</td>
    <td><?php echo $_SESSION['address'];?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $_SESSION['email'];?></td>
  </tr>
  <tr>
    <td>Cellphone Number</td>
    <td><?php echo $_SESSION['phone_number'];?></td>
  </tr>
  <tr>
    <td>Registered Pet's</td>
    <?php 
     include 'backend/dbconnect.php';
    $owner = $_SESSION['id'];

     $stmt = $conn->prepare("SELECT COUNT(*) FROM pets WHERE pet_owner = :owner");
     $stmt->bindParam(':owner', $owner, PDO::PARAM_STR); // Bind the parameter
     $stmt->execute();
     $count = $stmt->fetchColumn();
     ?>
       <td><?php echo $count;?></td>
     <?php 

       ?>


    
  </tr>
</tbody>
</table>




<?php
      }
       
       
       ?>










      </div>
      <!-- content end -->




  </div>


<?php 
include 'components/footer.php'

?>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
